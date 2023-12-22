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

Route::get('/',[HomeController::class,'view_Homepage'])->name('home');

Route::get('/register', [AuthController::class, 'view_Register'])->name('register');
Route::post('/registersuccess', [AuthController::class, 'register'])->name('registersuccess');

Route::get('/login', [AuthController::class, 'view_Login'])->name('login');
Route::post('/loginsuccess', [AuthController::class, 'login'])->name('loginsuccess');