<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\View\View;
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
}   