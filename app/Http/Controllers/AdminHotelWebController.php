<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminHotelWebController extends Controller
{
    /**
     * Afficher tous les hôtels.
     */
    public function index()
    {
        $hotels = Hotel::with([
            'proprietaire:id_user,nom,email',
            'images',
        ])
        ->orderByDesc('created_at')
        ->paginate(10);

        return view(
            'admin.hotels.index',
            compact('hotels')
        );
    }

    /**
     * Valider un hôtel.
     */
    public function validateHotel(int $id)
    {
        $hotel = Hotel::with('proprietaire')
            ->findOrFail($id);

        if ($hotel->statut !== 'en_attente') {
            return back()
                ->withErrors([
                    'hotel' => 'Seuls les hôtels en attente peuvent être validés.',
                ]);
        }

        $hotel->update([
            'statut' => 'valide',
        ]);

        Notification::create([
            'titre' => 'Hôtel validé',
            'message' => 'Votre hôtel « ' . $hotel->nom . ' » a été validé par l’administrateur.',
            'lu' => false,
            'utilisateur_id' => $hotel->proprietaire_id,
        ]);

        return redirect()
            ->route('admin.hotels.index')
            ->with(
                'success',
                'L’hôtel « ' . $hotel->nom . ' » a été validé avec succès.'
            );
    }

    /**
     * Refuser un hôtel.
     */
    public function reject(int $id)
    {
        $hotel = Hotel::with('proprietaire')
            ->findOrFail($id);

        if ($hotel->statut !== 'en_attente') {
            return back()
                ->withErrors([
                    'hotel' => 'Seuls les hôtels en attente peuvent être refusés.',
                ]);
        }

        $hotel->update([
            'statut' => 'refuse',
        ]);

        Notification::create([
            'titre' => 'Hôtel refusé',
            'message' => 'Votre hôtel « ' . $hotel->nom . ' » a été refusé par l’administrateur.',
            'lu' => false,
            'utilisateur_id' => $hotel->proprietaire_id,
        ]);

        return redirect()
            ->route('admin.hotels.index')
            ->with(
                'success',
                'L’hôtel « ' . $hotel->nom . ' » a été refusé.'
            );
    }

    /**
     * Supprimer un hôtel.
     */
    public function destroy(int $id)
    {
        $hotel = Hotel::findOrFail($id);

        $nomHotel = $hotel->nom;

        $hotel->delete();

        return redirect()
            ->route('admin.hotels.index')
            ->with(
                'success',
                'L’hôtel « ' . $nomHotel . ' » a été supprimé avec succès.'
            );
    }
}