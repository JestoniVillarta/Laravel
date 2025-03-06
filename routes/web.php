<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;

Route::get('/', function () {
    return view('Dashboard'); // Main Dashboard View
});

Route::get('/Attendance', function () {
    return view('Attendance'); // Documentation Page
})->name('Attendance');

Route::get('/Students', [StudentsController::class, 'Student'])->name('Students');

Route::get('/Set_time', function () {
    return view('Set_time'); // Documentation Page
})->name('Set_time');



Route::get('/login', function () {
    return view('auth.login'); // Login Page
})->name('login');

