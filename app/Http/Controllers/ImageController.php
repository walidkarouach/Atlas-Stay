<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    public function store(Request $request, int $hotelId): JsonResponse
    {
        $hotel = Hotel::findOrFail($hotelId);

        if ($hotel->proprietaire_id !== $request->user()->id_user) {
            return response()->json([
                'message' => 'Vous ne pouvez ajouter une image qu’à votre propre hôtel',
            ], 403);
        }

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $request->file('image')->store('hotels', 'public');

        $image = Image::create([
            'image' => $path,
            'hotel_id' => $hotel->id_hotel,
        ]);

        return response()->json([
            'message' => 'Image ajoutée avec succès',
            'data' => $image,
        ], 201);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $image = Image::with('hotel')->findOrFail($id);

        if ($image->hotel->proprietaire_id !== $request->user()->id_user) {
            return response()->json([
                'message' => 'Vous ne pouvez supprimer que les images de vos propres hôtels',
            ], 403);
        }

        $image->delete();

        return response()->json([
            'message' => 'Image supprimée avec succès',
        ]);
    }
}