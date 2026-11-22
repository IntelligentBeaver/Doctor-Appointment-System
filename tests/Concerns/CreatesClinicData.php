<?php

namespace Tests\Concerns;

use App\Models\Appointment;
use App\Models\Availability;
use App\Models\Doctor;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Specialization;
use App\Models\TimeSlot;
use App\Models\User;

/**
 * Small builders for the clinic domain. The models use custom primary keys and
 * have no factories, so tests create records through these helpers instead.
 */
trait CreatesClinicData
{
    protected function makeAdmin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    protected function makePatient(): Patient
    {
        $user = User::factory()->create(['role' => 'patient']);

        return Patient::create([
            'user_id' => $user->id,
            'PatientName' => $user->name,
            'Address' => 'Kathmandu',
            'Phone' => '9800000000',
            'Email' => $user->email,
        ]);
    }

    protected function makeDoctor(): Doctor
    {
        $user = User::factory()->create(['role' => 'doctor']);

        $specialization = Specialization::firstOrCreate(
            ['SpecializationName' => 'General Medicine'],
            ['Description' => 'General practice'],
        );

        return Doctor::create([
            'user_id' => $user->id,
            'DoctorName' => $user->name,
            'SpecializationID' => $specialization->SpecializationID,
            'ContactInformation' => '9811111111',
        ]);
    }

    protected function makeTimeSlot(string $start = '10:00:00', string $end = '10:30:00'): TimeSlot
    {
        return TimeSlot::create(['StartTime' => $start, 'EndTime' => $end]);
    }

    protected function makeAvailability(Doctor $doctor, ?string $date = null, ?TimeSlot $slot = null, string $status = 'active'): Availability
    {
        return Availability::create([
            'DoctorID' => $doctor->DoctorID,
            'TimeSlotID' => ($slot ?? $this->makeTimeSlot())->TimeSlotID,
            'Date' => $date ?? now()->addDay()->toDateString(),
            'Status' => $status,
        ]);
    }

    protected function makeAppointment(Patient $patient, Doctor $doctor, string $status = 'Unpaid'): Appointment
    {
        return Appointment::create([
            'PatientID' => $patient->PatientID,
            'DoctorID' => $doctor->DoctorID,
            'TimeSlotID' => $this->makeTimeSlot()->TimeSlotID,
            'Date' => now()->addDay()->toDateString(),
            'Status' => $status,
            'TokenNumber' => random_int(10000000, 99999999),
        ]);
    }

    protected function makeOrder(Appointment $appointment, string $uuid = 'order-1', float $amount = 500): Order
    {
        $user = $appointment->patient->user;

        return Order::create([
            'user_id' => $user->id,
            'AppointmentID' => $appointment->AppointmentID,
            'Name' => $user->name,
            'Email' => $user->email,
            'product_id' => $uuid,
            'amount' => $amount,
            'esewa_status' => 'unverified',
        ]);
    }
}
