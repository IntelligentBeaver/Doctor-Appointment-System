<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use App\Models\Availability;
use Illuminate\Http\Request;

class DoctorTimeSlotController extends Controller
{
    public function create()
    {
        return view('doctor.timeslots.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'day_of_week' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
        ]);

        $timeSlot=TimeSlot::create([
            'StartTime' => $request->start_time,
            'EndTime' => $request->end_time,
            'DayOfWeek' => $request->day_of_week,
        ]);
        // Get the authenticated doctor
        $doctor = auth()->user()->doctor;

        // Create an availability record
        Availability::create([
            'DoctorID' => $doctor->DoctorID,
            'TimeSlotID' => $timeSlot->TimeSlotID,
            'Date' => now()->toDateString(), // Customize this based on your requirements
            'Status' => 'Available', // Customize this based on your requirements
        ]);

        return redirect()->route('doctor.timeslots.create')->with('success', ['Time slot added successfully']);
    }
}