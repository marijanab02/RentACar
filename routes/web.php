<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', App\Http\Controllers\UserController::class);

Route::resource('feedback', App\Http\Controllers\FeedbackController::class);