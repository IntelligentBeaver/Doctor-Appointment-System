<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Appointment;
use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\AppointmentService;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalpatients = User::where('role', 'patient')->count();
        $totaldoctors = User::where('role', 'doctor')->count();
        $totalappointments = Appointment::count();

        return view('admin.dashboard', compact('totalpatients', 'totaldoctors', 'totalappointments'));
    }

    public function viewAppointments()
    {
        $appointments = Appointment::with(['doctor', 'patient', 'timeSlot'])->orderBy('Date')->get();

        return view('admin.appointments.viewappointments', compact('appointments'));
    }

    public function destroyAppointment($AppointmentID, AppointmentService $appointments)
    {
        $appointment = Appointment::find($AppointmentID);

        if (! $appointment) {
            return redirect()->route('admin.appointment.view')->with('errormessages', ['Could not cancel the appointment. Please try again later.']);
        }

        $this->authorize('cancel', $appointment);

        $appointments->cancel($appointment);

        return redirect()->back()->with('success', ['Appointment deleted succesfully.']);
    }

    public function view_Users()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);

        return view('admin.users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        DB::transaction(function () use ($request, $user, $validated) {
            // Only name and email are editable here. The role can only change through
            // the explicit "make admin" checkbox, never from arbitrary request fields.
            $user->update($validated);

            if ($request->boolean('admin_role') && $user->role !== 'admin') {
                $this->removeDoctorRecords($user);
                $user->patient()->delete();
                $user->update(['role' => 'admin']);
            }
        });

        return redirect()->route('admin.viewusers')->with('success', ['User updated successfully']);
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        if (! $user) {
            return redirect()->route('admin.viewusers')->with('errormessages', ['User not found']);
        }

        if ($user->is($request->user())) {
            return redirect()->route('admin.viewusers')->with('errormessages', ['You cannot delete your own account here.']);
        }

        DB::transaction(function () use ($user) {
            $this->removeDoctorRecords($user);
            $user->delete();
        });

        return redirect()->route('admin.viewusers')->with('success', ['User deleted successfully']);
    }

    /**
     * Appointments and slots reference the doctor row without cascading, so they must go
     * before the doctor does. Patients' appointments cascade from the patients table.
     */
    private function removeDoctorRecords(User $user): void
    {
        if (! $user->doctor) {
            return;
        }

        Appointment::where('DoctorID', $user->doctor->DoctorID)->delete();
        Availability::where('DoctorID', $user->doctor->DoctorID)->delete();
        $user->doctor->delete();
    }
}
