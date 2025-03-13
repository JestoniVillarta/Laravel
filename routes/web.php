<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TimeController;

Route::get('/', function () {
    return view('dashboard'); // Main Dashboard View
});

Route::get('/attendance', function () {
    return view('attendance'); // Documentation Page
})->name('attendance');


Route::get('/studentsList', [StudentController::class, 'index'])->name('studentsList');

Route::get('/add_student', [StudentController::class, 'AddStudent'])->name('add_student');

Route::post('/add_student', [StudentController::class, 'store'])->name('store');


Route::get('/set_time', [TimeController::class, 'showForm'])->name('set_time');

Route::post('/set_time', [TimeController::class, 'setAttendanceTime'])->name('attendance.set-time');




Route::get('/login', function () {
    return view('auth.login'); // Login Page
})->name('login');

