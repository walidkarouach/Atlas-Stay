<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HotelWebController;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\ReservationWebController;
use App\Http\Controllers\NotificationWebController;
use App\Http\Controllers\ProfileWebController;
use App\Http\Controllers\AvisWebController;
use App\Http\Controllers\ProprietaireDashboardController;
use App\Http\Controllers\ProprietaireHotelWebController;
use App\Http\Controllers\ImageWebController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserWebController;
use App\Http\Controllers\AdminHotelWebController;
use App\Http\Controllers\AdminReservationWebController;
use App\Http\Controllers\AdminAvisWebController;


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

Route::get('/hotels', [
    HotelWebController::class,
    'index'
])->name('hotels.index');

Route::get('/hotels/{id}', [
    HotelWebController::class,
    'show'
])->name('hotels.show');


/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

Route::get('/login', [
    WebAuthController::class,
    'showLogin'
])->name('login');

Route::post('/login', [
    WebAuthController::class,
    'login'
])->name('login.submit');

Route::get('/register', [
    WebAuthController::class,
    'showRegister'
])->name('register');

Route::post('/register', [
    WebAuthController::class,
    'register'
])->name('register.submit');

Route::post('/logout', [
    WebAuthController::class,
    'logout'
])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| PROPRIETAIRE
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:Propriétaire'
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Propriétaire
    |--------------------------------------------------------------------------
    */

    Route::get('/proprietaire/dashboard', [
        ProprietaireDashboardController::class,
        'index'
    ])->name('proprietaire.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Hôtels Propriétaire
    |--------------------------------------------------------------------------
    */

    Route::get('/proprietaire/hotels', [
        ProprietaireHotelWebController::class,
        'index'
    ])->name('proprietaire.hotels.index');

    Route::get('/proprietaire/hotels/create', [
        ProprietaireHotelWebController::class,
        'create'
    ])->name('proprietaire.hotels.create');

    Route::post('/proprietaire/hotels', [
        ProprietaireHotelWebController::class,
        'store'
    ])->name('proprietaire.hotels.store');

    Route::get('/proprietaire/hotels/{id}/edit', [
        ProprietaireHotelWebController::class,
        'edit'
    ])->name('proprietaire.hotels.edit');

    Route::put('/proprietaire/hotels/{id}', [
        ProprietaireHotelWebController::class,
        'update'
    ])->name('proprietaire.hotels.update');

    Route::delete('/proprietaire/hotels/{id}', [
        ProprietaireHotelWebController::class,
        'destroy'
    ])->name('proprietaire.hotels.destroy');


    /*
    |--------------------------------------------------------------------------
    | Images Propriétaire
    |--------------------------------------------------------------------------
    */

    Route::get('/proprietaire/hotels/{id}/images', [
        ProprietaireHotelWebController::class,
        'images'
    ])->name('proprietaire.hotels.images');

    Route::post('/proprietaire/hotels/{hotelId}/images', [
        ImageWebController::class,
        'store'
    ])->name('proprietaire.hotels.images.store');

    Route::delete('/proprietaire/images/{id}', [
        ImageWebController::class,
        'destroy'
    ])->name('proprietaire.images.destroy');


    /*
    |--------------------------------------------------------------------------
    | Réservations Propriétaire
    |--------------------------------------------------------------------------
    */

    Route::get('/proprietaire/reservations', [
        ReservationWebController::class,
        'ownerIndex'
    ])->name('proprietaire.reservations.index');

    Route::patch('/proprietaire/reservations/{id}/confirm', [
        ReservationWebController::class,
        'confirm'
    ])->name('proprietaire.reservations.confirm');

    Route::patch('/proprietaire/reservations/{id}/reject', [
        ReservationWebController::class,
        'reject'
    ])->name('proprietaire.reservations.reject');

    Route::patch('/proprietaire/reservations/{id}/cancel', [
        ReservationWebController::class,
        'cancel'
    ])->name('proprietaire.reservations.cancel');

});


/*
|--------------------------------------------------------------------------
| RESERVATIONS - CLIENT
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:Client'
])->group(function () {

    Route::post('/reservations', [
        HotelWebController::class,
        'storeReservation'
    ])->name('reservations.store');

    Route::get('/mes-reservations', [
        ReservationWebController::class,
        'index'
    ])->name('reservations.index');

    Route::patch('/mes-reservations/{id}/cancel', [
        HotelWebController::class,
        'cancelReservation'
    ])->name('reservations.cancel');

});


/*
|--------------------------------------------------------------------------
| AVIS - PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/hotels/{hotelId}/avis', [
    AvisWebController::class,
    'index'
])->name('avis.index');


/*
|--------------------------------------------------------------------------
| AVIS - CLIENT
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:Client'
])->group(function () {

    Route::post('/avis', [
        AvisWebController::class,
        'store'
    ])->name('avis.store');

    Route::get('/avis/{id}/edit', [
        AvisWebController::class,
        'edit'
    ])->name('avis.edit');

    Route::put('/avis/{id}', [
        AvisWebController::class,
        'update'
    ])->name('avis.update');

    Route::delete('/avis/{id}', [
        AvisWebController::class,
        'destroy'
    ])->name('avis.destroy');

});


/*
|--------------------------------------------------------------------------
| NOTIFICATIONS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/notifications', [
        NotificationWebController::class,
        'index'
    ])->name('notifications.index');

    Route::patch('/notifications/read-all', [
        NotificationWebController::class,
        'markAllAsRead'
    ])->name('notifications.read-all');

    Route::patch('/notifications/{id}/read', [
        NotificationWebController::class,
        'markAsRead'
    ])->name('notifications.read');

});


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [
        ProfileWebController::class,
        'index'
    ])->name('profile.index');

    Route::get('/profile/edit', [
        ProfileWebController::class,
        'edit'
    ])->name('profile.edit');

    Route::put('/profile', [
        ProfileWebController::class,
        'update'
    ])->name('profile.update');

});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:Admin'
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Admin
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dashboard', [
        AdminDashboardController::class,
        'index'
    ])->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Gestion des utilisateurs
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/users', [
        AdminUserWebController::class,
        'index'
    ])->name('admin.users.index');

    Route::get('/admin/users/{id}/edit-role', [
        AdminUserWebController::class,
        'editRole'
    ])->name('admin.users.edit-role');

    Route::put('/admin/users/{id}/role', [
        AdminUserWebController::class,
        'updateRole'
    ])->name('admin.users.update-role');

    Route::delete('/admin/users/{id}', [
        AdminUserWebController::class,
        'destroy'
    ])->name('admin.users.destroy');


    /*
    |--------------------------------------------------------------------------
    | Gestion des hôtels
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/hotels', [
        AdminHotelWebController::class,
        'index'
    ])->name('admin.hotels.index');

    Route::patch('/admin/hotels/{id}/validate', [
        AdminHotelWebController::class,
        'validateHotel'
    ])->name('admin.hotels.validate');

    Route::patch('/admin/hotels/{id}/reject', [
        AdminHotelWebController::class,
        'reject'
    ])->name('admin.hotels.reject');

    Route::delete('/admin/hotels/{id}', [
        AdminHotelWebController::class,
        'destroy'
    ])->name('admin.hotels.destroy');


    /*
    |--------------------------------------------------------------------------
    | Gestion des réservations
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/reservations', [
        AdminReservationWebController::class,
        'index'
    ])->name('admin.reservations.index');

    Route::patch('/admin/reservations/{id}/cancel', [
        AdminReservationWebController::class,
        'cancel'
    ])->name('admin.reservations.cancel');


    /*
    |--------------------------------------------------------------------------
    | Gestion des avis
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/avis', [
        AdminAvisWebController::class,
        'index'
    ])->name('admin.avis.index');

    Route::delete('/admin/avis/{id}', [
        AdminAvisWebController::class,
        'destroy'
    ])->name('admin.avis.destroy');

});