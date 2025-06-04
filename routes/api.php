<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\CarsApiController;
use App\Http\Controllers\BookingApiController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'login']);
// *** Registracija (store) bez auth middleware-a ***
Route::post('/users', [UserApiController::class, 'store']);
Route::get('/cars-api', [CarsApiController::class, 'index']);
Route::get('/cars-api/{car}', [CarsApiController::class, 'show']);

// *** Ostali CRUD endpointi za korisnike – samo za admina ***
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [UserApiController::class, 'index'])
        ->middleware('role:admin,creator,guest,reader');;
    Route::get('/users/{user}', [UserApiController::class, 'show'])
        ->middleware('role:admin,creator,guest,reader');;
    Route::put('/users/{user}', [UserApiController::class, 'update'])
        ->middleware('role:admin');;
    Route::patch('/users/{user}', [UserApiController::class, 'update'])
        ->middleware('role:admin');;
    Route::delete('/users/{user}', [UserApiController::class, 'destroy'])
        ->middleware('role:admin');;
});



Route::middleware('auth:sanctum')->group(function () {
    // READ (index, show) → svi uloge: admin, creator, guest, reader

    // CREATE → samo admin i creator
    Route::post('/cars-api', [CarsApiController::class, 'store'])
        ->middleware('role:admin,creator');

    // UPDATE → samo admin
    Route::put('/cars-api/{car}', [CarsApiController::class, 'update'])
        ->middleware('role:admin');
    Route::patch('/cars-api/{car}', [CarsApiController::class, 'update'])
        ->middleware('role:admin');

    // DELETE → samo admin
    Route::delete('/cars-api/{car}', [CarsApiController::class, 'destroy'])
        ->middleware('role:admin');
});


Route::middleware('auth.basic')->group(function () {
    // READ (index, show) → svi uloge: admin, creator, guest, reader
    Route::get('/bookings', [BookingApiController::class, 'index'])
        ->middleware('role:admin,creator,guest,reader');
    Route::get('/bookings/{booking}', [BookingApiController::class, 'show'])
        ->middleware('role:admin,creator,guest,reader');

    // CREATE → samo admin i creator
    Route::post('/bookings', [BookingApiController::class, 'store'])
    ->middleware('role:admin,creator,guest,reader');

    // UPDATE → samo admin
    Route::put('/bookings/{booking}', [BookingApiController::class, 'update'])
    ->middleware('role:admin,creator,guest,reader');
    Route::patch('/bookings/{booking}', [BookingApiController::class, 'update'])
    ->middleware('role:admin,creator,guest,reader');

    // DELETE → samo admin
    Route::delete('/bookings/{booking}', [BookingApiController::class, 'destroy'])
    ->middleware('role:admin,creator,guest,reader');
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    // Ako koristiš Laravel Sanctum:
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Odjavljen.'], 200);
});