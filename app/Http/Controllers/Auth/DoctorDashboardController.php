<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Models\Appointment;
use App\Models\Availability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $doctor = auth()->user()->doctor;

        $PatientIDs = $doctor->appointments->pluck('PatientID');
        $count = 0;
        $previousindex=0;
        foreach($PatientIDs as $PatientIDindex){   
            if($PatientIDindex==$previousindex){
                continue;
            }
            else{
                $count++;
            }
            $previousindex = $PatientIDindex;
        }

        $appointments = $doctor->appointments;
        $appointmentCount = $appointments->count();

        $todaysAppointments = $appointments->filter(function ($appointment) {
            return Carbon::parse($appointment->Date)->isToday();
        });
        if($todaysAppointments=='[]'){
            $todaysAppointments = '0';
        }
        
        return view('doctor.dashboard',compact('appointmentCount','todaysAppointments','count')); // Return the doctor dashboard view
    }

    public function viewAppointments()
    {
        $appointments = Appointment::all();
        return view('doctor.appointments.viewappointments', compact('appointments'));
    }

    public function destroyAppointment($AppointmentID)
    {
        $appointment = Appointment::find($AppointmentID);

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
            return redirect()->route('doctor.appointment.view')->with('errormessages', ['Could not cancel the appointment. Please try again later.']);
        }
    }

}   