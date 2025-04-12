<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', App\Http\Controllers\UserController::class);

Route::resource('feedback', App\Http\Controllers\FeedbackController::class);
Route::resource('cars', CarsController::class);