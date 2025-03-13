<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TimeController;

Route::get('/', function () {
    return view('admin.dashboard'); // Main Dashboard View
});

Route::get('/admin.attendance', function () {
    return view('admin.attendance'); // Documentation Page
})->name('admin.attendance');


Route::get('/admin.studentsList', [StudentController::class, 'index'])->name('admin.studentsList');

Route::get('/admin.add_student', [StudentController::class, 'AddStudent'])->name('admin.add_student');

Route::post('/admin.add_student', [StudentController::class, 'store'])->name('store');


Route::get('/admin.set_time', [TimeController::class, 'showForm'])->name('admin.set_time');

Route::post('/admin.set_time', [TimeController::class, 'setAttendanceTime'])->name('attendance.set-time');




Route::get('/login', function () {
    return view('auth.login'); // Login Page
})->name('login');

