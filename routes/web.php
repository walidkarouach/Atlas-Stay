<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelWebController;

Route::get('/', function () {
    return view('home');
});

Route::get('/hotels', [HotelWebController::class, 'index'])
    ->name('hotels.index');

Route::get('/hotels/{id}', [HotelWebController::class, 'show'])
    ->name('hotels.show');

Route::middleware(['auth:sanctum', 'role:Client'])
    ->post('/reservations', [HotelWebController::class, 'storeReservation'])
    ->name('reservations.store');