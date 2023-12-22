<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
     public function register(Request $request){
         return view('registersuccess');
    }
    public function view_Register(){
        return view('register');
    }
    public function login(Request $request){
         return view('loginsuccess');
    }
    public function view_Login(){
        return view('login');
    }
}