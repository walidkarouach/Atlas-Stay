<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HotelWebController;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\ReservationWebController;
use App\Http\Controllers\NotificationWebController;
use App\Http\Controllers\ProfileWebController;


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

Route::get('/hotels', [HotelWebController::class, 'index'])
    ->name('hotels.index');

Route::get('/hotels/{id}', [HotelWebController::class, 'show'])
    ->name('hotels.show');


/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

Route::get('/login', [WebAuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [WebAuthController::class, 'login'])
    ->name('login.submit');

Route::get('/register', [WebAuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [WebAuthController::class, 'register'])
    ->name('register.submit');

Route::post('/logout', [WebAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| RESERVATIONS - CLIENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Client'])->group(function () {

    Route::post('/reservations', [HotelWebController::class, 'storeReservation'])
        ->name('reservations.store');

    Route::get('/mes-reservations', [ReservationWebController::class, 'index'])
        ->name('reservations.index');

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


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Afficher le profil
    Route::get('/profile', [ProfileWebController::class, 'index'])
        ->name('profile.index');

    // Afficher formulaire de modification
    Route::get('/profile/edit', [ProfileWebController::class, 'edit'])
        ->name('profile.edit');

    // Enregistrer les modifications
    Route::put('/profile', [ProfileWebController::class, 'update'])
        ->name('profile.update');

});