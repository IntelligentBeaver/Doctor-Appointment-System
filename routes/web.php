<?php

use Illuminate\Support\Facades\Auth;
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


// This will take us to admin login page.
    Route::get('/admin',function(){
        return view('admin.login');
    })->name('admin.login');

Route::get('/testredirection', function () {
    return view('testredirection');
})->middleware(['auth'])->name('testredirection');

// This route will get called if something fails.
Route::get('/denied', function () {
    // dd(session());
    echo "Authentication failed or Permission Denied.";
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Previous technique for using middleware 'auth', 'checkadmin','checkpatient' and 'checkdoctor' (repetitive)

    //For ADMIN:
        // Route::middleware(['auth', 'checkadmin'])->get('/admindashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        // Route::middleware(['auth', 'checkadmin'])->get('/admin/view', [AdminDashboardController::class, 'view_Users'])->name('admin.viewusers');
        // Route::middleware(['auth', 'checkadmin'])->get('/admin/{id}/edit', [AdminDashboardController::class, 'edit'])->name('admin.editusers');
        // Route::middleware(['auth', 'checkadmin'])->get('/admin/{id}', [AdminDashboardController::class, 'update'])->name('admin.updateusers');
        // Route::middleware(['auth', 'checkadmin'])->get('/admin/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.destroyusers');

    //For PATIENT:
        // Route::get('/patientdashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');
    
    //For DOCTOR
        // Route::get('/doctordashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');


// NEW technique:
    // 1. group() method--> for grouping Routes for common middleware
    // 2. name() method--> for providing common name for the routes. (admin.dashboard)====(dashboard)
Route::middleware(['auth', 'checkadmin:admin'])->name('admin.')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/view', [AdminDashboardController::class, 'view_Users'])->name('viewusers');
    Route::get('/admin/{id}/edit', [AdminDashboardController::class, 'edit'])->name('editusers');
    Route::put('/admin/{id}', [AdminDashboardController::class, 'update'])->name('updateusers');
    Route::delete('/admin/{id}', [AdminDashboardController::class, 'destroy'])->name('destroyusers');
});

Route::middleware(['auth', 'checkpatient:patient'])->get('/patient/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');

Route::middleware(['auth', 'checkdoctor:doctor'])->get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');


require __DIR__ . '/auth.php';