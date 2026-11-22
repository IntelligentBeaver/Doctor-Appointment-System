<?php

namespace App\Http\Controllers\Doctor;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Services\AppointmentService;

class DashboardController extends Controller
{
    public function index()
    {
        $doctor = auth()->user()->doctor;

        $appointments = $doctor->appointments;
        $appointmentCount = $appointments->count();

        // Number of distinct patients this doctor has appointments with.
        $count = $appointments->pluck('PatientID')->unique()->count();

        $todaysAppointments = $appointments->filter(function ($appointment) {
            return Carbon::parse($appointment->Date)->isToday();
        });

        if ($todaysAppointments->isEmpty()) {
            $todaysAppointments = '0';
        }

        return view('doctor.dashboard', compact('appointmentCount', 'todaysAppointments', 'count')); // Return the doctor dashboard view
    }

    public function viewAppointments()
    {
        // A doctor only sees their own appointments.
        $appointments = Appointment::with(['doctor', 'patient', 'timeSlot'])
            ->where('DoctorID', auth()->user()->doctor->DoctorID)
            ->orderBy('Date')
            ->get();

        return view('doctor.appointments.viewappointments', compact('appointments'));
    }

    public function destroyAppointment($AppointmentID, AppointmentService $appointments)
    {
        $appointment = Appointment::find($AppointmentID);

        if (! $appointment) {
            return redirect()->route('doctor.appointment.view')->with('errormessages', ['Could not cancel the appointment. Please try again later.']);
        }

        $this->authorize('cancel', $appointment);

        $appointments->cancel($appointment);

        return redirect()->back()->with('success', ['Appointment deleted succesfully.']);
    }
}
