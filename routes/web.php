<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('index'); // Main Dashboard View
});


Route::get('/', [AttendanceController::class, 'showAttendanceButtons']);

Route::post('/', [AttendanceController::class, 'submitAttendance'])->name('attendance');




require __DIR__.'/admin-auth.php';
