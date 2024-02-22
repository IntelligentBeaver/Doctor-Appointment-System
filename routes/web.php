<?php

use App\Models\Specialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\DoctorTimeSlotController;
use App\Http\Controllers\AddSpecializationController;
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

// This route will get called if something fails.
Route::get('/denied', function () {
    // dd(session());
    echo "Authentication failed or Permission Denied.";
})->name('denied');

// This will take us to admin login page.
Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'store']);

Route::get('/testredirection', function () {
    return view('testredirection');
})->middleware(['auth'])->name('testredirection');


// Contact Us Page
Route::get('/contacts', [ContactsController::class,'create'])->name('contacts');
Route::post('/contacts', [ContactsController::class,'store'])->middleware('web');

Route::get('/appointments',[AppointmentsController::class,'create'])->name('appointments');



// Route::get('/appointments/book',[AppointmentsController::class,'store'])->name('bookappointment');

/*
|--------------------------------------------------------------------------
| Routing Technique
|--------------------------------------------------------------------------
|
|    1. group() method--> for grouping Routes for common middleware
|    2. name()  --> gives a name to the routes so that we can use them in other places like Redirect::to()...
|
*/
Route::middleware(['auth','disable.cache'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'checkadmin:admin','disable.cache'])->name('admin.')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard/appointment',[AdminDashboardController::class,'viewAppointments'])->name('appointment.view');
    Route::delete('/appointment/{AppointmentID}', [AdminDashboardController::class, 'destroyAppointment'])->name('appointment.destroy');


    Route::get('/admin/view', [AdminDashboardController::class, 'view_Users'])->name('viewusers');
    Route::get('/admin/{id}/edit', [AdminDashboardController::class, 'edit'])->name('editusers');
    Route::put('/admin/{id}', [AdminDashboardController::class, 'update'])->name('updateusers');
    Route::delete('/admin/{id}', [AdminDashboardController::class, 'destroy'])->name('destroyusers');
    Route::get('/admin/addspecialization', [AddSpecializationController::class,'index'])->name('addspecialization');
    Route::post('/admin/addspecialization', [AddSpecializationController::class, 'store']);
    Route::get('/admin/timeslots', [DoctorTimeSlotController::class, 'create'])->name('timeslots.create');
    Route::post('/admin/timeslots',[DoctorTimeSlotController::class,'store'])->name('timeslots.store');
});

Route::middleware(['auth', 'checkpatient:patient','disable.cache'])->name('patient.')->group(function () {
    Route::get('/patient/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');
    Route::get('/patient/appointments/view', [PatientDashboardController::class,'viewAppointments'])->name('appointment.view');
    Route::delete('/appointment/{AppointmentID}', [PatientDashboardController::class, 'destroy'])->name('appointment.destroy');
    
    Route::get('/appointment/book/{doctorId}/{availabilityId}/{timeslotID}/{appointdate}/{startTime}/{endTime}', [AppointmentsController::class,'book'])->name('appointment.book');
    Route::post('/appointment/book', [AppointmentsController::class,'store'])->name('appointment.store');
});





// Route::middleware(['auth', 'checkdoctor:doctor','disable.cache'])->get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');

Route::middleware(['auth', 'checkdoctor:doctor', 'disable.cache'])->name('doctor.')->group(function () {
    Route::get('/doctor/dashboard', [DoctorDashboardController::class,'index'])->name('dashboard');
});




Route::get('/payment/{appointmentID}', [EsewaController::class, 'create'])->name('payments.create')->middleware('auth');
Route::post('/payment',[EsewaController::class,'store'])->name('payments.store')->middleware('auth');
Route::get('/success', [EsewaController::class,'paymentSuccess'])->middleware('auth');
Route::get('/failure', [EsewaController::class,'paymentFailure'])->middleware('auth');

require __DIR__ . '/auth.php';