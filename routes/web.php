<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Dashboard'); // Main Dashboard View
});

Route::get('/Attendance', function () {
    return view('Attendance'); // Documentation Page
})->name('Attendance');

Route::get('/Student', function () {
    return view('Student'); // Documentation Page
})->name('Student');

Route::get('/Set_time', function () {
    return view('Set_time'); // Documentation Page
})->name('Set_time');



Route::get('/login', function () {
    return view('auth.login'); // Login Page
})->name('login');

