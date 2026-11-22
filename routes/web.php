<?php

use App\Models\Specialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\EsewaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\TimeSlotController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Patient\DashboardController as PatientDashboardController;

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

// This route will get called if something fails.
Route::get('/denied', function () {
    echo "Authentication failed or Permission Denied.";
})->name('denied');


/*
|--------------------------------------------------------------------------
| Routing Technique
|--------------------------------------------------------------------------
|
|    1. group() method--> for grouping Routes for common middleware
|    2. name()  --> gives a name to the routes so that we can use them in other places like Redirect::to()...
|
*/


/*---------------------------------------------------------------------------------------------------------------*/


/*
|--------------------------------------------------------------------------
| Route for Home
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');



/*
|--------------------------------------------------------------------------
| Routes for Login
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [LoginController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'store']);



/*
|--------------------------------------------------------------------------
| Routes for Contacts Page
|--------------------------------------------------------------------------
*/
Route::get('/contacts', [ContactController::class, 'create'])->name('contacts');
Route::post('/contacts', [ContactController::class, 'store'])->middleware('throttle:5,1');



/*
|--------------------------------------------------------------------------
| Routes for Appointment
|--------------------------------------------------------------------------
*/
Route::get('/appointments', [AppointmentController::class, 'create'])->name('appointments');
Route::get('/bookappointment', [AppointmentController::class, 'view'])->name('about');



/*
|--------------------------------------------------------------------------
| Routes for profile
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'disable.cache'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



/*
|--------------------------------------------------------------------------
| Routes for Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'checkadmin:admin', 'disable.cache'])->name('admin.')->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard/appointment', [AdminDashboardController::class, 'viewAppointments'])->name('appointment.view');
    Route::delete('/admin/appointment/{AppointmentID}', [AdminDashboardController::class, 'destroyAppointment'])->name('appointment.destroy');
    
    // CRUD Operation Routes for Admin
    Route::get('/admin/view', [AdminDashboardController::class, 'view_Users'])->name('viewusers');
    Route::get('/admin/{id}/edit', [AdminDashboardController::class, 'edit'])->name('editusers');
    Route::put('/admin/{id}', [AdminDashboardController::class, 'update'])->name('updateusers');
    Route::delete('/admin/{id}', [AdminDashboardController::class, 'destroy'])->name('destroyusers');
    
    // Add Specialization Routes
    Route::get('/admin/addspecialization', [SpecializationController::class, 'index'])->name('addspecialization');
    Route::post('/admin/addspecialization', [SpecializationController::class, 'store']);
    
    // Add Timeslots Routes
    Route::get('/admin/timeslots', [TimeSlotController::class, 'create'])->name('timeslots.create');
    Route::post('/admin/timeslots', [TimeSlotController::class, 'store'])->name('timeslots.store');
});



/*
|--------------------------------------------------------------------------
| Routes for Patient
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'checkpatient:patient', 'disable.cache'])->name('patient.')->group(function () {

    Route::get('/patient/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');
    Route::get('/patient/appointments/view', [PatientDashboardController::class, 'viewAppointments'])->name('appointment.view');
    Route::delete('/appointment/{AppointmentID}', [PatientDashboardController::class, 'destroy'])->name('appointment.destroy');
    
    // Book Appointment
    Route::get('/appointment/book/{doctorId}/{availabilityId}/{timeslotID}/{appointdate}/{startTime}/{endTime}', [AppointmentController::class, 'book'])->name('appointment.book');
    Route::post('/appointment/book', [AppointmentController::class, 'store'])->name('appointment.store');
});


// Route::middleware(['auth', 'checkdoctor:doctor','disable.cache'])->get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');



/*
|--------------------------------------------------------------------------
| Routes for Doctor
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'checkdoctor:doctor', 'disable.cache'])->name('doctor.')->group(function () {
    Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/doctor/dashboard/appointment', [DoctorDashboardController::class, 'viewAppointments'])->name('appointment.view');
    Route::delete('/doctor/appointment/{AppointmentID}', [DoctorDashboardController::class, 'destroyAppointment'])->name('appointment.destroy');
});



/*
|--------------------------------------------------------------------------
| Routes for Payment
|--------------------------------------------------------------------------
*/
Route::get('/payment/{appointmentID}', [EsewaController::class, 'create'])->name('payments.create')->middleware('auth');
Route::post('/payment', [EsewaController::class, 'store'])->name('payments.store')->middleware('auth');
Route::get('/success', [EsewaController::class, 'paymentSuccess'])->name('payments.success')->middleware('auth');
Route::get('/failure', [EsewaController::class, 'paymentFailure'])->name('payments.failure')->middleware('auth');



// OBSOLETE CODE
// Route::get('/testredirection', function () {
    //     return view('testredirection');
    // })->middleware(['auth'])->name('testredirection');
    require __DIR__ . '/auth.php';