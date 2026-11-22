<?php

namespace Tests\Feature\Appointments;

use App\Models\Appointment;
use App\Models\Availability;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesClinicData;
use Tests\TestCase;

class BookingAndCancellationTest extends TestCase
{
    use CreatesClinicData;
    use RefreshDatabase;

    public function test_patient_books_an_open_slot(): void
    {
        $patient = $this->makePatient();
        $doctor = $this->makeDoctor();
        $slot = $this->makeAvailability($doctor);

        $response = $this->actingAs($patient->user)->post(route('patient.appointment.store'), [
            'availability_id' => $slot->AvailabilityID,
        ]);

        $appointment = Appointment::sole();
        $response->assertRedirect(route('payments.create', ['appointmentID' => $appointment->AppointmentID]));
        $this->assertSame($doctor->DoctorID, (int) $appointment->DoctorID);
        $this->assertSame(Appointment::STATUS_UNPAID, $appointment->Status);
        $this->assertModelMissing($slot);
    }

    public function test_booking_ignores_tampered_doctor_and_date(): void
    {
        $patient = $this->makePatient();
        $doctor = $this->makeDoctor();
        $otherDoctor = $this->makeDoctor();
        $slot = $this->makeAvailability($doctor, now()->addDays(3)->toDateString());

        $this->actingAs($patient->user)->post(route('patient.appointment.store'), [
            'availability_id' => $slot->AvailabilityID,
            'doctor_id' => $otherDoctor->DoctorID,
            'date' => now()->subYear()->toDateString(),
            'timeslotID' => 999,
        ]);

        $appointment = Appointment::sole();
        $this->assertSame($doctor->DoctorID, (int) $appointment->DoctorID);
        $this->assertSame(now()->addDays(3)->toDateString(), $appointment->Date);
        $this->assertSame($slot->TimeSlotID, (int) $appointment->TimeSlotID);
    }

    public function test_same_slot_cannot_be_booked_twice(): void
    {
        $first = $this->makePatient();
        $second = $this->makePatient();
        $slot = $this->makeAvailability($this->makeDoctor());

        $this->actingAs($first->user)->post(route('patient.appointment.store'), ['availability_id' => $slot->AvailabilityID]);
        $this->actingAs($second->user)->post(route('patient.appointment.store'), ['availability_id' => $slot->AvailabilityID])
            ->assertSessionHasErrors('availability_id');

        $this->assertSame(1, Appointment::count());
    }

    public function test_past_slots_cannot_be_booked(): void
    {
        $patient = $this->makePatient();
        $slot = $this->makeAvailability($this->makeDoctor(), now()->subDay()->toDateString());

        $this->actingAs($patient->user)->post(route('patient.appointment.store'), ['availability_id' => $slot->AvailabilityID])
            ->assertSessionHasErrors('availability_id');

        $this->assertSame(0, Appointment::count());
    }

    public function test_patient_cancels_own_appointment_and_slot_reopens(): void
    {
        $patient = $this->makePatient();
        $appointment = $this->makeAppointment($patient, $this->makeDoctor());

        $this->actingAs($patient->user)->delete(route('patient.appointment.destroy', $appointment->AppointmentID))->assertRedirect();

        $this->assertModelMissing($appointment);
        $this->assertSame(1, Availability::where('DoctorID', $appointment->DoctorID)->count());
    }

    public function test_patient_cannot_cancel_someone_elses_appointment(): void
    {
        $owner = $this->makePatient();
        $intruder = $this->makePatient();
        $appointment = $this->makeAppointment($owner, $this->makeDoctor());

        $this->actingAs($intruder->user)->delete(route('patient.appointment.destroy', $appointment->AppointmentID))->assertForbidden();

        $this->assertModelExists($appointment);
    }

    public function test_admin_can_cancel_any_appointment(): void
    {
        $appointment = $this->makeAppointment($this->makePatient(), $this->makeDoctor());

        $this->actingAs($this->makeAdmin())->delete(route('admin.appointment.destroy', $appointment->AppointmentID))->assertRedirect();

        $this->assertModelMissing($appointment);
    }

    public function test_doctor_only_sees_and_cancels_own_appointments(): void
    {
        $doctor = $this->makeDoctor();
        $otherDoctor = $this->makeDoctor();
        $patient = $this->makePatient();
        $mine = $this->makeAppointment($patient, $doctor);
        $theirs = $this->makeAppointment($patient, $otherDoctor);

        $this->actingAs($doctor->user)->get(route('doctor.appointment.view'))
            ->assertOk()
            ->assertViewHas('appointments', fn ($appointments) => $appointments->pluck('AppointmentID')->all() === [$mine->AppointmentID]);

        $this->actingAs($doctor->user)->delete(route('doctor.appointment.destroy', $theirs->AppointmentID))->assertForbidden();
        $this->assertModelExists($theirs);
    }

    public function test_booking_page_only_lists_open_future_slots(): void
    {
        $doctor = $this->makeDoctor();
        $this->makeAvailability($doctor, now()->subDay()->toDateString());
        $open = $this->makeAvailability($doctor, now()->addDay()->toDateString());

        $this->get(route('appointments'))
            ->assertOk()
            ->assertViewHas('doctors', fn ($doctors) => $doctors->first()->availabilities->pluck('AvailabilityID')->all() === [$open->AvailabilityID]);
    }
}
