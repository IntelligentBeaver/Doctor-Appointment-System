<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Services\AppointmentService;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $patient = auth()->user()->patient;

        $appointments = $patient->appointments;
        $appointmentCount = $appointments->count();

        // Number of distinct doctors this patient has appointments with.
        $count = $appointments->pluck('DoctorID')->unique()->count();

        $todaysAppointments = $appointments->filter(function ($appointment) {
            return Carbon::parse($appointment->Date)->isToday();
        });

        return view('patient.dashboard', compact('appointments', 'appointmentCount', 'todaysAppointments', 'count')); // Return the patient dashboard view
    }

    public function viewAppointments()
    {
        $appointments = Appointment::with(['doctor', 'timeSlot'])
            ->where('PatientID', auth()->user()->patient->PatientID)
            ->orderBy('Date')
            ->get();

        return view('patient.appointments.viewappointments', compact('appointments'));
    }

    public function destroy($AppointmentID, AppointmentService $appointments)
    {
        $appointment = Appointment::find($AppointmentID);

        if (! $appointment) {
            return redirect()->route('patient.appointment.view')->with('errormessages', ['Could not cancel the appointment. Please try again later.']);
        }

        $this->authorize('cancel', $appointment);

        $appointments->cancel($appointment);

        return redirect()->back()->with('success', ['Appointment deleted succesfully.']);
    }
}
