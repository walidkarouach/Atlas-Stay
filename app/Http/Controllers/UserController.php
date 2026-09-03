<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::with('role:id_role,nom')
            ->get();

        return response()->json([
            'message' => 'Liste des utilisateurs',
            'data' => $users,
        ]);
    }

    public function updateRole(Request $request, int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id_role',
        ]);

        $user->update([
            'role_id' => $validated['role_id'],
        ]);

        $user->load('role:id_role,nom');

        return response()->json([
            'message' => 'Rôle de l’utilisateur modifié avec succès',
            'data' => $user,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        if ($user->id_user === auth()->user()->id_user) {
            return response()->json([
                'message' => 'Vous ne pouvez pas supprimer votre propre compte',
            ], 403);
        }

        $user->delete();

        return response()->json([
            'message' => 'Utilisateur supprimé avec succès',
        ]);
    }
}