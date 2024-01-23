<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;

class AddSpecializationController extends Controller
{
    public function index()
    {
        $specialization = Specialization::all();
        return view('admin.addspecialization', compact('specialization'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'specializationname' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000']
        ]);

        $user = Specialization::create([
            'SpecializationName' => $request->specializationname,
            'Description' => $request->description,
        ]);
        
        return redirect()->back()->with('success', ["Specialization Added Successfully."]);
    }
}