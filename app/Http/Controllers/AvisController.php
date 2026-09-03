<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AvisController extends Controller
{
    public function index(int $hotelId): JsonResponse
    {
        Hotel::findOrFail($hotelId);

        $avis = Avis::with('utilisateur:id_user,nom')
            ->where('hotel_id', $hotelId)
            ->orderByDesc('date_avis')
            ->get();

        return response()->json([
            'message' => 'Liste des avis',
            'data' => $avis,
        ]);
    }

    public function store(Request $request): JsonResponse
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
            return response()->json([
                'message' => 'Vous devez avoir terminé un séjour confirmé pour laisser un avis',
            ], 422);
        }

        $avisExiste = Avis::where('user_id', $request->user()->id_user)
            ->where('hotel_id', $validated['hotel_id'])
            ->exists();

        if ($avisExiste) {
            return response()->json([
                'message' => 'Vous avez déjà laissé un avis pour cet hôtel',
            ], 422);
        }

        $avis = Avis::create([
            'note' => $validated['note'],
            'commentaire' => $validated['commentaire'] ?? null,
            'date_avis' => today(),
            'user_id' => $request->user()->id_user,
            'hotel_id' => $validated['hotel_id'],
        ]);

        return response()->json([
            'message' => 'Avis ajouté avec succès',
            'data' => $avis,
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $avis = Avis::findOrFail($id);

        if ($avis->user_id !== $request->user()->id_user) {
            return response()->json([
                'message' => 'Vous ne pouvez modifier que vos propres avis',
            ], 403);
        }

        $validated = $request->validate([
            'note' => 'sometimes|integer|min:1|max:5',
            'commentaire' => 'sometimes|nullable|string',
        ]);

        $avis->update($validated);

        return response()->json([
            'message' => 'Avis modifié avec succès',
            'data' => $avis,
        ]);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $avis = Avis::findOrFail($id);

        if ($avis->user_id !== $request->user()->id_user) {
            return response()->json([
                'message' => 'Vous ne pouvez supprimer que vos propres avis',
            ], 403);
        }

        $avis->delete();

        return response()->json([
            'message' => 'Avis supprimé avec succès',
        ]);
    }

    public function adminIndex(): JsonResponse
    {
        $avis = Avis::with([
            'utilisateur:id_user,nom,email',
            'hotel:id_hotel,nom'
        ])
        ->orderByDesc('date_avis')
        ->get();

        return response()->json([
            'message' => 'Liste de tous les avis',
            'data' => $avis,
        ]);
    }

    public function adminDestroy(int $id): JsonResponse
    {
        $avis = Avis::findOrFail($id);

        $avis->delete();

        return response()->json([
            'message' => 'Avis supprimé avec succès',
        ]);
    }
}