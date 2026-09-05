<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelWebController;
use App\Http\Controllers\WebAuthController;

Route::get('/', function () {
    return view('home');
});


// =========================
// HOTELS
// =========================

Route::get('/hotels', [HotelWebController::class, 'index'])
    ->name('hotels.index');

Route::get('/hotels/{id}', [HotelWebController::class, 'show'])
    ->name('hotels.show');


// =========================
// AUTH
// =========================

Route::get('/login', [WebAuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [WebAuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [WebAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// =========================
// RESERVATIONS
// =========================

Route::middleware(['auth', 'role:Client'])
    ->post('/reservations', [HotelWebController::class, 'storeReservation'])
    ->name('reservations.store');