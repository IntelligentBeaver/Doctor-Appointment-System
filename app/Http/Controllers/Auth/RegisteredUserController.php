<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\View\View;
use Illuminate\Support\Str;
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
        $specializations = Specialization::pluck('SpecializationName', 'SpecializationID');

        return view('auth.register', compact('specializations'));
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
            'image' => ['nullable','image','max:8192', 'mimes:png,jpg,jpeg,webp'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required'],

            // Requires only if role is patient
            'phone' => ['required_if:role,patient'],
            'address' => ['required_if:role,patient'],

            // Requires only if role is doctor
            'specialization' => ['required_if:role,doctor'],
            'contact_information' => ['required_if:role,doctor'],
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $type = $file->getMimeType();
            $filename =time().'.'. $extension;
            $path = 'images/avatar/';
            $file->move(public_path($path), $filename);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image'=>$path.$filename,
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

            $specialization = Specialization::where('SpecializationName', $request['specialization'])->first();

            // Check if Specialization is found
            if ($specialization === null) {
                // Handle the case where the specialization is not found
                return redirect()->route('register')->withErrors(['specialization' => 'Specialization not found for ' . $request['specialization']]);
            }

            // Create a new doctor
            $doctor = Doctor::create([
                'user_id' => $user->id,
                'DoctorName' => $request['name'],
                'SpecializationID' => $specialization->SpecializationID,
                'ContactInformation' => $request['contact_information']
                // 'SpecializationID' => $request['specialization'],
            ]);
            $doctor->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home')->with('success', ['Account Created Successfully']);
    }
}