<?php

namespace App\Http\Controllers;

use App\Models\FeuilleNote;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ValidationController extends Controller
{
    public function index(): View
    {
        $feuillesEnAttente = FeuilleNote:: enAttente()
            ->with(['module', 'enseignant'])
            ->latest()
            ->paginate(20);

        return view('validation.index', compact('feuillesEnAttente'));
    }

    public function show(FeuilleNote $feuilleNote): View
    {
        $feuilleNote->load(['module', 'notes. etudiant', 'enseignant']);
        return view('validation.detail', compact('feuilleNote'));
    }

    public function valider(FeuilleNote $feuilleNote): RedirectResponse
    {
        $feuilleNote->valider(Auth::user());

        return redirect()->route('validation.index')
            ->with('success', 'Feuille de notes validée avec succès.');
    }

    public function rejeter(Request $request, FeuilleNote $feuilleNote): RedirectResponse
    {
        $feuilleNote->rejeter();

        return redirect()->route('validation.index')
            ->with('success', 'Feuille de notes rejetée.');
    }

    public function validerSelection(Request $request): RedirectResponse
    {
        // TODO: Valider plusieurs feuilles
        
        return back()->with('success', 'Feuilles validées avec succès.');
    }

    public function rejeterSelection(Request $request): RedirectResponse
    {
        // TODO: Rejeter plusieurs feuilles
        
        return back()->with('success', 'Feuilles rejetées.');
    }

    public function updateNote(Request $request, Note $note): RedirectResponse
    {
        $validated = $request->validate([
            'note_examen' => 'nullable|numeric|min:0|max:20',
            'note_cc' => 'nullable|numeric|min:0|max:20',
            'note_tp' => 'nullable|numeric|min:0|max:20',
        ]);

        $note->update($validated);

        return back()->with('success', 'Note mise à jour avec succès.');
    }
}