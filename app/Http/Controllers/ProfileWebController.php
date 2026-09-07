<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileWebController extends Controller
{
    /**
     * Afficher le profil
     */
    public function index(Request $request)
    {
        $user = $request->user()->load('role:id_role,nom');

        return view('profile.index', compact('user'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Modifier le profil
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id_user . ',id_user',
            'telephone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Votre profil a été modifié avec succès.');
    }
}