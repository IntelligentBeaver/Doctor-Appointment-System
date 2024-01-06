<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\Rules\Password;

class AdminLoginController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            return back()->with('errormessages', ['You have already Logged in. Please Log out and try again.']);
        } else {
            return view('admin.login');
        }
    }
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        if (auth()->user()->role == 'admin')
            return redirect()->route('admin.dashboard');

            else{
            return back()->with('errormessages', ['Invalid Login']);
            }
    }
}