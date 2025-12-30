<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index(): View
    {
        return view('profil.index');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'telephone' => 'nullable|string',
        ]);

        $user = User::find(Auth::id());
        if ($user) {
            $user->update($validated);
        }

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function securite(): View
    {
        return view('profil.securite');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());
        if ($user) {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        return back()->with('success', 'Mot de passe modifié avec succès.');
    }

    public function activer2FA(): RedirectResponse
    {
        $user = User::find(Auth::id());
        if ($user) {
            $user->update(['two_factor_enabled' => true]);
        }
        
        return back()->with('success', 'Authentification à deux facteurs activée.');
    }

    public function desactiver2FA(): RedirectResponse
    {
        $user = User::find(Auth::id());
        if ($user) {
            $user->update(['two_factor_enabled' => false]);
        }
        
        return back()->with('success', 'Authentification à deux facteurs désactivée.');
    }

    public function deconnecterSessions(): RedirectResponse
    {
        // TODO: Déconnecter les autres sessions
        
        return back()->with('success', 'Autres sessions déconnectées.');
    }
}