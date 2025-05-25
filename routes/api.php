<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\CarsApiController;
use App\Http\Controllers\BookingApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('users', UserApiController::class);
Route::apiResource('bookings',  BookingApiController::class);


Route::get('/cars-api', [CarsApiController::class, 'index']);
Route::get('/cars-api/{id}', [CarsApiController::class, 'show']);
Route::post('/cars-api', [CarsApiController::class, 'store']);
Route::put('/cars-api/{id}', [CarsApiController::class, 'update']);
Route::delete('/cars-api/{id}', [CarsApiController::class, 'destroy']);