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
            'doctor' => ['required', 'exists:doctors,DoctorID'],
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'selected_days' => 'required|string',
        ]);

        $startTime = Carbon::createFromFormat('H:i', $request->input('start_time'))->format('H:i:00');
        $endTime = Carbon::createFromFormat('H:i', $request->input('end_time'))->format('H:i:00');

        $selectedDays = array_filter(array_map('trim', explode(',', $request->input('selected_days'))));

        foreach ($selectedDays as $date) {
            $parsed = Carbon::canBeCreatedFromFormat($date, 'Y-m-d') ? Carbon::createFromFormat('Y-m-d', $date) : null;

            if (! $parsed || $parsed->format('Y-m-d') !== $date || $parsed->isBefore(Carbon::today())) {
                return redirect()->route('admin.timeslots.create')
                    ->withErrors(['selected_days' => 'Pick valid dates from today onwards (format: YYYY-MM-DD).'])
                    ->withInput();
            }
        }

        $timeSlots = TimeSlot::whereTime('StartTime', '>=', $startTime)
            ->whereTime('EndTime', '<=', $endTime)
            ->get();

        foreach ($selectedDays as $selectedDay) {
            foreach ($timeSlots as $timeSlot) {
                // Re-submitting the same range does not create duplicate slots.
                Availability::firstOrCreate([
                    'DoctorID' => $request->integer('doctor'),
                    'TimeSlotID' => $timeSlot->TimeSlotID,
                    'Date' => $selectedDay,
                ], ['Status' => 'active']);
            }
        }

        return redirect()->back()->with('success', ['Time slot added successfully']);
    }
}
