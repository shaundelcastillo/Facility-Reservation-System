<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Models\Reservation;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Landing & Authentication
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return view('welcome');
})->name('login');

// Login and Registration Logic
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('welcome');
})->name('logout');


// 2. Student Dashboard
Route::get('/dashboard', function () {
    $userId = Auth::id();
    $total = Reservation::where('user_id', $userId)->count();
    $pending = Reservation::where('user_id', $userId)->where('status', 'pending')->count();
    $approved = Reservation::where('user_id', $userId)->where('status', 'approved')->count();
    $recent = Reservation::with('room')->where('user_id', $userId)->orderBy('created_at', 'desc')->first();

    return view('user.dashboard', compact('total', 'pending', 'approved', 'recent'));
})->name('dashboard')->middleware('auth');


// 3. Student Actions (Reservation & Facilities)
Route::middleware(['auth'])->group(function () {
    Route::get('/reservation', [ReservationController::class, 'myReservations'])->name('reservation');
    Route::get('/facilities', [ReservationController::class, 'index'])->name('facilities');
    Route::get('/calendar', [ReservationController::class, 'showCalendar'])->name('calendar');
    Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservation/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
});


// 4. Admin Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/overview', [AdminController::class, 'dashboard'])->name('admin.home');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
    Route::get('/facilities', [AdminController::class, 'facilities'])->name('admin.adminfacilities');
    Route::post('/reservations/update/{id}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
});