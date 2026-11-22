<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AdminLoginController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            return back()->with('errormessages', ['You have already Logged in. Please Log out and try again.']);
        }

        return view('admin.login');
    }

    public function store(LoginRequest $request)
    {
        // LoginRequest::authenticate() applies the same rate limiting as the main login form.
        $request->authenticate();

        if ($request->user()->role !== 'admin') {
            // Valid credentials, wrong account type: don't leave a non-admin session behind.
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withInput($request->only('email'))->with('errormessages', ['Invalid Login']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }
}
