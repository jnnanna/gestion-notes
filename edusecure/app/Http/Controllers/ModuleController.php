<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Filiere;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ModuleController extends Controller
{
    /**
     * Display a listing of modules. 
     */
    public function index(): View
    {
        $modules = Module::with(['filiere', 'semestre', 'responsable'])
            ->latest()
            ->paginate(10);

        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new module.
     */
    public function create(): View
    {
        $filieres = Filiere::active()->orderBy('nom')->get();
        $semestres = Semestre::orderBy('code')->get();
        $enseignants = User::role('enseignant')->orderBy('name')->get();

        return view('modules.create', compact('filieres', 'semestres', 'enseignants'));
    }

    /**
     * Store a newly created module in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:modules,code',
            'nom' => 'required|string|max:255',
            'filiere_id' => 'required|exists:filieres,id',
            'semestre_id' => 'required|exists:semestres,id',
            'responsable_id' => 'nullable|exists:users,id',
            'actif' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $validated['actif'] = $request->has('actif');

        Module::create($validated);

        return redirect()
            ->route('modules.index')
            ->with('success', 'Module créé avec succès.');
    }

    /**
     * Display the specified module.
     */
    public function show(Module $module): View
    {
        $module->load(['filiere', 'semestre', 'responsable', 'notes']);

        return view('modules. show', compact('module'));
    }

    /**
     * Show the form for editing the specified module. 
     */
    public function edit(Module $module): View
    {
        $filieres = Filiere::active()->orderBy('nom')->get();
        $semestres = Semestre::orderBy('code')->get();
        $enseignants = User::role('enseignant')->orderBy('name')->get();

        return view('modules.edit', compact('module', 'filieres', 'semestres', 'enseignants'));
    }

    /**
     * Update the specified module in storage.
     */
    public function update(Request $request, Module $module): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:modules,code,' . $module->id,
            'nom' => 'required|string|max:255',
            'filiere_id' => 'required|exists:filieres,id',
            'semestre_id' => 'required|exists:semestres,id',
            'responsable_id' => 'nullable|exists:users,id',
            'actif' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $validated['actif'] = $request->has('actif');

        $module->update($validated);

        return redirect()
            ->route('modules.index')
            ->with('success', 'Module mis à jour avec succès.');
    }

    /**
     * Remove the specified module from storage.
     */
    public function destroy(Module $module): RedirectResponse
    {
        // Vérifier si le module a des notes associées
        if ($module->notes()->exists()) {
            return redirect()
                ->route('modules.index')
                ->with('error', 'Impossible de supprimer ce module car il contient des notes.');
        }

        $module->delete();

        return redirect()
            ->route('modules.index')
            ->with('success', 'Module supprimé avec succès.');
    }
}