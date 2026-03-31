<?php

use Illuminate\Support\Facades\Route;

// This is the default Laravel welcome page
Route::get('/', function () {
    return view('user.dashboard');
});

// This is for Facilities Dashboard
Route::get('/facilities', function () {
    return view('layout.facilities');
});

Route::get('/', function () {
    return view('user.dashboard');
})->name('logout');

Route::get('/reservation', function () {
    return view('layout.reservation');
})->name('logout');