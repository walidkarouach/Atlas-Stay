<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HotelWebController;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\ReservationWebController;
use App\Http\Controllers\NotificationWebController;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});


/*
|--------------------------------------------------------------------------
| HOTELS
|--------------------------------------------------------------------------
*/

// Liste des hôtels
Route::get('/hotels', [HotelWebController::class, 'index'])
    ->name('hotels.index');

// Détails d'un hôtel
Route::get('/hotels/{id}', [HotelWebController::class, 'show'])
    ->name('hotels.show');


/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [WebAuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [WebAuthController::class, 'login'])
    ->name('login.submit');

// Logout
Route::post('/logout', [WebAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| RESERVATIONS - CLIENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Client'])->group(function () {

    // Créer une réservation
    Route::post('/reservations', [HotelWebController::class, 'storeReservation'])
        ->name('reservations.store');

    // Voir mes réservations
    Route::get('/mes-reservations', [ReservationWebController::class, 'index'])
        ->name('reservations.index');

    // Annuler une réservation
    Route::patch('/mes-reservations/{id}/cancel', [HotelWebController::class, 'cancelReservation'])
        ->name('reservations.cancel');

});


/*
|--------------------------------------------------------------------------
| NOTIFICATIONS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/notifications', [NotificationWebController::class, 'index'])
        ->name('notifications.index');

    Route::patch('/notifications/read-all', [NotificationWebController::class, 'markAllAsRead'])
        ->name('notifications.read-all');

    Route::patch('/notifications/{id}/read', [NotificationWebController::class, 'markAsRead'])
        ->name('notifications.read');

});