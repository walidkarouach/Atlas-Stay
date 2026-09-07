<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;

class AdminAvisWebController extends Controller
{
    /**
     * Afficher tous les avis.
     */
    public function index()
    {
        $avis = Avis::with([
            'utilisateur:id_user,nom,email',
            'hotel:id_hotel,nom,ville',
        ])
        ->orderByDesc('created_at')
        ->paginate(10);

        return view(
            'admin.avis.index',
            compact('avis')
        );
    }

    /**
     * Supprimer un avis.
     */
    public function destroy(int $id)
    {
        $avis = Avis::with([
            'utilisateur:id_user,nom',
            'hotel:id_hotel,nom',
        ])->findOrFail($id);

        $avis->delete();

        return redirect()
            ->route('admin.avis.index')
            ->with(
                'success',
                'L’avis a été supprimé avec succès.'
            );
    }
}