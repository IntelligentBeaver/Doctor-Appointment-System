<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// HOMEPAGE Route
Route::get('/',[HomeController::class,'view_Homepage'])->name('home');



// Register Page Routes

// This will show register.blade.php when somebody routes to name 'register'
//Calls the view_Register() function to view register.blade.php (Function in app\Http\Controllers\AuthController.php)
Route::get('/register', [AuthController::class, 'view_Register'])->name('register');

// This takes all form data with POST Method
Route::post('/registersuccess', [AuthController::class, 'register'])->name('registersuccess');



//Login Page Routes

// This will show login.blade.php when somebody routes to name 'login'
//Calls the view_Login() function to view login.blade.php (Function in app\Http\Controllers\AuthController.php)
Route::get('/login', [AuthController::class, 'view_Login'])->name('login');

// This takes all form data with POST Method
Route::post('/loginsuccess', [AuthController::class, 'login'])->name('loginsuccess');