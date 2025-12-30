<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EtudiantController extends Controller
{
    public function index(): View
    {
        $etudiants = Etudiant::with('filiere')
            ->latest()
            ->paginate(20);

        return view('etudiants.index', compact('etudiants'));
    }

    public function create(): View
    {
        $filieres = Filiere::active()->orderBy('nom')->get();
        return view('etudiants.create', compact('filieres'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'matricule' => 'required|string|unique:etudiants,matricule',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email',
            'telephone' => 'nullable|string',
            'filiere_id' => 'required|exists:filieres,id',
            'niveau' => 'required|string',
            'groupe' => 'nullable|string',
        ]);

        Etudiant::create($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant créé avec succès.');
    }

    public function show(Etudiant $etudiant): View
    {
        $etudiant->load(['filiere', 'notes. module']);
        return view('etudiants.show', compact('etudiant'));
    }

    public function edit(Etudiant $etudiant): View
    {
        $filieres = Filiere::active()->orderBy('nom')->get();
        return view('etudiants.edit', compact('etudiant', 'filieres'));
    }

    public function update(Request $request, Etudiant $etudiant): RedirectResponse
    {
        $validated = $request->validate([
            'matricule' => 'required|string|unique:etudiants,matricule,' . $etudiant->id,
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,' . $etudiant->id,
            'telephone' => 'nullable|string',
            'filiere_id' => 'required|exists:filieres,id',
            'niveau' => 'required|string',
            'groupe' => 'nullable|string',
        ]);

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function destroy(Etudiant $etudiant): RedirectResponse
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant supprimé avec succès.');
    }

    public function import(Request $request): RedirectResponse
    {
        // TODO: Implémenter l'import CSV/Excel
        return back()->with('info', 'Fonctionnalité en cours de développement.');
    }
}