<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class ProprietaireHotelWebController extends Controller
{
    /**
     * Afficher les hôtels du propriétaire connecté.
     */
    public function index(Request $request)
    {
        $hotels = Hotel::with('images')
            ->where(
                'proprietaire_id',
                $request->user()->id_user
            )
            ->orderByDesc('created_at')
            ->paginate(9);

        return view(
            'proprietaire.hotels.index',
            compact('hotels')
        );
    }

    /**
     * Afficher le formulaire d'ajout d'un hôtel.
     */
    public function create()
    {
        return view('proprietaire.hotels.create');
    }

    /**
     * Enregistrer un nouvel hôtel.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'type_hebergement' => 'required|string|max:100',
            'capacite' => 'required|integer|min:1',
            'disponibilite' => 'required|boolean',
        ]);

        $validated['proprietaire_id'] = $request->user()->id_user;

        $validated['statut'] = 'en_attente';

        Hotel::create($validated);

        return redirect()
            ->route('proprietaire.hotels.index')
            ->with(
                'success',
                'Votre hôtel a été ajouté avec succès. Il est maintenant en attente de validation par l’administrateur.'
            );
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(Request $request, int $id)
    {
        $hotel = Hotel::with('images')
            ->where(
                'proprietaire_id',
                $request->user()->id_user
            )
            ->findOrFail($id);

        return view(
            'proprietaire.hotels.edit',
            compact('hotel')
        );
    }

    /**
     * Mettre à jour un hôtel.
     */
    public function update(Request $request, int $id)
    {
        $hotel = Hotel::where(
            'proprietaire_id',
            $request->user()->id_user
        )->findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'type_hebergement' => 'required|string|max:100',
            'capacite' => 'required|integer|min:1',
            'disponibilite' => 'required|boolean',
        ]);

        $hotel->update($validated);

        return redirect()
            ->route('proprietaire.hotels.index')
            ->with(
                'success',
                'Votre hôtel a été modifié avec succès.'
            );
    }

    /**
     * Supprimer un hôtel.
     */
    public function destroy(Request $request, int $id)
    {
        $hotel = Hotel::where(
            'proprietaire_id',
            $request->user()->id_user
        )->findOrFail($id);

        $hotel->delete();

        return redirect()
            ->route('proprietaire.hotels.index')
            ->with(
                'success',
                'Votre hôtel a été supprimé avec succès.'
            );
    }
}