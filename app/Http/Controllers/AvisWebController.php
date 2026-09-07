<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;
use App\Models\Hotel;
use App\Models\Reservation;

class AvisWebController extends Controller
{
    /**
     * Afficher les avis d'un hôtel
     */
    public function index(int $hotelId)
    {
        $hotel = Hotel::with('images')
            ->where('statut', 'valide')
            ->findOrFail($hotelId);

        $avis = Avis::with('utilisateur:id_user,nom')
            ->where('hotel_id', $hotelId)
            ->orderByDesc('date_avis')
            ->get();

        return view('avis.index', compact('hotel', 'avis'));
    }


    /**
     * Ajouter un avis
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id_hotel',
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string',
        ]);

        $reservation = Reservation::where(
            'utilisateur_id',
            $request->user()->id_user
        )
        ->where('hotel_id', $validated['hotel_id'])
        ->where('statut', 'confirmee')
        ->where('date_depart', '<', today())
        ->exists();

        if (!$reservation) {
            return back()
                ->withErrors([
                    'avis' => 'Vous devez avoir terminé un séjour confirmé pour laisser un avis.'
                ])
                ->withInput();
        }

        $avisExiste = Avis::where(
            'user_id',
            $request->user()->id_user
        )
        ->where('hotel_id', $validated['hotel_id'])
        ->exists();

        if ($avisExiste) {
            return back()
                ->withErrors([
                    'avis' => 'Vous avez déjà laissé un avis pour cet hôtel.'
                ])
                ->withInput();
        }

        Avis::create([
            'note' => $validated['note'],
            'commentaire' => $validated['commentaire'] ?? null,
            'date_avis' => today(),
            'user_id' => $request->user()->id_user,
            'hotel_id' => $validated['hotel_id'],
        ]);

        return redirect()
            ->route('hotels.show', $validated['hotel_id'])
            ->with('success', 'Votre avis a été ajouté avec succès.');
    }


    /**
     * Afficher le formulaire de modification
     */
    public function edit(Request $request, int $id)
    {
        $avis = Avis::with('hotel')->findOrFail($id);

        if ($avis->user_id !== $request->user()->id_user) {
            abort(403);
        }

        return view('avis.edit', compact('avis'));
    }


    /**
     * Modifier un avis
     */
    public function update(Request $request, int $id)
    {
        $avis = Avis::findOrFail($id);

        if ($avis->user_id !== $request->user()->id_user) {
            abort(403);
        }

        $validated = $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string',
        ]);

        $avis->update($validated);

        return redirect()
            ->route('hotels.show', $avis->hotel_id)
            ->with('success', 'Votre avis a été modifié avec succès.');
    }


    /**
     * Supprimer un avis
     */
    public function destroy(Request $request, int $id)
    {
        $avis = Avis::findOrFail($id);

        if ($avis->user_id !== $request->user()->id_user) {
            abort(403);
        }

        $hotelId = $avis->hotel_id;

        $avis->delete();

        return redirect()
            ->route('hotels.show', $hotelId)
            ->with('success', 'Votre avis a été supprimé avec succès.');
    }
}