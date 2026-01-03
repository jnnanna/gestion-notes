<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DepartementController extends Controller
{
    /**
     * Display a listing of departements.
     */
    public function index(): View
    {
        $departements = Departement::with('chef')
            ->withCount(['filieres', 'enseignants', 'etudiants'])
            ->latest()
            ->get();

        return view('departements.index', compact('departements'));
    }

    /**
     * Show the form for creating a new departement.
     */
    public function create(): View
    {
        $chefs = User::role('chef-departement')->orderBy('name')->get();

        return view('departements.create', compact('chefs'));
    }

    /**
     * Store a newly created departement in storage. 
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:departements,nom',
            'code' => 'required|string|max:20|unique:departements,code',
            'chef_id' => 'nullable|exists:users,id',
            'actif' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $validated['actif'] = $request->has('actif');

        Departement::create($validated);

        return redirect()
            ->route('departements.index')
            ->with('success', 'Département créé avec succès.');
    }

    /**
     * Display the specified departement.
     */
    public function show(Departement $departement): View
    {
        $departement->load(['chef', 'filieres', 'enseignants']);

        return view('departements.show', compact('departement'));
    }

    /**
     * Show the form for editing the specified departement.
     */
    public function edit(Departement $departement): View
    {
        $chefs = User::role('chef-departement')->orderBy('name')->get();

        return view('departements.edit', compact('departement', 'chefs'));
    }

    /**
     * Update the specified departement in storage.
     */
    public function update(Request $request, Departement $departement): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:departements,nom,' . $departement->id,
            'code' => 'required|string|max:20|unique:departements,code,' . $departement->id,
            'chef_id' => 'nullable|exists:users,id',
            'actif' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $validated['actif'] = $request->has('actif');

        $departement->update($validated);

        return redirect()
            ->route('departements.index')
            ->with('success', 'Département mis à jour avec succès.');
    }

    /**
     * Remove the specified departement from storage. 
     */
    public function destroy(Departement $departement): RedirectResponse
    {
        // Vérifier si le département a des filières
        if ($departement->filieres()->exists()) {
            return redirect()
                ->route('departements.index')
                ->with('error', 'Impossible de supprimer ce département car il contient des filières.');
        }

        $departement->delete();

        return redirect()
            ->route('departements.index')
            ->with('success', 'Département supprimé avec succès.');
    }
}