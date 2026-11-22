<?php

namespace Tests\Feature\Payments;

use App\Models\Appointment;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RemoteMerge\Esewa\Contracts\EpayInterface;
use RemoteMerge\Esewa\Contracts\HttpClientInterface;
use RemoteMerge\Esewa\Epay;
use Tests\Concerns\CreatesClinicData;
use Tests\TestCase;

/**
 * Uses the real eSewa SDK with eSewa's public test secret, so signature checks are genuine.
 * Only the HTTP call to eSewa's status API is faked.
 */
class EsewaPaymentTest extends TestCase
{
    use CreatesClinicData;
    use RefreshDatabase;

    private const SECRET = '8gBm/:&EnhH.1/q';

    private string $statusResponse = '{"status":"COMPLETE"}';

    protected function setUp(): void
    {
        parent::setUp();

        $test = $this;
        $http = new class($test) implements HttpClientInterface
        {
            public function __construct(private EsewaPaymentTest $test) {}

            public function get(string $url, array $headers = []): string
            {
                return $this->test->statusResponse();
            }

            public function post(string $url, array $data, array $headers = []): string
            {
                return '{}';
            }
        };

        $this->app->bind(EpayInterface::class, function ($app, array $overrides = []) use ($http) {
            $epay = new Epay($http);
            $epay->configure(array_merge([
                'environment' => 'test',
                'product_code' => 'EPAYTEST',
                'secret_key' => self::SECRET,
                'success_url' => route('payments.success'),
                'failure_url' => route('payments.failure'),
            ], $overrides));

            return $epay;
        });
    }

    public function statusResponse(): string
    {
        return $this->statusResponse;
    }

    private function signedCallback(string $uuid, string $total = '500.0', string $status = 'COMPLETE', ?string $secret = null): string
    {
        $data = [
            'transaction_code' => '000AWEO',
            'status' => $status,
            'total_amount' => $total,
            'transaction_uuid' => $uuid,
            'product_code' => 'EPAYTEST',
            'signed_field_names' => 'transaction_code,status,total_amount,transaction_uuid,product_code,signed_field_names',
        ];

        $message = collect(explode(',', $data['signed_field_names']))
            ->map(fn ($field) => $field . '=' . $data[$field])
            ->implode(',');

        $data['signature'] = base64_encode(hash_hmac('sha256', $message, $secret ?? self::SECRET, true));

        return base64_encode(json_encode($data));
    }

    public function test_checkout_uses_server_side_fee_and_signs_the_form(): void
    {
        $patient = $this->makePatient();
        $appointment = $this->makeAppointment($patient, $this->makeDoctor());

        $response = $this->actingAs($patient->user)->post(route('payments.store'), [
            'appointment_id' => $appointment->AppointmentID,
            'amount' => 1, // ignored: the fee comes from config
        ]);

        $response->assertOk()->assertSee('rc-epay.esewa.com.np', false)->assertSee('name="signature"', false);

        $order = Order::sole();
        $this->assertEquals(500, $order->amount);
        $this->assertSame(Order::STATUS_UNVERIFIED, $order->esewa_status);
    }

    public function test_patient_cannot_pay_for_someone_elses_appointment(): void
    {
        $owner = $this->makePatient();
        $intruder = $this->makePatient();
        $appointment = $this->makeAppointment($owner, $this->makeDoctor());

        $this->actingAs($intruder->user)->get(route('payments.create', $appointment->AppointmentID))->assertForbidden();
        $this->actingAs($intruder->user)->post(route('payments.store'), ['appointment_id' => $appointment->AppointmentID])->assertForbidden();

        $this->assertSame(0, Order::count());
    }

    public function test_verified_callback_books_the_appointment(): void
    {
        $patient = $this->makePatient();
        $appointment = $this->makeAppointment($patient, $this->makeDoctor());
        $this->makeOrder($appointment, 'order-1');

        $this->actingAs($patient->user)
            ->get(route('payments.success', ['data' => $this->signedCallback('order-1')]))
            ->assertOk()
            ->assertSee('Successfull');

        $this->assertSame(Appointment::STATUS_BOOKED, $appointment->fresh()->Status);
        $this->assertSame(Order::STATUS_VERIFIED, Order::sole()->esewa_status);
    }

    public function test_forged_query_string_does_not_book_the_appointment(): void
    {
        $patient = $this->makePatient();
        $appointment = $this->makeAppointment($patient, $this->makeDoctor());
        $this->makeOrder($appointment, 'order-1');

        // The old v1 integration trusted these parameters.
        $this->actingAs($patient->user)->get('/success?oid=order-1&amt=500&refId=x')->assertOk();
        // A payload signed with the wrong key.
        $this->actingAs($patient->user)->get(route('payments.success', [
            'data' => $this->signedCallback('order-1', secret: 'wrong-secret'),
        ]))->assertOk();

        $this->assertSame(Appointment::STATUS_UNPAID, $appointment->fresh()->Status);
        $this->assertSame(Order::STATUS_UNVERIFIED, Order::sole()->esewa_status);
    }

    public function test_amount_mismatch_does_not_book_the_appointment(): void
    {
        $patient = $this->makePatient();
        $appointment = $this->makeAppointment($patient, $this->makeDoctor());
        $this->makeOrder($appointment, 'order-1', 500);

        $this->actingAs($patient->user)->get(route('payments.success', [
            'data' => $this->signedCallback('order-1', total: '1.0'),
        ]));

        $this->assertSame(Appointment::STATUS_UNPAID, $appointment->fresh()->Status);
    }

    public function test_unconfirmed_status_does_not_book_the_appointment(): void
    {
        $this->statusResponse = '{"status":"PENDING"}';

        $patient = $this->makePatient();
        $appointment = $this->makeAppointment($patient, $this->makeDoctor());
        $this->makeOrder($appointment, 'order-1');

        $this->actingAs($patient->user)
            ->get(route('payments.success', ['data' => $this->signedCallback('order-1')]))
            ->assertSee('Pending');

        $this->assertSame(Appointment::STATUS_UNPAID, $appointment->fresh()->Status);
    }

    public function test_formatted_amount_from_esewa_is_accepted(): void
    {
        config(['services.esewa.appointment_fee' => 1000]);

        $patient = $this->makePatient();
        $appointment = $this->makeAppointment($patient, $this->makeDoctor());
        $this->makeOrder($appointment, 'order-1', 1000);

        $this->actingAs($patient->user)->get(route('payments.success', [
            'data' => $this->signedCallback('order-1', total: '1,000.0'),
        ]));

        $this->assertSame(Appointment::STATUS_BOOKED, $appointment->fresh()->Status);
    }

    public function test_callback_for_another_users_order_is_rejected(): void
    {
        $owner = $this->makePatient();
        $other = $this->makePatient();
        $appointment = $this->makeAppointment($owner, $this->makeDoctor());
        $this->makeOrder($appointment, 'order-1');

        $this->actingAs($other->user)->get(route('payments.success', ['data' => $this->signedCallback('order-1')]));

        $this->assertSame(Order::STATUS_UNVERIFIED, Order::sole()->esewa_status);
    }

    public function test_failure_callback_marks_only_own_order_failed(): void
    {
        $patient = $this->makePatient();
        $appointment = $this->makeAppointment($patient, $this->makeDoctor());
        $this->makeOrder($appointment, 'order-1');

        $this->actingAs($patient->user)->get(route('payments.failure', ['pid' => 'order-1']))->assertOk();
        $this->actingAs($patient->user)->get(route('payments.failure'))->assertOk(); // no pid: no crash

        $this->assertSame(Order::STATUS_FAILED, Order::sole()->esewa_status);
    }
}
