<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ImageController;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'role:Admin'])->get('/admin-test', function () {
    return response()->json([
        'message' => 'Bienvenue Admin',
    ]);
});

Route::get('/hotels', [HotelController::class, 'index']);

Route::middleware(['auth:sanctum', 'role:Propriétaire'])
    ->post('/hotels', [HotelController::class, 'store']);

Route::get('/hotels/{id}', [HotelController::class, 'show']);

Route::middleware(['auth:sanctum', 'role:Propriétaire'])
    ->put('/hotels/{id}', [HotelController::class, 'update']);

Route::middleware(['auth:sanctum', 'role:Propriétaire'])
    ->delete('/hotels/{id}', [HotelController::class, 'destroy']);

    Route::middleware(['auth:sanctum', 'role:Propriétaire'])
    ->post('/hotels/{hotelId}/images', [ImageController::class, 'store']);