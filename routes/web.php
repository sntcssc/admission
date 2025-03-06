<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\AuthController;


Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('guest:student')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('student.register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/send-otp', [AuthController::class, 'sendOtp']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:student')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
    // Other authenticated routes
    Route::resource('applications', App\Http\Controllers\Student\ApplicationController::class);
});