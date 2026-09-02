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
            'image' => 'required|string|max:255',
        ]);

        $validated['hotel_id'] = $hotel->id_hotel;

        $image = Image::create($validated);

        return response()->json([
            'message' => 'Image ajoutée avec succès',
            'data' => $image,
        ], 201);
    }
}