<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ParametreController extends Controller
{
    public function index(): View
    {
        return view('parametres.index');
    }

    public function update(Request $request): RedirectResponse
    {
        // TODO: Sauvegarder les paramètres
        
        return back()->with('success', 'Paramètres mis à jour avec succès.');
    }
}