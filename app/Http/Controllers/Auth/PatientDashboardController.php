<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $previousindex=0;
        foreach($DoctorIDs as $DoctorIDindex){   
            if($DoctorIDindex==$previousindex){
                continue;
            }
            else{
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
        return view('patient.dashboard', compact('appointments', 'appointmentCount', 'todaysAppointments','count')); // Return the patient dashboard view
    }
}