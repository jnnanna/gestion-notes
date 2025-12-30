<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SemestreController extends Controller
{
    /**
     * Display a listing of semestres.
     */
    public function index(): View
    {
        $semestres = Semestre::withCount('modules')
            ->orderBy('code')
            ->get();

        return view('semestres.index', compact('semestres'));
    }

    /**
     * Store a newly created semestre in storage. 
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:semestres,code',
            'nom' => 'required|string|max:255',
            'ordre' => 'required|integer|min:1',
        ]);

        Semestre::create($validated);

        return redirect()
            ->route('semestres.index')
            ->with('success', 'Semestre créé avec succès.');
    }

    /**
     * Update the specified semestre in storage. 
     */
    public function update(Request $request, Semestre $semestre): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:semestres,code,' . $semestre->id,
            'nom' => 'required|string|max: 255',
            'ordre' => 'required|integer|min: 1',
        ]);

        $semestre->update($validated);

        return redirect()
            ->route('semestres.index')
            ->with('success', 'Semestre mis à jour avec succès.');
    }

    /**
     * Remove the specified semestre from storage. 
     */
    public function destroy(Semestre $semestre): RedirectResponse
    {
        if ($semestre->modules()->exists()) {
            return redirect()
                ->route('semestres.index')
                ->with('error', 'Impossible de supprimer ce semestre car il contient des modules.');
        }

        $semestre->delete();

        return redirect()
            ->route('semestres.index')
            ->with('success', 'Semestre supprimé avec succès.');
    }
}