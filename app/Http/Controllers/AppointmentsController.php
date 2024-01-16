<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;

class AppointmentsController extends Controller
{
    public function create(){
        $specialization = Specialization::all();
        return view('appointments', compact('specialization'));
    }
}