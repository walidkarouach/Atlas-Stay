<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ProprietaireDashboardController extends Controller
{
    /**
     * Dashboard du propriétaire.
     */
    public function index(Request $request)
    {
        $proprietaireId = $request->user()->id_user;

        /*
        |--------------------------------------------------------------------------
        | Hôtels
        |--------------------------------------------------------------------------
        */

        $totalHotels = Hotel::where(
            'proprietaire_id',
            $proprietaireId
        )->count();

        $hotelsEnAttente = Hotel::where(
            'proprietaire_id',
            $proprietaireId
        )
        ->where('statut', 'en_attente')
        ->count();

        $hotelsValides = Hotel::where(
            'proprietaire_id',
            $proprietaireId
        )
        ->where('statut', 'valide')
        ->count();

        $hotelsRefuses = Hotel::where(
            'proprietaire_id',
            $proprietaireId
        )
        ->where('statut', 'refuse')
        ->count();


        /*
        |--------------------------------------------------------------------------
        | Réservations
        |--------------------------------------------------------------------------
        */

        $totalReservations = Reservation::whereHas(
            'hotel',
            function ($query) use ($proprietaireId) {
                $query->where(
                    'proprietaire_id',
                    $proprietaireId
                );
            }
        )->count();

        $reservationsEnAttente = Reservation::whereHas(
            'hotel',
            function ($query) use ($proprietaireId) {
                $query->where(
                    'proprietaire_id',
                    $proprietaireId
                );
            }
        )
        ->where('statut', 'en_attente')
        ->count();

        $reservationsConfirmees = Reservation::whereHas(
            'hotel',
            function ($query) use ($proprietaireId) {
                $query->where(
                    'proprietaire_id',
                    $proprietaireId
                );
            }
        )
        ->where('statut', 'confirmee')
        ->count();


        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'proprietaire.dashboard',
            compact(
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