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

    public function store(Request $request):RedirectResponse
    {
        
        $user = Contact::create([
            'Email'=> $request->email,
            'Phone'=> $request->phone,
            'Description'=> $request->description
        ]);

        if ($user->save()) {
            return redirect()->route('home')->with('success', ['Message sent Successfully']);
        }    
        return redirect()->route('home')->with('error', ['bruh']);
    }
}