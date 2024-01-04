<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
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

            return view('admin.dashboard',compact('totalpatients','totaldoctors'));
        }
        
        // If the user doesn't have the required role, go back and display an error message
        return redirect()->route('home')->with('errormessage', ['Unauthorized access.']);
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
        }
        else{
            $user->update(['role' => $user->role]);
        }
        
        $user->update($request->all());
        return redirect()->route('admin.viewusers')->with('success', ['User updated successfully']);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('admin.viewusers')->with('success', 'User deleted successfully');
        }

        return redirect()->route('admin.viewusers')->with('error', 'User not found');
    }
}