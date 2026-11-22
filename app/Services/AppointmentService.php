<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Availability;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Booking rules. An `availabilities` row is an open slot: booking consumes it,
 * and cancelling a future appointment puts it back.
 */
class AppointmentService
{
    /**
     * Book an open slot for a patient.
     *
     * The doctor, time slot and date all come from the availability row, never
     * from the request, so a patient cannot book a slot that was not offered.
     * The row is locked for the duration of the transaction, so two patients
     * cannot book the same slot at the same time.
     *
     * @throws ValidationException when the slot is gone, inactive or in the past.
     */
    public function book(Patient $patient, int $availabilityId): Appointment
    {
        return DB::transaction(function () use ($patient, $availabilityId) {
            $availability = Availability::with('timeSlot')
                ->whereKey($availabilityId)
                ->where('Status', 'active')
                ->lockForUpdate()
                ->first();

            if (! $availability || $this->startsAt($availability)->isPast()) {
                throw ValidationException::withMessages([
                    'availability_id' => 'This time slot is no longer available. Please pick another one.',
                ]);
            }

            $appointment = Appointment::create([
                'PatientID' => $patient->PatientID,
                'DoctorID' => $availability->DoctorID,
                'TimeSlotID' => $availability->TimeSlotID,
                'Date' => Carbon::parse($availability->Date)->toDateString(),
                'Status' => Appointment::STATUS_UNPAID,
                'TokenNumber' => $this->uniqueTokenNumber(),
            ]);

            $availability->delete();

            return $appointment;
        });
    }

    /**
     * Cancel an appointment and reopen its slot if the slot is still in the future.
     */
    public function cancel(Appointment $appointment): void
    {
        DB::transaction(function () use ($appointment) {
            $date = Carbon::parse($appointment->Date)->toDateString();
            $startTime = $appointment->timeSlot?->StartTime;
            $startsAt = $startTime ? Carbon::parse("$date $startTime") : Carbon::parse($date)->endOfDay();

            if ($startsAt->isFuture()) {
                Availability::firstOrCreate([
                    'DoctorID' => $appointment->DoctorID,
                    'TimeSlotID' => $appointment->TimeSlotID,
                    'Date' => $date,
                ], ['Status' => 'active']);
            }

            $appointment->delete();
        });
    }

    private function startsAt(Availability $availability): Carbon
    {
        $date = Carbon::parse($availability->Date)->toDateString();

        return Carbon::parse("$date {$availability->timeSlot->StartTime}");
    }

    private function uniqueTokenNumber(): int
    {
        do {
            $token = random_int(10000000, 99999999);
        } while (Appointment::where('TokenNumber', $token)->exists());

        return $token;
    }
}
