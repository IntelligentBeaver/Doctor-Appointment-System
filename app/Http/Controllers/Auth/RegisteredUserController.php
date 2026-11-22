<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'image' => ['nullable', 'image', 'max:8192', 'mimes:png,jpg,jpeg,webp'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Only patients and doctors can self-register. Admins are created by an existing admin.
            'role' => ['required', Rule::in(['patient', 'doctor'])],

            // Requires only if role is patient
            'phone' => ['required_if:role,patient', 'nullable', 'string', 'max:30'],
            'address' => ['required_if:role,patient', 'nullable', 'string', 'max:255'],

            // Requires only if role is doctor
            'specialization' => ['required_if:role,doctor', 'nullable', 'string', Rule::exists('specializations', 'SpecializationName')],
            'contact_information' => ['required_if:role,doctor', 'nullable', 'string', 'max:255'],
        ]);

        $path = 'images/avatar/';
        $image = $path.'placeholder.jpg';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // hashName() gives a random, collision-free file name with a safe extension.
            $filename = $file->hashName();
            $file->move(public_path($path), $filename);
            $image = $path.$filename;
        }

        $user = DB::transaction(function () use ($request, $image) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $image,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            if ($request->role === 'patient') {
                Patient::create([
                    'user_id' => $user->id,
                    'PatientName' => $request->name,
                    'Address' => $request->address,
                    'Phone' => $request->phone,
                    'Email' => $request->email,
                ]);
            } else {
                $specialization = Specialization::where('SpecializationName', $request->specialization)->firstOrFail();

                Doctor::create([
                    'user_id' => $user->id,
                    'DoctorName' => $request->name,
                    'SpecializationID' => $specialization->SpecializationID,
                    'ContactInformation' => $request->contact_information,
                ]);
            }

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home')->with('success', ['Account Created Successfully']);
    }
}
