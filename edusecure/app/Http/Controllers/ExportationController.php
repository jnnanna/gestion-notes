<?php

namespace App\Http\Controllers;

use App\Models\Export;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ExportationController extends Controller
{
    public function index(): View
    {
        return view('exportation.index');
    }

    public function generer(Request $request): RedirectResponse
    {
        // TODO: Générer l'export
        
        return back()->with('success', 'Export généré avec succès.');
    }

    public function historique(): View
    {
        $exports = Export::where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        return view('exportation.historique', compact('exports'));
    }

    public function telecharger(Export $export)
    {
        $export->incrementerTelechargements();
        
        // TODO: Retourner le fichier
        return back();
    }

    public function apercu(Request $request): View
    {
        return view('exportation.apercu');
    }

    public function nettoyerExpires(Request $request): RedirectResponse
    {
        $count = Export::nettoyerExpires();

        return back()->with('success', "Nettoyé : {$count} export(s) expiré(s) supprimé(s).");
    }
}