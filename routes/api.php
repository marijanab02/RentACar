<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/cars-api',[App\Http\Controllers\CarsApiController::class, 'index']);
Route::get('/cars-api/{id}',[App\Http\Controllers\CarsApiController::class, 'show']);
Route::post('/cars-api',[App\Http\Controllers\CarsApiController::class, 'store']);
Route::put('/cars-api/{id}',[App\Http\Controllers\CarsApiController::class, 'update']);
Route::delete('/cars-api/{id}',[App\Http\Controllers\CarsApiController::class, 'destroy']);
