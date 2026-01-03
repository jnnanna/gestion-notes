<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UtilisateurController extends Controller
{
    public function index(): View
    {
        $utilisateurs = User::with(['roles', 'departement'])
            ->latest()
            ->paginate(20);

        return view('utilisateurs.index', compact('utilisateurs'));
    }

    public function create(): View
    {
        $roles = Role::all();
        return view('utilisateurs.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'telephone' => 'nullable|string',
            'departement_id' => 'nullable|exists:departements,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['actif'] = $request->has('actif');

        $user = User::create($validated);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit(User $utilisateur): View
    {
        $roles = Role::all();
        return view('utilisateurs.edit', compact('utilisateur', 'roles'));
    }

    public function update(Request $request, User $utilisateur): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $utilisateur->id,
            'telephone' => 'nullable|string',
            'departement_id' => 'nullable|exists:departements,id',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $validated['actif'] = $request->has('actif');

        $utilisateur->update($validated);

        if ($request->has('roles')) {
            $utilisateur->syncRoles($request->roles);
        }

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $utilisateur): RedirectResponse
    {
        $utilisateur->delete();

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function roles(User $utilisateur): View
    {
        $roles = Role:: all();
        return view('utilisateurs.roles', compact('utilisateur', 'roles'));
    }

    public function assignRoles(Request $request, User $utilisateur): RedirectResponse
    {
        $utilisateur->syncRoles($request->roles ??  []);

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Rôles assignés avec succès.');
    }
}