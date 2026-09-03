<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Notification;

class ReservationController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $reservations = Reservation::with('hotel')
            ->where('utilisateur_id', $request->user()->id_user)
            ->get();

        return response()->json([
            'message' => 'Liste de vos réservations',
            'data' => $reservations,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id_hotel',
            'date_arrivee' => 'required|date|after_or_equal:today',
            'date_depart' => 'required|date|after:date_arrivee',
            'nb_personnes' => 'required|integer|min:1',
        ]);

        $hotel = Hotel::findOrFail($validated['hotel_id']);

        if (!$hotel->disponibilite) {
            return response()->json([
                'message' => 'Cet hôtel n’est pas disponible',
            ], 422);
        }

        if ($validated['nb_personnes'] > $hotel->capacite) {
            return response()->json([
                'message' => 'Le nombre de personnes dépasse la capacité de cet hôtel',
                'capacite_max' => $hotel->capacite,
            ], 422);
        }

        $existingReservation = Reservation::where('hotel_id', $hotel->id_hotel)
            ->whereIn('statut', ['en_attente', 'confirmee'])
            ->where(function ($query) use ($validated) {
        $query->where('date_arrivee', '<', $validated['date_depart'])
            ->where('date_depart', '>', $validated['date_arrivee']);
        })
            ->exists();

        if ($existingReservation) {
            return response()->json([
                'message' => 'Cet hôtel est déjà réservé pour cette période',
            ], 422);
        }

        $dateArrivee = \Carbon\Carbon::parse($validated['date_arrivee']);
        $dateDepart = \Carbon\Carbon::parse($validated['date_depart']);

        $nombreNuits = $dateArrivee->diffInDays($dateDepart);

        $montantTotal = $nombreNuits * $hotel->prix;

        $reservation = Reservation::create([
            'date_arrivee' => $validated['date_arrivee'],
            'date_depart' => $validated['date_depart'],
            'nb_personnes' => $validated['nb_personnes'],
            'montant_total' => $montantTotal,
            'statut' => 'en_attente',
            'utilisateur_id' => $request->user()->id_user,
            'hotel_id' => $hotel->id_hotel,
        ]);

        return response()->json([
            'message' => 'Réservation créée avec succès',
            'data' => $reservation,
        ], 201);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $reservation = Reservation::with('hotel')->findOrFail($id);

        if ($reservation->utilisateur_id !== $request->user()->id_user) {
            return response()->json([
                'message' => 'Vous ne pouvez annuler que vos propres réservations',
            ], 403);
        }

        if ($reservation->statut === 'annulee') {
            return response()->json([
                'message' => 'Cette réservation est déjà annulée',
            ], 422);
        }

        $dateArrivee = \Carbon\Carbon::parse($reservation->date_arrivee);

        if (now()->addHours(48)->greaterThan($dateArrivee)) {
            return response()->json([
                'message' => 'Vous ne pouvez plus annuler cette réservation moins de 48 heures avant l’arrivée',
            ], 422);
        }

        $reservation->update([
            'statut' => 'annulee',
        ]);

        Notification::create([
            'titre' => 'Réservation annulée',
            'message' => 'Un client a annulé une réservation pour votre hôtel.',
            'lu' => false,
            'utilisateur_id' => $reservation->hotel->proprietaire_id,
        ]);

        return response()->json([
            'message' => 'Réservation annulée avec succès',
            'data' => $reservation,
        ]);
    }

    public function ownerReservations(Request $request): JsonResponse
    {
        $reservations = Reservation::with([
            'utilisateur:id_user,nom,email',
            'hotel'
        ])
        ->whereHas('hotel', function ($query) use ($request) {
            $query->where('proprietaire_id', $request->user()->id_user);
        })
        ->get();

        return response()->json([
            'message' => 'Liste des réservations de vos hôtels',
            'data' => $reservations,
        ]);
    }

    public function confirm(Request $request, int $id): JsonResponse
    {
        $reservation = Reservation::with('hotel')->findOrFail($id);

        if ($reservation->hotel->proprietaire_id !== $request->user()->id_user) {
            return response()->json([
                'message' => 'Vous ne pouvez gérer que les réservations de vos propres hôtels',
            ], 403);
        }

        if ($reservation->statut === 'annulee') {
            return response()->json([
                'message' => 'Une réservation annulée ne peut pas être confirmée',
            ], 422);
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

        return response()->json([
            'message' => 'Réservation confirmée avec succès',
            'data' => $reservation,
        ]);
    }

    public function reject(Request $request, int $id): JsonResponse
    {
        $reservation = Reservation::with('hotel')->findOrFail($id);

        if ($reservation->hotel->proprietaire_id !== $request->user()->id_user) {
            return response()->json([
                'message' => 'Vous ne pouvez gérer que les réservations de vos propres hôtels',
            ], 403);
        }

        if ($reservation->statut === 'annulee') {
            return response()->json([
                'message' => 'Une réservation annulée ne peut pas être refusée',
            ], 422);
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

        return response()->json([
            'message' => 'Réservation refusée avec succès',
            'data' => $reservation,
        ]);
    }
}