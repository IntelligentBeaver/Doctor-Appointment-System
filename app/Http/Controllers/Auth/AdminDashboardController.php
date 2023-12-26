<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{

    public function __construct()
    {
        // You can also perform role-based checks in the constructor if needed
        $this->middleware('auth');
    }
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $users = User::all();

            return view('admin.dashboard');
        }
        // If the user doesn't have the required role, you can redirect or display an error message
        return redirect()->route('home')->with('error', 'Unauthorized access');
    }

    public function view_Users()
    {
        if (auth()->user()->role == 'admin') {
            $users = User::all();

            return view('admin.users.index', compact('users'));
        }

        // If the user doesn't have the required role, you can redirect or display an error message
        return redirect()->route('home')->with('error', 'Unauthorized access');
    }
    public function edit($id)
    {
        $users = User::find($id);

        return view('admin.users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request and update the user information
        $request->validate([
            'name' => 'required',
            // Add other validation rules as needed
        ]);

        $user = User::find($id);
        $user->update($request->all());

        return redirect()->route('admin.viewusers')->with('success', 'User updated successfully');
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