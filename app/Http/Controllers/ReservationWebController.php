<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Notification;
use Illuminate\Http\Request;

class ReservationWebController extends Controller
{
    /**
     * Afficher les réservations du client connecté.
     */
    public function index(Request $request)
    {
        $reservations = Reservation::with([
            'hotel:id_hotel,nom,ville,adresse,prix,type_hebergement'
        ])
        ->where(
            'utilisateur_id',
            $request->user()->id_user
        )
        ->orderByDesc('created_at')
        ->paginate(10);

        return view(
            'reservations.index',
            compact('reservations')
        );
    }

    /**
     * Afficher les réservations des hôtels
     * du propriétaire connecté.
     */
    public function ownerIndex(Request $request)
    {
        $proprietaireId = $request->user()->id_user;

        $reservations = Reservation::with([
            'utilisateur:id_user,nom,email',
            'hotel:id_hotel,nom,ville,adresse'
        ])
        ->whereHas('hotel', function ($query) use ($proprietaireId) {
            $query->where(
                'proprietaire_id',
                $proprietaireId
            );
        })
        ->orderByDesc('created_at')
        ->paginate(10);

        return view(
            'proprietaire.reservations.index',
            compact('reservations')
        );
    }

    /**
     * Confirmer une réservation.
     */
    public function confirm(Request $request, int $id)
    {
        $proprietaireId = $request->user()->id_user;

        $reservation = Reservation::with('hotel')
            ->whereHas('hotel', function ($query) use ($proprietaireId) {
                $query->where(
                    'proprietaire_id',
                    $proprietaireId
                );
            })
            ->findOrFail($id);

        if ($reservation->statut !== 'en_attente') {
            return back()->withErrors([
                'reservation' => 'Seules les réservations en attente peuvent être confirmées.',
            ]);
        }

        $reservation->update([
            'statut' => 'confirmee',
        ]);

        Notification::create([
            'titre' => 'Réservation confirmée',
            'message' => 'Votre réservation a été confirmée par le propriétaire.',
            'lu' => false,
            'utilisateur_id' => $reservation->utilisateur_id,
        ]);

        return redirect()
            ->route('proprietaire.reservations.index')
            ->with(
                'success',
                'La réservation a été confirmée avec succès.'
            );
    }

    /**
     * Refuser une réservation.
     */
    public function reject(Request $request, int $id)
    {
        $proprietaireId = $request->user()->id_user;

        $reservation = Reservation::with('hotel')
            ->whereHas('hotel', function ($query) use ($proprietaireId) {
                $query->where(
                    'proprietaire_id',
                    $proprietaireId
                );
            })
            ->findOrFail($id);

        if ($reservation->statut !== 'en_attente') {
            return back()->withErrors([
                'reservation' => 'Seules les réservations en attente peuvent être refusées.',
            ]);
        }

        $reservation->update([
            'statut' => 'refusee',
        ]);

        Notification::create([
            'titre' => 'Réservation refusée',
            'message' => 'Votre réservation a été refusée par le propriétaire.',
            'lu' => false,
            'utilisateur_id' => $reservation->utilisateur_id,
        ]);

        return redirect()
            ->route('proprietaire.reservations.index')
            ->with(
                'success',
                'La réservation a été refusée avec succès.'
            );
    }

    /**
     * Annuler une réservation.
     */
    public function cancel(Request $request, int $id)
    {
        $proprietaireId = $request->user()->id_user;

        $reservation = Reservation::with('hotel')
            ->whereHas('hotel', function ($query) use ($proprietaireId) {
                $query->where(
                    'proprietaire_id',
                    $proprietaireId
                );
            })
            ->findOrFail($id);

        if ($reservation->statut === 'annulee') {
            return back()->withErrors([
                'reservation' => 'Cette réservation est déjà annulée.',
            ]);
        }

        $reservation->update([
            'statut' => 'annulee',
        ]);

        Notification::create([
            'titre' => 'Réservation annulée',
            'message' => 'Le propriétaire a annulé votre réservation pour cause d’indisponibilité.',
            'lu' => false,
            'utilisateur_id' => $reservation->utilisateur_id,
        ]);

        return redirect()
            ->route('proprietaire.reservations.index')
            ->with(
                'success',
                'La réservation a été annulée avec succès.'
            );
    }
}