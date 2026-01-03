<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademique;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AnneeAcademiqueController extends Controller
{
    public function index(): View
    {
        $anneesAcademiques = AnneeAcademique::latest()->paginate(10);

        return view('annees-academiques. index', compact('anneesAcademiques'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:annees_academiques,code',
            'libelle' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'actif' => 'boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        // Désactiver les autres années si celle-ci est active
        if ($validated['actif']) {
            AnneeAcademique::where('actif', true)->update(['actif' => false]);
        }

        AnneeAcademique::create($validated);

        return redirect()
            ->route('annees-academiques.index')
            ->with('success', 'Année académique créée avec succès.');
    }

    public function update(Request $request, AnneeAcademique $anneeAcademique): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:annees_academiques,code,' .  $anneeAcademique->id,
            'libelle' => 'required|string|max: 255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after: date_debut',
            'actif' => 'boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        // Désactiver les autres années si celle-ci est active
        if ($validated['actif']) {
            AnneeAcademique:: where('id', '!=', $anneeAcademique->id)
                ->where('actif', true)
                ->update(['actif' => false]);
        }

        $anneeAcademique->update($validated);

        return redirect()
            ->route('annees-academiques.index')
            ->with('success', 'Année académique mise à jour avec succès.');
    }

    public function destroy(AnneeAcademique $anneeAcademique): RedirectResponse
    {
        if ($anneeAcademique->actif) {
            return redirect()
                ->route('annees-academiques.index')
                ->with('error', 'Impossible de supprimer l\'année académique active.');
        }

        $anneeAcademique->delete();

        return redirect()
            ->route('annees-academiques. index')
            ->with('success', 'Année académique supprimée avec succès.');
    }
}