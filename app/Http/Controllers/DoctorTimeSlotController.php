<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\TimeSlot;
use App\Models\Availability;
use Illuminate\Http\Request;

class DoctorTimeSlotController extends Controller
{
    public function create()
    {
        $doctors = Doctor::all();
        return view('admin.timeslots.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'selected_days' => 'required|string',
        ]);

        // dd($request);
        $doctorid = Doctor::where('DoctorID', $request['doctor'])->first();
        // $doctorId = auth()->user()->doctor->DoctorID;
        $startTime = Carbon::createFromFormat('H:i', $request->input('start_time'))->format('H:i');
        $endTime = Carbon::createFromFormat('H:i', $request->input('end_time'))->format('H:i');

        // Parse the selected_days string into an array
        $selectedDays = explode(', ', $request->input('selected_days'));

        // Validate each date in the array
        foreach ($selectedDays as $date) {
            if (!Carbon::createFromFormat('Y-m-d', $date, 'UTC')->isValid()) {
                return redirect()->route('admin.timeslots.create')
                    ->withErrors(['selected_days' => 'Invalid date format'])
                    ->withInput();
            }
        }

        $timeSlots = TimeSlot::whereTime('StartTime', '>=', $startTime)
            ->whereTime('EndTime', '<=', $endTime)
            ->where('StartTime', '<', $endTime)  // Exclude slots that end before they start
            ->get();

        foreach ($selectedDays as $selectedDay) {
            foreach ($timeSlots as $timeSlot) {
                // Create Availability record with doctor's ID, time slot ID, and selected day
                Availability::create([
                    'DoctorID' => $doctorid->DoctorID,
                    'TimeSlotID' => $timeSlot->TimeSlotID,
                    'Status' => 'active',
                    'Date' => $selectedDay,
                ]);
            }
        }
        // Get the authenticated doctor
        $doctor = auth()->user()->doctor;

        return redirect()->back()->with('success', ['Time slot added successfully']);
    }
}