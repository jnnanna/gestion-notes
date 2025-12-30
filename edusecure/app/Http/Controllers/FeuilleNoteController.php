<?php

namespace App\Http\Controllers;

use App\Models\FeuilleNote;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FeuilleNoteController extends Controller
{
    public function index(): View
    {
        $feuillesNotes = FeuilleNote::with(['module', 'enseignant'])
            ->latest()
            ->paginate(20);

        return view('feuilles-notes.index', compact('feuillesNotes'));
    }

    public function show(FeuilleNote $feuilleNote): View
    {
        $feuilleNote->load(['module', 'notes.etudiant', 'enseignant']);
        return view('feuilles-notes.show', compact('feuilleNote'));
    }

    public function historique(FeuilleNote $feuilleNote): View
    {
        $feuilleNote->load('historiqueValidations. user');
        return view('feuilles-notes.historique', compact('feuilleNote'));
    }
}