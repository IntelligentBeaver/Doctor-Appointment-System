<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function create()
    {
        return view('contacts');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'description' => ['required', 'string', 'max:2000'],
        ]);

        Contact::create([
            'Email' => $validated['email'],
            'Phone' => $validated['phone'],
            'Description' => $validated['description'],
        ]);

        return redirect()->route('home')->with('success', ['Message sent Successfully']);
    }
}
