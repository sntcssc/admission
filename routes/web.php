<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    // Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    // Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/verify-otp', [VerifyOtpController::class, 'show'])->name('verify.otp');
    Route::post('/verify-otp', [VerifyOtpController::class, 'verify']);
});
