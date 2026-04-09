<?php

use Illuminate\Support\Facades\Route;

// 1. The Landing Page (Login/Signup)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 2. The Student Dashboard
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('dashboard');

// 3. Facilities Page
Route::get('/facilities', function () {
    return view('layout.facilities');
})->name('facilities');

// 4. Reservation Page
Route::get('/reservation', function () {
    return view('layout.reservation');
})->name('reservation');

Route::get('/calendar', function () {
    return view('user.calendar');
})->name('calendar');


Route::post('/logout', function () {
    return redirect()->route('welcome'); 
})->name('logout');