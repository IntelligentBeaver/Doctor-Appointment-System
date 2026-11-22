<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Doctor;
use App\Models\Specialization;
use App\Services\AppointmentService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function view()
    {
        return view('about');
    }

    public function create()
    {
        $specializations = Specialization::with('doctors')->get();

        // Only open, upcoming slots are shown.
        $doctors = Doctor::with(['availabilities' => function ($query) {
            $query->where('Status', 'active')
                ->whereDate('Date', '>=', Carbon::today())
                ->with('timeSlot');
        }])->get();

        $doctors->each(function ($doctor) {
            $doctor->setRelation('availabilities', $doctor->availabilities->reject(function ($availability) {
                $date = Carbon::parse($availability->Date)->toDateString();

                return Carbon::parse("$date {$availability->timeSlot->StartTime}")->isPast();
            })->values());
        });

        // Removes doctors without available appointments
        $doctors = $doctors->reject(fn ($doctor) => $doctor->availabilities->isEmpty());

        if ($doctors->isEmpty()) {
            $message = 'No doctors available. Please check back later.';

            return view('appointments', compact('specializations', 'message'));
        }

        return view('appointments', compact('specializations', 'doctors'));
    }

    /**
     * Confirmation page. The URL keeps its old shape for existing links, but every
     * value shown comes from the availability row, not from the URL.
     */
    public function book($doctorId, $availabilityId, $timeslotID, $appointdate, $startTime, $endTime)
    {
        $availability = Availability::with(['doctor', 'timeSlot'])
            ->whereKey($availabilityId)
            ->where('Status', 'active')
            ->firstOrFail();

        $doctor = $availability->doctor;
        $timeslotID = $availability->TimeSlotID;
        $appointdate = Carbon::parse($availability->Date)->toDateString();
        $startTime = Carbon::parse($availability->timeSlot->StartTime)->format('H:i');
        $endTime = Carbon::parse($availability->timeSlot->EndTime)->format('H:i');

        return view('patient.appointments.confirm', compact('doctor', 'availability', 'timeslotID', 'appointdate', 'startTime', 'endTime'));
    }

    public function store(Request $request, AppointmentService $appointments)
    {
        $validated = $request->validate([
            'availability_id' => ['required', 'integer'],
        ]);

        $appointment = $appointments->book($request->user()->patient, (int) $validated['availability_id']);

        return redirect()->route('payments.create', ['appointmentID' => $appointment->AppointmentID]);
    }
}
