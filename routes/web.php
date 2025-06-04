<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController; 
use App\Http\Controllers\Auth\LoginController;  
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', App\Http\Controllers\UserController::class);

Route::resource('feedback', App\Http\Controllers\FeedbackController::class);
Route::resource('cars', CarsController::class)->middleware(['auth', 'role:admin']);
Route::resource('booking', App\Http\Controllers\BookingController::class);
Route::resource('payment', PaymentController::class);
Route::resource('admin', AdminController::class);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);



Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);