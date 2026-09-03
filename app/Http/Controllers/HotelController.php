<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HotelController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Hotel::with('proprietaire:id_user,nom,email')
            ->where('statut', 'valide');

        if ($request->has('ville')) {
            $query->where('ville', 'like', '%' . $request->ville . '%');
        }

        if ($request->has('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        if ($request->has('type_hebergement')) {
            $query->where('type_hebergement', $request->type_hebergement);
        }

        $hotels = $query->paginate(10);

        return response()->json([
            'message' => 'Liste des hôtels',
            'data' => $hotels,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'type_hebergement' => 'required|string|max:100',
            'capacite' => 'required|integer|min:1',
            'disponibilite' => 'boolean',
        ]);

        $validated['proprietaire_id'] = $request->user()->id_user;
        $validated['statut'] = 'en_attente';

        $hotel = Hotel::create($validated);

        return response()->json([
            'message' => 'Hôtel créé avec succès',
            'data' => $hotel,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $hotel = Hotel::with([
            'proprietaire:id_user,nom,email',
            'images'
        ])
        ->where('statut', 'valide')
        ->findOrFail($id);

        $hotel->images->each(function ($image) {
            $image->image = asset('storage/' . $image->image);
        });

        return response()->json([
            'message' => 'Hôtel trouvé',
            'data' => $hotel,
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $hotel = Hotel::findOrFail($id);

        if ($hotel->proprietaire_id !== $request->user()->id_user) {
            return response()->json([
                'message' => 'Vous ne pouvez modifier que vos propres hôtels',
            ], 403);
        }

        $validated = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'ville' => 'sometimes|string|max:255',
            'adresse' => 'sometimes|string|max:255',
            'prix' => 'sometimes|numeric|min:0',
            'type_hebergement' => 'sometimes|string|max:100',
            'capacite' => 'sometimes|integer|min:1',
            'disponibilite' => 'sometimes|boolean',
        ]);

        $hotel->update($validated);

        return response()->json([
            'message' => 'Hôtel modifié avec succès',
            'data' => $hotel,
        ]);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $hotel = Hotel::findOrFail($id);

        if ($hotel->proprietaire_id !== $request->user()->id_user) {
            return response()->json([
                'message' => 'Vous ne pouvez supprimer que vos propres hôtels',
            ], 403);
        }

        $hotel->delete();

        return response()->json([
            'message' => 'Hôtel supprimé avec succès',
        ]);
    }

    public function adminIndex(): JsonResponse
    {
        $hotels = Hotel::with([
            'proprietaire:id_user,nom,email'
        ])
        ->paginate(10);

        return response()->json([
            'message' => 'Liste de tous les hôtels',
            'data' => $hotels,
        ]);
    }

    public function validate(int $id): JsonResponse
    {
        $hotel = Hotel::findOrFail($id);

        if ($hotel->statut !== 'en_attente') {
            return response()->json([
                'message' => 'Cet hôtel ne peut pas être validé',
            ], 422);
        }

        $hotel->update([
            'statut' => 'valide',
        ]);

        Notification::create([
            'titre' => 'Hôtel validé',
            'message' => 'Votre hôtel a été validé par l’administrateur.',
            'lu' => false,
            'utilisateur_id' => $hotel->proprietaire_id,
        ]);

        return response()->json([
            'message' => 'Hôtel validé avec succès',
            'data' => $hotel,
        ]);
    }

    public function reject(int $id): JsonResponse
    {
        $hotel = Hotel::findOrFail($id);

        if ($hotel->statut !== 'en_attente') {
            return response()->json([
                'message' => 'Cet hôtel ne peut pas être refusé',
            ], 422);
        }

        $hotel->update([
            'statut' => 'refuse',
        ]);

        Notification::create([
            'titre' => 'Hôtel refusé',
            'message' => 'Votre hôtel a été refusé par l’administrateur.',
            'lu' => false,
            'utilisateur_id' => $hotel->proprietaire_id,
        ]);

        return response()->json([
            'message' => 'Hôtel refusé avec succès',
            'data' => $hotel,
        ]);
    }

    public function adminDestroy(int $id): JsonResponse
    {
        $hotel = Hotel::findOrFail($id);

        $hotel->delete();

        return response()->json([
            'message' => 'Hôtel supprimé avec succès',
        ]);
    }
}