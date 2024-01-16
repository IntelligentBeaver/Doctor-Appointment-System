<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Specialization;

class AppointmentsController extends Controller
{
    public function create()
    {
        $doctor = Doctor::all();
        $specialization = Specialization::all();
        $specializations = Specialization::with('doctors')->get();
        $doctors = Doctor::all();
        if ($doctor->isEmpty()) {
            $message = "No doctors available. Please check back later.";
            return view('appointments', compact('specialization','message'));
        }
        return view('appointments', compact('specialization', 'doctor','specializations'));
    }
}