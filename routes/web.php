<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', App\Http\Controllers\UserController::class);

Route::resource('feedback', App\Http\Controllers\FeedbackController::class);
Route::resource('cars', CarsController::class);
Route::resource('booking', App\Http\Controllers\BookingController::class);
Route::resource('payment', PaymentController::class);
Route::resource('admin', AdminController::class);
