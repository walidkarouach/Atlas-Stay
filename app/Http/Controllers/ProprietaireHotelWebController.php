<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Image;
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

            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Créer l'hôtel
        |--------------------------------------------------------------------------
        */

        $hotel = Hotel::create([
            'nom' => $validated['nom'],
            'description' => $validated['description'] ?? null,
            'ville' => $validated['ville'],
            'adresse' => $validated['adresse'],
            'prix' => $validated['prix'],
            'type_hebergement' => $validated['type_hebergement'],
            'capacite' => $validated['capacite'],
            'disponibilite' => $validated['disponibilite'],

            // Sécurité : propriétaire connecté
            'proprietaire_id' => $request->user()->id_user,

            // Validation obligatoire par l'admin
            'statut' => 'en_attente',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Ajouter les images
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store(
                    'hotels',
                    'public'
                );

                Image::create([
                    'image' => $path,
                    'hotel_id' => $hotel->id_hotel,
                ]);
            }
        }

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

    /**
     * Afficher la gestion des images d'un hôtel.
     */
    public function images(Request $request, int $id)
    {
        $hotel = Hotel::with('images')
            ->where(
                'proprietaire_id',
                $request->user()->id_user
            )
            ->findOrFail($id);

        return view(
            'proprietaire.hotels.images',
            compact('hotel')
        );
    }
}