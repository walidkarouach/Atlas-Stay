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


// =========================
// AUTH
// =========================

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});


// =========================
// HOTELS - PUBLIC
// =========================

Route::get('/hotels', [HotelController::class, 'index']);

Route::get('/hotels/{id}', [HotelController::class, 'show']);


// =========================
// HOTELS - PROPRIETAIRE
// =========================

Route::middleware(['auth:sanctum', 'role:Propriétaire'])->group(function () {

    Route::post('/hotels', [HotelController::class, 'store']);

    Route::put('/hotels/{id}', [HotelController::class, 'update']);

    Route::delete('/hotels/{id}', [HotelController::class, 'destroy']);

    Route::post('/hotels/{hotelId}/images', [ImageController::class, 'store']);

    Route::delete('/images/{id}', [ImageController::class, 'destroy']);

});


// =========================
// RESERVATIONS - CLIENT
// =========================

Route::middleware(['auth:sanctum', 'role:Client'])->group(function () {

    Route::post('/reservations', [ReservationController::class, 'store']);

    Route::get('/reservations', [ReservationController::class, 'index']);

    Route::patch('/reservations/{id}/cancel', [ReservationController::class, 'destroy']);

});


// =========================
// RESERVATIONS - PROPRIETAIRE
// =========================

Route::middleware(['auth:sanctum', 'role:Propriétaire'])->group(function () {

    Route::get('/proprietaire/reservations', [ReservationController::class, 'ownerReservations']);

    Route::patch('/reservations/{id}/confirm', [ReservationController::class, 'confirm']);

    Route::patch('/reservations/{id}/reject', [ReservationController::class, 'reject']);

    Route::patch('/reservations/{id}/cancel-owner', [ReservationController::class, 'cancelByOwner']);

});


// =========================
// AVIS - PUBLIC
// =========================

Route::get('/hotels/{hotelId}/avis', [AvisController::class, 'index']);


// =========================
// AVIS - CLIENT
// =========================

Route::middleware(['auth:sanctum', 'role:Client'])->group(function () {

    Route::post('/avis', [AvisController::class, 'store']);

    Route::put('/avis/{id}', [AvisController::class, 'update']);

    Route::delete('/avis/{id}', [AvisController::class, 'destroy']);

});


// =========================
// NOTIFICATIONS
// =========================

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/notifications', [NotificationController::class, 'index']);

    Route::get('/notifications/unread', [NotificationController::class, 'unread']);

    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);

    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead']);

});


// =========================
// PROFILE
// =========================

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [UserController::class, 'profile']);

    Route::put('/profile', [UserController::class, 'updateProfile']);

    Route::put('/profile/password', [UserController::class, 'changePassword']);

});


// =========================
// ADMIN - USERS
// =========================

Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {

    Route::get('/admin/users', [UserController::class, 'index']);

    Route::patch('/admin/users/{id}/role', [UserController::class, 'updateRole']);

    Route::delete('/admin/users/{id}', [UserController::class, 'destroy']);

});


// =========================
// ADMIN - HOTELS
// =========================

Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {

    Route::get('/admin/hotels', [HotelController::class, 'adminIndex']);

    Route::patch('/admin/hotels/{id}/validate', [HotelController::class, 'validate']);

    Route::patch('/admin/hotels/{id}/reject', [HotelController::class, 'reject']);

    Route::delete('/admin/hotels/{id}', [HotelController::class, 'adminDestroy']);

});


// =========================
// ADMIN - RESERVATIONS
// =========================

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->get('/admin/reservations', [ReservationController::class, 'adminIndex']);


// =========================
// ADMIN - AVIS
// =========================

Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {

    Route::get('/admin/avis', [AvisController::class, 'adminIndex']);

    Route::delete('/admin/avis/{id}', [AvisController::class, 'adminDestroy']);

});


// =========================
// ADMIN - STATISTICS
// =========================

Route::middleware(['auth:sanctum', 'role:Admin'])
    ->get('/admin/statistics', [UserController::class, 'statistics']);