<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('Dashboard'); // Main Dashboard View
});

Route::get('/Attendance', function () {
    return view('Attendance'); // Documentation Page
})->name('Attendance');


Route::get('/StudentsList', [StudentController::class, 'index'])->name('StudentsList');
Route::get('/Add_student', [StudentController::class, 'AddStudent'])->name('Add_student');

Route::post('/Add_student', [StudentController::class, 'store'])->name('store');


Route::get('/Set_time', function () {
    return view('Set_time'); // Documentation Page
})->name('Set_time');



Route::get('/login', function () {
    return view('auth.login'); // Login Page
})->name('login');

