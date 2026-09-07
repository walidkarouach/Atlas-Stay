<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageWebController extends Controller
{
    /**
     * Ajouter une image à un hôtel.
     */
    public function store(Request $request, int $hotelId)
    {
        $hotel = Hotel::where(
            'proprietaire_id',
            $request->user()->id_user
        )->findOrFail($hotelId);

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $request->file('image')->store(
            'hotels',
            'public'
        );

        Image::create([
            'image' => $path,
            'hotel_id' => $hotel->id_hotel,
        ]);

        return redirect()
            ->route(
                'proprietaire.hotels.images',
                $hotel->id_hotel
            )
            ->with(
                'success',
                'Image ajoutée avec succès.'
            );
    }

    /**
     * Supprimer une image.
     */
    public function destroy(Request $request, int $id)
    {
        $image = Image::with('hotel')->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Vérification du propriétaire
        |--------------------------------------------------------------------------
        */

        if (
            $image->hotel->proprietaire_id
            !== $request->user()->id_user
        ) {
            abort(
                403,
                'Vous ne pouvez supprimer que les images de vos propres hôtels.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Supprimer le fichier du stockage
        |--------------------------------------------------------------------------
        */

        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        /*
        |--------------------------------------------------------------------------
        | Supprimer l'enregistrement de la base de données
        |--------------------------------------------------------------------------
        */

        $hotelId = $image->hotel_id;

        $image->delete();

        return redirect()
            ->route(
                'proprietaire.hotels.images',
                $hotelId
            )
            ->with(
                'success',
                'Image supprimée avec succès.'
            );
    }
}