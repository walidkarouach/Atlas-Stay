<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HotelController extends Controller
{
    public function index(): JsonResponse
    {
        $hotels = Hotel::with('proprietaire:id_user,nom,email')->get();

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
            'statut' => 'nullable|string|max:50',
        ]);

        $validated['proprietaire_id'] = $request->user()->id_user;

        $hotel = Hotel::create($validated);

        return response()->json([
            'message' => 'Hôtel créé avec succès',
            'data' => $hotel,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $hotel = Hotel::with('proprietaire:id_user,nom,email')->findOrFail($id);

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
            'proprietaire_id' => 'sometimes|exists:users,id_user',
            'statut' => 'sometimes|string|max:50',
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
}