<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Add any necessary logic to fetch data or perform actions specific to the patient's dashboard
        return view('patient.dashboard'); // Return the patient dashboard view
    }
}