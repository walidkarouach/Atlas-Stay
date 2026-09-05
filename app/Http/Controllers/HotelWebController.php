<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Notification;
use Carbon\Carbon;

class HotelWebController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::with('images')
            ->where('statut', 'valide');

        // Filtre par ville
        if ($request->filled('ville')) {
            $query->where(
                'ville',
                'like',
                '%' . $request->ville . '%'
            );
        }

        // Filtre par prix maximum
        if ($request->filled('prix_max')) {
            $query->where(
                'prix',
                '<=',
                $request->prix_max
            );
        }

        // Filtre par type d'hébergement
        if ($request->filled('type_hebergement')) {
            $query->where(
                'type_hebergement',
                $request->type_hebergement
            );
        }

        $hotels = $query
            ->orderByDesc('created_at')
            ->paginate(9)
            ->withQueryString();

        return view('hotels.index', compact('hotels'));
    }


    // =========================
    // HOTEL DETAILS
    // =========================

    public function show(int $id)
    {
        $hotel = Hotel::with([
            'images',
            'avis.utilisateur:id_user,nom'
        ])
        ->where('statut', 'valide')
        ->findOrFail($id);

        return view('hotels.show', compact('hotel'));
    }

    public function storeReservation(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id_hotel',
            'date_arrivee' => 'required|date|after_or_equal:today',
            'date_depart' => 'required|date|after:date_arrivee',
            'nb_personnes' => 'required|integer|min:1',
        ]);

        $hotel = Hotel::findOrFail($validated['hotel_id']);

        // Vérifier que l'hôtel est disponible
        if (!$hotel->disponibilite) {
            return back()
                ->withErrors([
                    'reservation' => 'Cet hôtel n’est pas disponible.',
                ])
                ->withInput();
        }

        // Vérifier la capacité
        if ($validated['nb_personnes'] > $hotel->capacite) {
            return back()
                ->withErrors([
                    'reservation' => 'Le nombre de personnes dépasse la capacité de cet hôtel.',
                ])
                ->withInput();
        }

        // Vérifier les réservations qui se chevauchent
        $existingReservation = Reservation::where('hotel_id', $hotel->id_hotel)
            ->whereIn('statut', ['en_attente', 'confirmee'])
            ->where(function ($query) use ($validated) {
                $query->where(
                    'date_arrivee',
                    '<',
                    $validated['date_depart']
                )
                ->where(
                    'date_depart',
                    '>',
                    $validated['date_arrivee']
                );
            })
            ->exists();

        if ($existingReservation) {
            return back()
                ->withErrors([
                    'reservation' => 'Cet hôtel est déjà réservé pour cette période.',
                ])
                ->withInput();
        }

        // Calcul du nombre de nuits
        $dateArrivee = Carbon::parse($validated['date_arrivee']);
        $dateDepart = Carbon::parse($validated['date_depart']);

        $nombreNuits = $dateArrivee->diffInDays($dateDepart);

        // Calcul du montant total
        $montantTotal = $nombreNuits * $hotel->prix;

        // Création de la réservation
        $reservation = Reservation::create([
            'date_arrivee' => $validated['date_arrivee'],
            'date_depart' => $validated['date_depart'],
            'nb_personnes' => $validated['nb_personnes'],
            'montant_total' => $montantTotal,
            'statut' => 'en_attente',
            'utilisateur_id' => $request->user()->id_user,
            'hotel_id' => $hotel->id_hotel,
        ]);

        // Notification au propriétaire
        Notification::create([
            'titre' => 'Nouvelle réservation',
            'message' => 'Un client a effectué une nouvelle réservation pour votre hôtel.',
            'lu' => false,
            'utilisateur_id' => $hotel->proprietaire_id,
        ]);

        return redirect()
            ->route('hotels.show', $hotel->id_hotel)
            ->with('success', 'Votre réservation a été créée avec succès.');
    }
}