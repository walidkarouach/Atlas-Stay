<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminUserWebController extends Controller
{
    /**
     * Afficher la liste des utilisateurs.
     */
    public function index()
    {
        $users = User::with('role:id_role,nom')
            ->orderByDesc('id_user')
            ->paginate(10);

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    /**
     * Afficher la page de modification du rôle.
     */
    public function editRole(int $id)
    {
        $user = User::with('role:id_role,nom')
            ->findOrFail($id);

        $roles = Role::orderBy('id_role')->get();

        return view(
            'admin.users.edit-role',
            compact('user', 'roles')
        );
    }

    /**
     * Modifier le rôle d'un utilisateur.
     */
    public function updateRole(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id_role',
        ]);

        $user->update([
            'role_id' => $validated['role_id'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Le rôle de l’utilisateur a été modifié avec succès.'
            );
    }

    /**
     * Supprimer un utilisateur.
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Empêcher l'Admin de supprimer son propre compte
        |--------------------------------------------------------------------------
        */

        if ($user->id_user === auth()->user()->id_user) {
            return back()
                ->withErrors([
                    'user' => 'Vous ne pouvez pas supprimer votre propre compte.',
                ]);
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Utilisateur supprimé avec succès.'
            );
    }
}