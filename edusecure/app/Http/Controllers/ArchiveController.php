<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArchiveController extends Controller
{
    public function index(): View
    {
        $archives = Archive::with('anneeAcademique')
            ->latest()
            ->paginate(20);

        return view('archives.index', compact('archives'));
    }

    public function recherche(Request $request): View
    {
        // TODO: Implémenter la recherche
        
        return view('archives.index');
    }

    public function show(Archive $archive): View
    {
        return view('archives.show', compact('archive'));
    }
}