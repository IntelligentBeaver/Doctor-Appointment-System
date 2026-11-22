<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RemoteMerge\Esewa\Contracts\EpayInterface;
use RemoteMerge\Esewa\Exceptions\EsewaException;

/**
 * Appointment payments through eSewa ePay v2.
 *
 * An appointment is marked Booked only after the signed callback verifies,
 * its amount matches our order, and eSewa's status API reports COMPLETE.
 */
class EsewaController extends Controller
{
    private function renderMessageView($msg, $desc, $type)
    {
        return view('payments.message', compact('msg', 'desc', 'type'));
    }

    private function fee(): float
    {
        return (float) config('services.esewa.appointment_fee');
    }

    public function create($appointmentID)
    {
        $appointment = Appointment::findOrFail($appointmentID);

        $this->authorize('pay', $appointment);

        $user = auth()->user();
        $name = $user->name;
        $email = $user->email;
        $address = $user->patient->Address;
        $fee = $this->fee();

        return view('payments.payments', compact('name', 'email', 'address', 'appointment', 'fee'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => ['required', 'integer'],
        ]);

        $appointment = Appointment::findOrFail($validated['appointment_id']);

        $this->authorize('pay', $appointment);

        $user = $request->user();
        $uuid = (string) Str::uuid();
        // The amount is decided by the server, never by the form.
        $amount = $this->fee();

        Order::create([
            'user_id' => $user->id,
            'AppointmentID' => $appointment->AppointmentID,
            'Name' => $user->name,
            'Email' => $user->email,
            'product_id' => $uuid,
            'amount' => $amount,
            'esewa_status' => Order::STATUS_UNVERIFIED,
        ]);

        $epay = app()->make(EpayInterface::class, [
            'failure_url' => route('payments.failure', ['pid' => $uuid]),
        ]);

        $fields = $epay->createPayment([
            'amount' => $amount,
            'transaction_uuid' => $uuid,
        ]);

        return view('payments.redirect', [
            'action' => $epay->getFormActionUrl(),
            'fields' => $fields,
        ]);
    }

    public function paymentSuccess(Request $request, EpayInterface $epay)
    {
        try {
            $payment = $epay->verifyPayment((string) $request->query('data', ''));
        } catch (EsewaException $e) {
            Log::warning('eSewa callback rejected', ['reason' => $e->getMessage()]);

            return $this->renderMessageView('Failure!', 'We could not verify this payment.', 'error');
        }

        $order = Order::where('product_id', $payment['transaction_uuid'] ?? null)
            ->where('user_id', $request->user()->id)
            ->first();

        if (! $order) {
            return $this->renderMessageView('Failure!', 'We could not find the order for this payment.', 'error');
        }

        if ($order->esewa_status === Order::STATUS_VERIFIED) {
            // Refresh or repeated callback: already fulfilled once.
            return $this->renderMessageView('Success!', 'Your Payment was Successfull', 'success');
        }

        $paidPaisa = $this->toPaisa($payment['total_amount'] ?? '');
        $orderPaisa = (int) round($order->amount * 100);

        if (($payment['status'] ?? null) !== 'COMPLETE' || $paidPaisa !== $orderPaisa) {
            Log::warning('eSewa callback mismatch', ['order' => $order->OrderID, 'status' => $payment['status'] ?? null]);

            return $this->renderMessageView('Failure!', 'The payment details did not match your order.', 'error');
        }

        try {
            $status = $epay->checkStatus($order->product_id, (float) $order->amount);
        } catch (EsewaException $e) {
            Log::warning('eSewa status check failed', ['order' => $order->OrderID, 'reason' => $e->getMessage()]);

            return $this->renderMessageView('Pending', 'We could not confirm your payment with eSewa yet. Please check again shortly.', 'error');
        }

        if (($status['status'] ?? null) !== 'COMPLETE') {
            return $this->renderMessageView('Pending', 'eSewa has not confirmed your payment yet. Please check again shortly.', 'error');
        }

        DB::transaction(function () use ($order) {
            // Atomic, idempotent transition: only one request can move the order out of "unverified".
            $updated = Order::whereKey($order->OrderID)
                ->where('esewa_status', Order::STATUS_UNVERIFIED)
                ->update(['esewa_status' => Order::STATUS_VERIFIED]);

            if ($updated === 1) {
                $order->appointment()->update(['Status' => Appointment::STATUS_BOOKED]);
            }
        });

        return $this->renderMessageView('Success!', 'Your Payment was Successfull', 'success');
    }

    public function paymentFailure(Request $request)
    {
        $order = Order::where('product_id', (string) $request->query('pid'))
            ->where('user_id', $request->user()->id)
            ->where('esewa_status', Order::STATUS_UNVERIFIED)
            ->first();

        $order?->update(['esewa_status' => Order::STATUS_FAILED]);

        return $this->renderMessageView('Failure!', 'Your Payment was Unsuccessfull', 'error');
    }

    /**
     * eSewa may format amounts like "1,000.0". Compare in integer paisa, not floats.
     */
    private function toPaisa(string|int|float $amount): ?int
    {
        $clean = str_replace(',', '', (string) $amount);

        return is_numeric($clean) ? (int) round(((float) $clean) * 100) : null;
    }
}
