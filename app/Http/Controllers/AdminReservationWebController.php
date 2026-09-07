<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminReservationWebController extends Controller
{
    /**
     * Afficher toutes les réservations.
     */
    public function index()
    {
        $reservations = Reservation::with([
            'utilisateur:id_user,nom,email',
            'hotel:id_hotel,nom,ville,adresse',
        ])
        ->orderByDesc('created_at')
        ->paginate(10);

        return view(
            'admin.reservations.index',
            compact('reservations')
        );
    }

    /**
     * Annuler une réservation depuis l'administration.
     */
    public function cancel(int $id)
    {
        $reservation = Reservation::with([
            'utilisateur',
            'hotel',
        ])->findOrFail($id);

        if ($reservation->statut === 'annulee') {
            return back()->withErrors([
                'reservation' => 'Cette réservation est déjà annulée.',
            ]);
        }

        if (in_array($reservation->statut, ['refusee'])) {
            return back()->withErrors([
                'reservation' => 'Cette réservation ne peut pas être annulée.',
            ]);
        }

        $reservation->update([
            'statut' => 'annulee',
        ]);

        Notification::create([
            'titre' => 'Réservation annulée',
            'message' => 'Votre réservation pour l’hôtel « '
                . $reservation->hotel->nom
                . ' » a été annulée par l’administrateur.',
            'lu' => false,
            'utilisateur_id' => $reservation->utilisateur_id,
        ]);

        return redirect()
            ->route('admin.reservations.index')
            ->with(
                'success',
                'La réservation #' . $reservation->id_reservation . ' a été annulée avec succès.'
            );
    }
}