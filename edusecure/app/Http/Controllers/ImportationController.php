<?php

namespace App\Http\Controllers;

use App\Models\Importation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ImportationController extends Controller
{
    public function index(): View
    {
        return view('importation.index');
    }

    public function upload(Request $request): RedirectResponse
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        // TODO: Implémenter l'upload et création d'importation
        
        return redirect()->route('importation.categorisation', 1)
            ->with('success', 'Fichiers uploadés avec succès.');
    }

    public function categorisation(Importation $importation): View
    {
        return view('importation.categorisation', compact('importation'));
    }

    public function storeCategorisation(Request $request, Importation $importation): RedirectResponse
    {
        // TODO: Sauvegarder la catégorisation
        
        return redirect()->route('importation.verification', $importation)
            ->with('success', 'Catégorisation enregistrée.');
    }

    public function verification(Importation $importation): View
    {
        return view('importation.verification', compact('importation'));
    }

    public function storeVerification(Request $request, Importation $importation): RedirectResponse
    {
        // TODO:  Finaliser l'importation
        
        return redirect()->route('feuilles-notes.index')
            ->with('success', 'Importation terminée avec succès.');
    }

    public function processOCR(Importation $importation): RedirectResponse
    {
        // TODO: Lancer le traitement OCR
        
        return back()->with('info', 'Traitement OCR en cours...');
    }
}