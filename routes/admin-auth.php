<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentRecordsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::get('register', [RegisteredAdminController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredAdminController::class, 'store']);



    Route::get('login', [LoginController::class, 'create'])->name('admin.login');

    Route::post('login', [LoginController::class, 'store']);


});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');





Route::get('attendance', [AttendanceController::class, 'showAttendance'])->name('admin.attendance');


Route::get('studentsList', [StudentController::class, 'index'])->name('admin.studentsList');


Route::post('', [StudentController::class, 'store'])->name('store');

Route::get('student-records/{student_id}', [ StudentRecordsController::class, 'showStudentRecords'])->name('admin.student-records');





// Route to update the student
Route::get('{id}/edit', [StudentController::class,'edit']);

Route::put('{id}/edit', [\App\Http\Controllers\StudentController::class, 'update']);

Route::get('/{id}/delete', [\App\Http\Controllers\StudentController::class, 'destroy']);

Route::post('update/{id}', [StudentController::class, 'updateStudent'])->name('students.update');



Route::get('set_time', [TimeController::class, 'showForm'])->name('admin.set_time');

Route::post('admin.set_time', [TimeController::class, 'setAttendanceTime'])->name('attendance.set-time');

Route::get('attendance/search', [AttendanceController::class, 'searchAttendance'])->name('attendance.search');


    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
});
