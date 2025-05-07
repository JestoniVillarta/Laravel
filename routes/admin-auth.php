<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentRecordsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\rankingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\reportsController;

Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::get('register', [RegisteredAdminController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredAdminController::class, 'store']);



    Route::get('login', [LoginController::class, 'create'])->name('admin.login');

    Route::post('login', [LoginController::class, 'store']);


});

Route::prefix('admin')->middleware('auth:admin')->group(function () {


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');





Route::get('attendance', [AttendanceController::class, 'showAttendance'])->name('admin.attendance');


Route::get('studentsList', [StudentController::class, 'index'])->name('admin.studentsList');


Route::post('', [StudentController::class, 'store'])->name('store');

Route::get('student-records/{student_id}', [ StudentRecordsController::class, 'showStudentRecords'])->name('admin.student-records');





// Route to update the student
Route::get('{id}/edit', [StudentController::class,'edit']);

Route::put('{id}/edit', [StudentController::class, 'update']);

Route::get('/{id}/delete', [StudentController::class, 'destroy']);

Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');




Route::get('set_time', [TimeController::class, 'showForm'])->name('admin.set_time');

Route::post('admin.set_time', [TimeController::class, 'setAttendanceTime'])->name('attendance.set-time');

Route::get('attendance/search', [AttendanceController::class, 'searchAttendance'])->name('attendance.search');


Route::get('/ranking', [rankingController::class, 'studentsRanking'])->name('admin.ranking');


Route::get('/reports', [reportsController::class, 'index'])->name('admin.reports');





    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
});
