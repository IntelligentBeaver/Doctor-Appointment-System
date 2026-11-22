<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;

class AppointmentPolicy
{
    /**
     * Admins can cancel any appointment; patients and doctors only their own.
     */
    public function cancel(User $user, Appointment $appointment): bool
    {
        return match ($user->role) {
            'admin' => true,
            'patient' => $this->ownsAsPatient($user, $appointment),
            'doctor' => $user->doctor !== null && (int) $appointment->DoctorID === (int) $user->doctor->DoctorID,
            default => false,
        };
    }

    /**
     * Only the patient who booked an appointment can pay for it, and only while it is unpaid.
     */
    public function pay(User $user, Appointment $appointment): bool
    {
        return $user->role === 'patient'
            && $this->ownsAsPatient($user, $appointment)
            && $appointment->Status === Appointment::STATUS_UNPAID;
    }

    private function ownsAsPatient(User $user, Appointment $appointment): bool
    {
        return $user->patient !== null && (int) $appointment->PatientID === (int) $user->patient->PatientID;
    }
}
