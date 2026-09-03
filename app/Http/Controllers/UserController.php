<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::with('role:id_role,nom')
            ->paginate(10);

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

    public function profile(Request $request): JsonResponse
    {
        $user = $request->user()->load('role:id_role,nom');

        return response()->json([
            'message' => 'Votre profil',
            'data' => $user,
        ]);
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id_user . ',id_user',
            'telephone' => 'sometimes|nullable|string|max:20',
            'photo' => 'sometimes|nullable|string|max:255',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Profil modifié avec succès',
            'data' => $user->load('role:id_role,nom'),
        ]);
    }

    public function changePassword(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ancien_password' => 'required|string',
            'nouveau_password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($validated['ancien_password'], $user->password)) {
            return response()->json([
                'message' => 'Ancien mot de passe incorrect',
            ], 422);
        }

        $user->update([
            'password' => Hash::make($validated['nouveau_password']),
        ]);

        return response()->json([
            'message' => 'Mot de passe modifié avec succès',
        ]);
    }

    public function statistics(): JsonResponse
    {
        $totalUsers = User::count();

        $totalHotels = Hotel::count();

        $hotelsEnAttente = Hotel::where('statut', 'en_attente')->count();

        $hotelsValides = Hotel::where('statut', 'valide')->count();

        $hotelsRefuses = Hotel::where('statut', 'refuse')->count();

        $totalReservations = Reservation::count();

        $reservationsEnAttente = Reservation::where('statut', 'en_attente')->count();

        $reservationsConfirmees = Reservation::where('statut', 'confirmee')->count();

        return response()->json([
            'message' => 'Statistiques du dashboard',
            'data' => [
                'users' => [
                    'total' => $totalUsers,
                ],

                'hotels' => [
                    'total' => $totalHotels,
                    'en_attente' => $hotelsEnAttente,
                    'valides' => $hotelsValides,
                    'refuses' => $hotelsRefuses,
                ],

                'reservations' => [
                    'total' => $totalReservations,
                    'en_attente' => $reservationsEnAttente,
                    'confirmees' => $reservationsConfirmees,
                ],
            ],
        ]);
    }
}