<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Afficher le dashboard Admin.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Utilisateurs
        |--------------------------------------------------------------------------
        */

        $totalUsers = User::count();


        /*
        |--------------------------------------------------------------------------
        | Hôtels
        |--------------------------------------------------------------------------
        */

        $totalHotels = Hotel::count();

        $hotelsEnAttente = Hotel::where(
            'statut',
            'en_attente'
        )->count();

        $hotelsValides = Hotel::where(
            'statut',
            'valide'
        )->count();

        $hotelsRefuses = Hotel::where(
            'statut',
            'refuse'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Réservations
        |--------------------------------------------------------------------------
        */

        $totalReservations = Reservation::count();

        $reservationsEnAttente = Reservation::where(
            'statut',
            'en_attente'
        )->count();

        $reservationsConfirmees = Reservation::where(
            'statut',
            'confirmee'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            compact(
                'totalUsers',
                'totalHotels',
                'hotelsEnAttente',
                'hotelsValides',
                'hotelsRefuses',
                'totalReservations',
                'reservationsEnAttente',
                'reservationsConfirmees'
            )
        );
    }
}