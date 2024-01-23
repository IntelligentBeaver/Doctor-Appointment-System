<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Availability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $patient = auth()->user()->patient;

        $DoctorIDs = $patient->appointments->pluck('DoctorID');
        $count = 0;
        $previousindex = 0;
        foreach ($DoctorIDs as $DoctorIDindex) {
            if ($DoctorIDindex == $previousindex) {
                continue;
            } else {
                $count++;
            }
            $previousindex = $DoctorIDindex;
        }

        $appointments = $patient->appointments;
        $appointmentCount = $appointments->count();

        $todaysAppointments = $appointments->filter(function ($appointment) {
            return Carbon::parse($appointment->Date)->isToday();
        });
        // Add any necessary logic to fetch data or perform actions specific to the patient's dashboard
        return view('patient.dashboard', compact('appointments', 'appointmentCount', 'todaysAppointments', 'count')); // Return the patient dashboard view
    }

    public function viewAppointments()
    {
        $id = Auth::user()->patient->PatientID;
        $appointments = Appointment::all()->where('PatientID', $id);
        foreach ($appointments as $key => $index) {
            $doctor = [$key => $index->doctor->DoctorName];
            // print_r($doctor);
        }
        // dd($doctor);
        return view('patient.appointments.viewappointments', compact('appointments'));
    }
    
    public function destroy($AppointmentID)
    {
        // dd(print($TokenNumber));
        $appointment = Appointment::find($AppointmentID);
        // dd(print($appointment));

        if ($appointment) {

            $doctorid = $appointment->DoctorID;
            $timeSlotid = $appointment->TimeSlotID;
            $date = $appointment->Date;
            $availibility = Availability::create([
                'DoctorID' => $doctorid,
                'TimeSlotID' => $timeSlotid,
                'Date' => $date,
                'Status' => 'active',
            ]);

            $appointment->delete();
            return redirect()->back()->with('success', ['Appointment deleted succesfully.']);
        } else {
            return redirect()->route('patient.appointment.view')->with('errormessages', ['Could not cancel the appointment. Please try again later.']);
        }
    }
}