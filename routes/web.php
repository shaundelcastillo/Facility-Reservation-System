<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// 1. Landing & Authentication
Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('/login', function () { return view('welcome'); })->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('welcome');
})->name('logout');

// 2. Student Dashboard
Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// 3. Student Actions (Grouped by Authentication)
Route::middleware(['auth'])->group(function () {
    // My Reservations list
    Route::get('/reservation', [ReservationController::class, 'myReservations'])->name('reservation');
    
    // Facilities overview
    Route::get('/facilities', [FacilitiesController::class, 'index'])->name('facilities');
    
    // Calendar & Booking Actions
    Route::get('/calendar', [ReservationController::class, 'showCalendar'])->name('calendar');
    Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservation/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
});

// 4. Admin Routes Section
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/overview', [AdminController::class, 'dashboard'])->name('admin.home');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
    
    // Update reservation status (Approve/Reject)
    Route::post('/reservations/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    
    // Delete Reservation 
    Route::delete('/reservations/{id}', [AdminController::class, 'destroyReservation'])->name('admin.reservations.destroy');

    // Admin Facilities Management
    Route::get('/facilities', [AdminController::class, 'facilities'])->name('admin.facilities');
    
    Route::post('/facilities', [AdminController::class, 'storeFacility'])->name('admin.facilities.store');
    
    Route::put('/facilities/{id}', [AdminController::class, 'updateFacility'])->name('admin.facilities.update');
    
    Route::delete('/facilities/{id}', [AdminController::class, 'destroyFacility'])->name('admin.facilities.destroy');
});