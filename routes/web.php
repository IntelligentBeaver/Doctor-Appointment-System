<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\auth\AdminDashboardController;
use App\Http\Controllers\auth\DoctorDashboardController;
use App\Http\Controllers\auth\PatientDashboardController;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');


// Route::get('/dashboard', function    () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/testredirection', function () {
    return view('testredirection');
})->middleware(['auth'])->name('testredirection');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/doctordashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');
    Route::get('/patientdashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');


    Route::get('/admindashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/view', [AdminDashboardController::class, 'view_Users'])->name('admin.viewusers');
    Route::get('/admin/{id}/edit', [AdminDashboardController::class, 'edit'])->name('admin.editusers');
    Route::put('/admin/{id}', [AdminDashboardController::class, 'update'])->name('admin.updateusers');
    Route::delete('/admin/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.destroyusers');

});

require __DIR__ . '/auth.php';