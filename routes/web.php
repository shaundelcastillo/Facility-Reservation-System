<?php

use Illuminate\Support\Facades\Route;

// This is the default Laravel welcome page
Route::get('/', function () {
    return view('welcome');
});

// This is for Facilities Dashboard
Route::get('/facilities', function () {
    return view('layout.facilities'); 
});