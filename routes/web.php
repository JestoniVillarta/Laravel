<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TimeController;

Route::get('/', function () {
    return view('Dashboard'); // Main Dashboard View
});

Route::get('/Attendance', function () {
    return view('Attendance'); // Documentation Page
})->name('Attendance');


Route::get('/StudentsList', [StudentController::class, 'index'])->name('StudentsList');

Route::get('/Add_student', [StudentController::class, 'AddStudent'])->name('Add_student');

Route::post('/Add_student', [StudentController::class, 'store'])->name('store');


Route::get('/Set_time', [TimeController::class, 'showForm'])->name('Set_time');

Route::post('/Set_time', [TimeController::class, 'setAttendanceTime'])->name('attendance.set-time');




Route::get('/login', function () {
    return view('auth.login'); // Login Page
})->name('login');

