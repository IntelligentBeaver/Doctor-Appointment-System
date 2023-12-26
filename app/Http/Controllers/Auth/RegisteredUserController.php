<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required'],

            // Requires only if role is patient
            'phone' => ['required_if:role,patient'],
            'address' => ['required_if:role,patient'],

            // Requires only if role is doctor
            'specializationname'=> ['required_if:role,doctor'],
            'contact_information'=> ['required_if:role,doctor'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request['role'],
        ]);

        $user->save();

        $userId = $user->id;

        if ($request['role'] === 'patient') {
            Patient::create([
                'user_id' => $userId,
                'PatientName' => $request['name'],
                'Address' => $request['address'],
                'Phone' => $request['phone'],
                'Email' => $request['email'],
            ]);
        } elseif ($request['role'] === 'doctor') {
            $specialization = Specialization::where('SpecializationName', $request['specializationname'])->first();

            // Check if Specialization is found
            if ($specialization === null) {
                // Handle the case where the specialization is not found
                return redirect()->route('register')->withErrors(['specialization' => 'Specialization not found for ' . $request['specializationname']]);
            }

            // Create a new doctor
            $doctor = Doctor::create([
                'user_id' => $user->id,
                'DoctorName' => $request['name'],
                'ContactInformation' => $request['contact_information'],
                'SpecializationID' => $specialization->SpecializationID,
            ]);
            $doctor->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}