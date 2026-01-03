@extends('layouts.app')

@section('title', 'Catégorisation - Importation')
@section('page-title', 'Catégorisation des Fichiers')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Importation', 'url' => route('importation.index')],
        ['label' => 'Catégorisation', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-4">
        <div class="size-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-purple-500/20">
            <span class="material-symbols-outlined text-2xl icon-filled">category</span>
        </div>
        <div>
            <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                Catégorisation des Fichiers
            </h1>
            <p class="text-[#4c669a] dark:text-gray-400 mt-1">
                Assignez les modules et filières à vos fichiers importés
            </p>
        </div>
    </div>
</div>

{{-- Stepper --}}
<div class="mb-8">
    <div class="flex items-center justify-between max-w-3xl mx-auto">
        {{-- Étape 1 :  Complétée --}}
        <div class="flex items-center gap-3 flex-1">
            <div class="size-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold shadow-lg">
                <span class="material-symbols-outlined text-[20px]">check</span>
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-medium text-green-600">Upload</p>
                <p class="text-xs text-[#4c669a] dark:text-gray-400">Terminé</p>
            </div>
        </div>
        <div class="h-0.5 flex-1 bg-[#135bec] mx-2"></div>
        
        {{-- Étape 2 : Active --}}
        <div class="flex items-center gap-3 flex-1">
            <div class="size-10 rounded-full bg-[#135bec] text-white flex items-center justify-center font-bold shadow-lg shadow-blue-500/30 animate-pulse">
                2
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-bold text-[#135bec]">Catégorisation</p>
                <p class="text-xs text-[#4c669a] dark:text-gray-400">En cours</p>
            </div>
        </div>
        <div class="h-0.5 flex-1 bg-gray-200 dark:bg-gray-700 mx-2"></div>
        
        {{-- Étape 3 : Inactive --}}
        <div class="flex items-center gap-3 flex-1">
            <div class="size-10 rounded-full bg-gray-200 dark:bg-gray-700 text-[#4c669a] flex items-center justify-center font-bold">
                3
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-medium text-[#4c669a] dark:text-gray-400">Vérification</p>
                <p class="text-xs text-[#4c669a] dark:text-gray-500">OCR & Validation</p>
            </div>
        </div>
    </div>
</div>

{{-- Main Content --}}
<form action="{{ route('importation.store-categorisation', $importation) }}" method="POST">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column :  Files List (2/3) --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Global Filters --}}
            <x-card title="Filtres Globaux" icon="filter_list">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-select 
                        name="global_annee_academique_id" 
                        label="Année Académique"
                        :options="[
                            1 => '2023-2024',
                            2 => '2024-2025',
                        ]"
                        placeholder="Sélectionner..."
                    />
                    
                    <x-select 
                        name="global_filiere_id" 
                        label="Filière (par défaut)"
                        :options="[
                            1 => 'Génie Logiciel',
                            2 => 'Big Data & IA',
                            3 => 'Réseaux & Télécoms',
                        ]"
                        placeholder="Sélectionner..."
                    />
                    
                    <x-select 
                        name="global_semestre_id" 
                        label="Semestre (par défaut)"
                        :options="[
                            1 => 'S1',
                            2 => 'S2',
                            3 => 'S3',
                            4 => 'S4',
                            5 => 'S5',
                            6 => 'S6',
                        ]"
                        placeholder="Sélectionner..."
                    />
                </div>
                
                <div class="mt-4 flex items-center justify-end gap-3">
                    <button type="button" class="text-sm font-medium text-[#4c669a] hover:text-[#135bec]">
                        Réinitialiser
                    </button>
                    <x-button type="button" variant="secondary" size="sm" icon="done_all">
                        Appliquer à tous
                    </x-button>
                </div>
            </x-card>

            {{-- Files List --}}
            <x-card :padding="false">
                <x-slot name="title">
                    <div class="flex items-center justify-between w-full">
                        <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">
                            Fichiers Importés 
                            <span class="ml-2 text-sm font-normal text-[#4c669a]">({{ $importation->fichiers_total ??  5 }} fichiers)</span>
                        </h3>
                        <div class="flex items-center gap-2">
                            <x-badge variant="warning">{{ ($importation->fichiers_total ?? 5) - ($importation->fichiers_traites ?? 3) }} à catégoriser</x-badge>
                        </div>
                    </div>
                </x-slot>

                <div class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                    @forelse($importation->fichiers ?? [] as $index => $fichier)
                        <div class="p-6 hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition-colors" x-data="{ expanded: {{ $index === 0 ? 'true' : 'false' }} }">
                            {{-- File Header --}}
                            <div class="flex items-center gap-4">
                                {{-- Thumbnail --}}
                                <div class="size-16 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-900/10 flex items-center justify-center flex-shrink-0 border border-blue-200 dark:border-blue-800">
                                    <span class="material-symbols-outlined text-[#135bec] text-2xl">description</span>
                                </div>

                                {{-- File Info --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="font-bold text-[#0d121b] dark:text-white truncate">
                                            {{ $fichier->nom_original ?? 'Feuille_Notes_Algorithmique_S5.pdf' }}
                                        </h4>
                                        @if($fichier->categorise ?? false)
                                            <x-badge variant="success" dot>Catégorisé</x-badge>
                                        @else
                                            <x-badge variant="warning" dot>En attente</x-badge>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-4 text-xs text-[#4c669a] dark:text-gray-400">
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">insert_drive_file</span>
                                            {{ $fichier->type_mime ?? 'PDF' }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">data_usage</span>
                                            {{ $fichier->taille_humaine ?? '2.3 MB' }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">schedule</span>
                                            {{ $fichier->created_at?->diffForHumans() ?? 'Il y a 5 min' }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Expand Button --}}
                                <button 
                                    type="button"
                                    @click="expanded = !expanded"
                                    class="p-2 rounded-lg hover:bg-white dark:hover:bg-gray-700 text-[#4c669a] transition"
                                >
                                    <span class="material-symbols-outlined transition-transform" :class="expanded && 'rotate-180'">expand_more</span>
                                </button>
                            </div>

                            {{-- Categorization Form --}}
                            <div x-show="expanded" x-collapse class="mt-4 pt-4 border-t border-[#e7ebf3] dark:border-gray-700">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <x-select 
                                        :name="'fichiers[' . ($fichier->id ?? $index) . '][module_id]'" 
                                        label="Module"
                                        :options="[
                                            1 => 'Algorithmique Avancée',
                                            2 => 'Bases de Données',
                                            3 => 'Développement Web',
                                            4 => 'Génie Logiciel',
                                        ]"
                                        placeholder="Sélectionner le module..."
                                        required
                                    />
                                    
                                    <x-select 
                                        :name="'fichiers[' . ($fichier->id ?? $index) . '][filiere_id]'" 
                                        label="Filière"
                                        :options="[
                                            1 => 'Génie Logiciel',
                                            2 => 'Big Data & IA',
                                            3 => 'Réseaux & Télécoms',
                                        ]"
                                        placeholder="Sélectionner la filière..."
                                        required
                                    />
                                    
                                    <x-select 
                                        :name="'fichiers[' . ($fichier->id ?? $index) . '][semestre_id]'" 
                                        label="Semestre"
                                        :options="[
                                            5 => 'Semestre 5',
                                            6 => 'Semestre 6',
                                        ]"
                                        placeholder="Sélectionner..."
                                        required
                                    />
                                    
                                    <x-input 
                                        :name="'fichiers[' . ($fichier->id ?? $index) . '][date_examen]'" 
                                        type="date"
                                        label="Date d'examen"
                                        icon="calendar_today"
                                    />
                                    
                                    <x-select 
                                        :name="'fichiers[' . ($fichier->id ?? $index) . '][type_evaluation]'" 
                                        label="Type d'évaluation"
                                        :options="[
                                            'examen' => 'Examen Final',
                                            'cc' => 'Contrôle Continu',
                                            'tp' => 'Travaux Pratiques',
                                            'projet' => 'Projet',
                                        ]"
                                        placeholder="Sélectionner..."
                                    />
                                    
                                    <x-input 
                                        :name="'fichiers[' . ($fichier->id ?? $index) . '][enseignant_id]'" 
                                        label="Enseignant responsable"
                                        placeholder="Rechercher..."
                                        icon="person"
                                    />
                                </div>

                                {{-- Preview & Actions --}}
                                <div class="mt-4 flex items-center justify-between pt-4 border-t border-[#e7ebf3] dark:border-gray-700">
                                    <button type="button" class="text-sm font-medium text-[#135bec] hover:text-[#0f4bc4] flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        Aperçu du fichier
                                    </button>
                                    <div class="flex items-center gap-2">
                                        <button type="button" class="text-sm font-medium text-red-500 hover:text-red-600 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                            Supprimer
                                        </button>
                                        <x-button type="button" variant="secondary" size="sm" icon="check">
                                            Valider
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- Sample Files --}}
                        @foreach(range(1, 3) as $i)
                            <div class="p-6 hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition-colors" x-data="{ expanded: {{ $i === 1 ? 'true' : 'false' }} }">
                                <div class="flex items-center gap-4">
                                    <div class="size-16 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-900/10 flex items-center justify-center flex-shrink-0 border border-blue-200 dark:border-blue-800">
                                        <span class="material-symbols-outlined text-[#135bec] text-2xl">description</span>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <h4 class="font-bold text-[#0d121b] dark:text-white truncate">
                                                Feuille_Notes_Module_{{ $i }}.pdf
                                            </h4>
                                            <x-badge variant="warning" dot>En attente</x-badge>
                                        </div>
                                        <div class="flex items-center gap-4 text-xs text-[#4c669a] dark:text-gray-400">
                                            <span class="flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[14px]">insert_drive_file</span>
                                                PDF
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[14px]">data_usage</span>
                                                {{ rand(1, 5) }}.{{ rand(1, 9) }} MB
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[14px]">schedule</span>
                                                Il y a {{ rand(5, 30) }} min
                                            </span>
                                        </div>
                                    </div>

                                    <button 
                                        type="button"
                                        @click="expanded = !expanded"
                                        class="p-2 rounded-lg hover:bg-white dark:hover:bg-gray-700 text-[#4c669a] transition"
                                    >
                                        <span class="material-symbols-outlined transition-transform" :class="expanded && 'rotate-180'">expand_more</span>
                                    </button>
                                </div>

                                <div x-show="expanded" x-collapse class="mt-4 pt-4 border-t border-[#e7ebf3] dark:border-gray-700">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <x-select 
                                            :name="'fichiers[' . $i . '][module_id]'" 
                                            label="Module"
                                            :options="[
                                                1 => 'Algorithmique Avancée',
                                                2 => 'Bases de Données',
                                                3 => 'Développement Web',
                                            ]"
                                            placeholder="Sélectionner..."
                                            required
                                        />
                                        
                                        <x-select 
                                            :name="'fichiers[' . $i . '][filiere_id]'" 
                                            label="Filière"
                                            :options="[
                                                1 => 'Génie Logiciel',
                                                2 => 'Big Data & IA',
                                            ]"
                                            placeholder="Sélectionner..."
                                            required
                                        />
                                        
                                        <x-select 
                                            :name="'fichiers[' . $i . '][semestre_id]'" 
                                            :options="[5 => 'S5', 6 => 'S6']"
                                            placeholder="Sélectionner..."
                                            required
                                        />
                                        
                                        <x-input 
                                            :name="'fichiers[' . $i . '][date_examen]'" 
                                            type="date"
                                            label="Date d'examen"
                                            icon="calendar_today"
                                        />
                                    </div>

                                    <div class="mt-4 flex items-center justify-between pt-4 border-t border-[#e7ebf3] dark:border-gray-700">
                                        <button type="button" class="text-sm font-medium text-[#135bec] hover:text-[#0f4bc4] flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                            Aperçu
                                        </button>
                                        <x-button type="button" variant="secondary" size="sm" icon="check">
                                            Valider
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforelse
                </div>
            </x-card>
        </div>

        {{-- Right Column :  Summary (1/3) --}}
        <div class="space-y-6">
            {{-- Progress --}}
            <x-card title="Progression" icon="bar_chart">
                <div class="space-y-4">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-[#0d121b] dark:text-white">Fichiers catégorisés</span>
                            <span class="text-sm font-bold text-[#135bec]">{{ $importation->fichiers_traites ?? 2 }}/{{ $importation->fichiers_total ?? 5 }}</span>
                        </div>
                        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-[#135bec] to-blue-600 rounded-full transition-all" style="width: {{ (($importation->fichiers_traites ?? 2) / ($importation->fichiers_total ?? 5)) * 100 }}%"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="text-center p-3 bg-green-50 dark:bg-green-900/10 rounded-lg border border-green-100 dark:border-green-900/20">
                            <p class="text-2xl font-bold text-green-600">{{ $importation->fichiers_traites ?? 2 }}</p>
                            <p class="text-xs text-green-700 dark:text-green-400 mt-1">Complétés</p>
                        </div>
                        <div class="text-center p-3 bg-orange-50 dark:bg-orange-900/10 rounded-lg border border-orange-100 dark:border-orange-900/20">
                            <p class="text-2xl font-bold text-orange-600">{{ ($importation->fichiers_total ?? 5) - ($importation->fichiers_traites ?? 2) }}</p>
                            <p class="text-xs text-orange-700 dark:text-orange-400 mt-1">Restants</p>
                        </div>
                    </div>
                </div>
            </x-card>

            {{-- Tips --}}
            <div class="bg-blue-50 dark:bg-blue-900/10 rounded-xl p-4 border border-blue-100 dark:border-blue-900/20">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-blue-600 text-[20px] mt-0.5">tips_and_updates</span>
                    <div>
                        <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">Conseils :</p>
                        <ul class="text-xs text-blue-700 dark:text-blue-400 space-y-1 list-disc list-inside">
                            <li>Utilisez les filtres globaux pour gagner du temps</li>
                            <li>Vérifiez bien le module avant de valider</li>
                            <li>Les informations peuvent être modifiées plus tard</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col gap-3">
                <x-button type="submit" variant="primary" size="lg" icon="arrow_forward" iconPosition="right" class="w-full">
                    Continuer vers la vérification
                </x-button>
                
                <button type="button" class="w-full py-2.5 text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                    Enregistrer et continuer plus tard
                </button>
                
                <a href="{{ route('importation.index') }}" class="w-full py-2.5 text-center text-sm font-medium text-red-500 hover:text-red-600 transition">
                    Annuler l'importation
                </a>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    // Auto-save functionality
    let autoSaveTimer;
    document.querySelectorAll('select, input').forEach(element => {
        element.addEventListener('change', () => {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                console.log('Auto-saving...');
                // Implement AJAX save
            }, 2000);
        });
    });
</script>
@endpush