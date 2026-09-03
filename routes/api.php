<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth:sanctum', 'role:Client'])
    ->post('/reservations', [ReservationController::class, 'store']);

Route::middleware(['auth:sanctum', 'role:Client'])
    ->get('/reservations', [ReservationController::class, 'index']);

Route::middleware(['auth:sanctum', 'role:Client'])
    ->patch('/reservations/{id}/cancel', [ReservationController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'role:Propriétaire'])
    ->get('/proprietaire/reservations', [ReservationController::class, 'ownerReservations']);

Route::middleware(['auth:sanctum', 'role:Propriétaire'])
    ->patch('/reservations/{id}/confirm', [ReservationController::class, 'confirm']);

Route::middleware(['auth:sanctum', 'role:Propriétaire'])
    ->patch('/reservations/{id}/reject', [ReservationController::class, 'reject']);

Route::get('/hotels/{hotelId}/avis', [AvisController::class, 'index']);

Route::middleware(['auth:sanctum', 'role:Client'])->group(function () {

    Route::post('/avis', [AvisController::class, 'store']);

    Route::put('/avis/{id}', [AvisController::class, 'update']);

    Route::delete('/avis/{id}', [AvisController::class, 'destroy']);

});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/notifications', [NotificationController::class, 'index']);

    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);

});

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->get('/admin/users', [UserController::class, 'index']);

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->patch('/admin/users/{id}/role', [UserController::class, 'updateRole']);

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->delete('/admin/users/{id}', [UserController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->get('/admin/hotels', [HotelController::class, 'adminIndex']);

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->patch('/admin/hotels/{id}/validate', [HotelController::class, 'validate']);

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->patch('/admin/hotels/{id}/reject', [HotelController::class, 'reject']);

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->delete('/admin/hotels/{id}', [HotelController::class, 'adminDestroy']);

Route::middleware('auth:sanctum')
    ->get('/profile', [UserController::class, 'profile']);

Route::middleware('auth:sanctum')
    ->put('/profile', [UserController::class, 'updateProfile']);

Route::middleware('auth:sanctum')
    ->put('/profile/password', [UserController::class, 'changePassword']);

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->get('/admin/avis', [AvisController::class, 'adminIndex']);

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->delete('/admin/avis/{id}', [AvisController::class, 'adminDestroy']);

Route::middleware('auth:sanctum')
    ->get('/notifications/unread', [NotificationController::class, 'unread']);

Route::middleware('auth:sanctum')
    ->patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead']);

Route::middleware(['auth:sanctum', 'role:Propriétaire'])
    ->delete('/images/{id}', [ImageController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'role:Propriétaire'])
    ->patch('/reservations/{id}/cancel-owner', [ReservationController::class, 'cancelByOwner']);

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->get('/admin/reservations', [ReservationController::class, 'adminIndex']);