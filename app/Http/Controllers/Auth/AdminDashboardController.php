<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Appointment;
use App\Models\Availability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $users = User::all();
            $totalpatients = User::where('role', 'patient')->count();
            $totaldoctors = User::where('role', 'doctor')->count();
            $totalappointments = Appointment::all()->count();

            return view('admin.dashboard', compact('totalpatients', 'totaldoctors', 'totalappointments'));
        }

        // If the user doesn't have the required role, go back and display an error message
        return redirect()->route('home')->with('errormessage', ['Unauthorized access.']);
    }


    public function viewAppointments()
    {
        $appointments = Appointment::all();
        return view('admin.appointments.viewappointments', compact('appointments'));
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
            return redirect()->route('patient.appointment.view')->with('errormessages', ['Could not cancel the appointment. Please try again later.']);
        }
    }



    public function view_Users()
    {
        if (auth()->user()->role == 'admin') {
            $users = User::all();

            return view('admin.users.index', compact('users'));
        }

        // If the user doesn't have the required role, go back and display an error message
        return redirect()->route('home')->with('errormessage', ['Unauthorized access.']);
    }
    public function edit($id)
    {
        // This will find the users from our User model (users table in MySQL) and store the array of record in $users
        $users = User::find($id);

        return view('admin.users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request and update the user information
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::find($id);

        // $adminRole = $request->has('admin_role') ? 'admin' : $user->role;
        // $user->update(['role' => $adminRole]);

        if ($request->has('admin_role')) {

            // Checkbox is checked, assign admin role
            $user->update(['role' => 'admin']);

            // Handle deletion from related tables
            $user->doctor()->delete();
            $user->patient()->delete();
        } else {
            $user->update(['role' => $user->role]);
        }

        $user->update($request->all());
        return redirect()->route('admin.viewusers')->with('success', ['User updated successfully']);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            // Update appointments
            Appointment::where('DoctorID', $user->doctor->DoctorID)->delete();
            Availability::where('DoctorID', $user->doctor->DoctorID)->delete();

            $user->delete();
            return redirect()->route('admin.viewusers')->with('success', ['User deleted successfully']);
        }

        return redirect()->route('admin.viewusers')->with('errormessages', ['User not found']);
    }
}