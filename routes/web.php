<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('index'); // Main Dashboard View
});

Route::get('/admin.dashboard', function () {
    return view('admin.dashboard'); // Main Dashboard View
});


Route::get('/admin.attendance', [AttendanceController::class, 'showAttendance'])->name('admin.attendance');


Route::get('/admin.studentsList', [StudentController::class, 'index'])->name('admin.studentsList');


Route::get('/admin.add_student', [StudentController::class, 'AddStudent'])->name('admin.add_student');

Route::post('/admin.add_student', [StudentController::class, 'store'])->name('store');


// Route to show the form to edit a student
Route::get('/admin/edit/{id}', [StudentController::class, 'edit'])->name('admin.edit');

// Route to update the student
Route::put('/admin/update_student/{id}', [StudentController::class, 'update'])->name('admin.update_student');







Route::get('/admin.set_time', [TimeController::class, 'showForm'])->name('admin.set_time');

Route::post('/admin.set_time', [TimeController::class, 'setAttendanceTime'])->name('attendance.set-time');






Route::get('/', [AttendanceController::class, 'showAttendanceButtons']);

Route::post('/', [AttendanceController::class, 'submitAttendance'])->name('attendance');

Route::get('/admin/attendance/search', [AttendanceController::class, 'searchAttendance'])->name('attendance.search');




Route::get('/login', function () {
    return view('auth.login'); // Login Page
})->name('login');

