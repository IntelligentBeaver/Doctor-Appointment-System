<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Availability;
use Illuminate\Http\Request;
use App\Models\Specialization;

class AppointmentsController extends Controller
{
    public function create()
    {

        $doctors = Doctor::with(['availabilities.timeSlot'])->get();
        $specializations = Specialization::with('doctors')->get();

        $doctors->transform(function ($doctor) {
            $doctor->availabilities = $doctor->availabilities->reject(function ($availability) {
                // Checks if the date is less than today
                return Carbon::parse($availability->Date)->isPast();
            });

            return $doctor;
        });

        // Removes doctors without available appointments
        $doctors = $doctors->reject(function ($doctor) {
            return $doctor->availabilities->isEmpty();
        });


        if ($doctors->isEmpty()) {
            $message = "No doctors available. Please check back later.";
            return view('appointments', compact('specializations', 'message'));
        }

        return view('appointments', compact('specializations', 'doctors'));
    }
    public function book($doctorId, $availabilityId, $timeslotID, $appointdate, $startTime, $endTime)
    {
        $doctor = Doctor::find($doctorId);
        $availability = Availability::find($availabilityId);

        // // Redirect back to the appointments page with updated availabilities
        return view('patient.appointments.confirm', compact('doctor', 'availability', 'timeslotID', 'appointdate', 'startTime', 'endTime'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'doctor_id' => 'required|exists:doctors,DoctorID',
            'availability_id' => 'required|exists:availabilities,AvailabilityID',
            'timeslotID' => ['required'],
            'start_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $availability = Availability::where('AvailabilityID', $request->availability_id)->first();
        $tokenNumber = mt_rand(10000000, 99999999);

        // Store the appointment in the database
        $appointment = Appointment::create([
            'PatientID' => auth()->user()->patient->PatientID,
            'DoctorID' => $request->doctor_id,
            'TimeSlotID' => $request->timeslotID,
            'Date' => $request->date,
            'Status' => 'Unpaid',
            'TokenNumber' => $tokenNumber,
        ]);
        // Capture the AppointmentID
        $appointmentID = $appointment->AppointmentID;
        $availability->delete();

        return redirect()->route('payments.create', compact('appointmentID'));
    }
}