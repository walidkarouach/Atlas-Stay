<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
        $reservation = Reservation::findOrFail($id);

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

        $reservation->update([
            'statut' => 'annulee',
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
}