<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ProprietaireDashboardController extends Controller
{
    /**
     * Dashboard du propriétaire
     */
    public function index(Request $request)
    {
        $proprietaireId = $request->user()->id_user;

        // Nombre total de mes hôtels
        $totalHotels = Hotel::where(
            'proprietaire_id',
            $proprietaireId
        )->count();

        // Hôtels en attente
        $hotelsEnAttente = Hotel::where(
            'proprietaire_id',
            $proprietaireId
        )
        ->where('statut', 'en_attente')
        ->count();

        // Hôtels validés
        $hotelsValides = Hotel::where(
            'proprietaire_id',
            $proprietaireId
        )
        ->where('statut', 'valide')
        ->count();

        // Hôtels refusés
        $hotelsRefuses = Hotel::where(
            'proprietaire_id',
            $proprietaireId
        )
        ->where('statut', 'refuse')
        ->count();


        // Toutes les réservations de mes hôtels
        $totalReservations = Reservation::whereHas(
            'hotel',
            function ($query) use ($proprietaireId) {
                $query->where(
                    'proprietaire_id',
                    $proprietaireId
                );
            }
        )->count();


        // Réservations en attente
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


        // Réservations confirmées
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