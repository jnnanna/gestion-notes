<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FiliereController extends Controller
{
    /**
     * Display a listing of filieres.
     */
    public function index(): View
    {
        $filieres = Filiere::with(['departement', 'chef'])
            ->withCount(['modules', 'etudiants'])
            ->latest()
            ->get();

        return view('filieres.index', compact('filieres'));
    }

    /**
     * Show the form for creating a new filiere.
     */
    public function create(): View
    {
        $departements = Departement:: active()->orderBy('nom')->get();
        $chefs = User:: role('chef-filiere')->orderBy('name')->get();

        return view('filieres.create', compact('departements', 'chefs'));
    }

    /**
     * Store a newly created filiere in storage. 
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:filieres,code',
            'nom' => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
            'chef_id' => 'nullable|exists:users,id',
            'niveau' => 'required|string|max:50',
            'actif' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $validated['actif'] = $request->has('actif');

        Filiere::create($validated);

        return redirect()
            ->route('filieres. index')
            ->with('success', 'Filière créée avec succès.');
    }

    /**
     * Display the specified filiere.
     */
    public function show(Filiere $filiere): View
    {
        $filiere->load(['departement', 'chef', 'modules', 'etudiants']);

        return view('filieres.show', compact('filiere'));
    }

    /**
     * Show the form for editing the specified filiere.
     */
    public function edit(Filiere $filiere): View
    {
        $departements = Departement::active()->orderBy('nom')->get();
        $chefs = User::role('chef-filiere')->orderBy('name')->get();

        return view('filieres.edit', compact('filiere', 'departements', 'chefs'));
    }

    /**
     * Update the specified filiere in storage.
     */
    public function update(Request $request, Filiere $filiere): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:filieres,code,' . $filiere->id,
            'nom' => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
            'chef_id' => 'nullable|exists:users,id',
            'niveau' => 'required|string|max:50',
            'actif' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $validated['actif'] = $request->has('actif');

        $filiere->update($validated);

        return redirect()
            ->route('filieres.index')
            ->with('success', 'Filière mise à jour avec succès.');
    }

    /**
     * Remove the specified filiere from storage. 
     */
    public function destroy(Filiere $filiere): RedirectResponse
    {
        // Vérifier si la filière a des modules ou étudiants
        if ($filiere->modules()->exists() || $filiere->etudiants()->exists()) {
            return redirect()
                ->route('filieres.index')
                ->with('error', 'Impossible de supprimer cette filière car elle contient des modules ou des étudiants.');
        }

        $filiere->delete();

        return redirect()
            ->route('filieres.index')
            ->with('success', 'Filière supprimée avec succès.');
    }
}