<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Landing & Authentication
// 1. Landing & Authentication
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ADD THESE TWO LINES:
Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('welcome');
})->name('logout');

// ... rest of your student and admin routes ...

// 2. Student Dashboard
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('dashboard');

// 3. Facilities Page
Route::get('/facilities', function () {
    return view('user.facilities'); 
})->name('facilities');

// 4. Reservation & Calendar Pages
Route::get('/reservation', function () {
    return view('user.reservation'); // Note: Changed to user.reservation to match your file structure
})->name('reservation');

Route::get('/calendar', function () {
    return view('user.calendar');
})->name('calendar');

// 5. Database Logic - Handling the "Submit Reservation" button
Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');

Route::prefix('admin')->group(function () {
    // Page Routes
    Route::get('/overview', [AdminController::class, 'dashboard'])->name('admin.home');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
    Route::get('/facilities', [AdminController::class, 'facilities'])->name('admin.facilities');

    // API Routes (Called by JS)
    Route::get('/api/dashboard-data', [AdminController::class, 'getDashboardData']);
    Route::get('/api/all-reservations', [AdminController::class, 'getAllReservations']);
    Route::post('/api/update-status', [AdminController::class, 'updateStatus']);
});