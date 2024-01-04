<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        // Add any necessary logic to fetch data or perform actions specific to the doctor's dashboard
        return view('doctor.dashboard'); // Return the doctor dashboard view
    }
}   