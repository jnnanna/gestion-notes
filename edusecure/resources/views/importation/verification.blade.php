@extends('layouts.app')

@section('title', 'Vérification OCR - Importation')
@section('page-title', 'Vérification & Validation OCR')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Importation', 'url' => route('importation.index')],
        ['label' => 'Vérification', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-4">
        <div class="size-12 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white shadow-lg shadow-green-500/20">
            <span class="material-symbols-outlined text-2xl icon-filled">fact_check</span>
        </div>
        <div>
            <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                Vérification & Validation des Données
            </h1>
            <p class="text-[#4c669a] dark:text-gray-400 mt-1">
                Vérifiez les résultats de l'OCR et corrigez les erreurs éventuelles
            </p>
        </div>
    </div>
</div>

{{-- Stepper --}}
<div class="mb-8">
    <div class="flex items-center justify-between max-w-3xl mx-auto">
        {{-- Étape 1 :   Complétée --}}
        <div class="flex items-center gap-3 flex-1">
            <div class="size-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold shadow-lg">
                <span class="material-symbols-outlined text-[20px]">check</span>
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-medium text-green-600">Upload</p>
                <p class="text-xs text-[#4c669a] dark: text-gray-400">Terminé</p>
            </div>
        </div>
        <div class="h-0.5 flex-1 bg-green-500 mx-2"></div>
        
        {{-- Étape 2 :  Complétée --}}
        <div class="flex items-center gap-3 flex-1">
            <div class="size-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold shadow-lg">
                <span class="material-symbols-outlined text-[20px]">check</span>
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-medium text-green-600">Catégorisation</p>
                <p class="text-xs text-[#4c669a] dark: text-gray-400">Terminé</p>
            </div>
        </div>
        <div class="h-0.5 flex-1 bg-[#135bec] mx-2"></div>
        
        {{-- Étape 3 :   Active --}}
        <div class="flex items-center gap-3 flex-1">
            <div class="size-10 rounded-full bg-[#135bec] text-white flex items-center justify-center font-bold shadow-lg shadow-blue-500/30 animate-pulse">
                3
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-bold text-[#135bec]">Vérification</p>
                <p class="text-xs text-[#4c669a] dark:text-gray-400">En cours</p>
            </div>
        </div>
    </div>
</div>

{{-- OCR Processing Status (si en cours) --}}
@if(($importation->statut ??  'en_cours') === 'en_cours')
<div class="mb-8">
    <x-card>
        <div class="flex items-center gap-4">
            <div class="size-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                <svg class="animate-spin size-6 text-[#135bec]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-[#0d121b] dark: text-white mb-1">Traitement OCR en cours...</h3>
                <p class="text-sm text-[#4c669a] dark:text-gray-400">Extraction des données à partir des documents scannés</p>
                <div class="mt-3">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs font-medium text-[#4c669a]">Progression</span>
                        <span class="text-xs font-bold text-[#135bec]">{{ $importation->fichiers_traites ??  3 }}/{{ $importation->fichiers_total ?? 5 }}</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-[#135bec] to-blue-600 rounded-full transition-all animate-pulse" style="width: 60%"></div>
                    </div>
                </div>
            </div>
            <button class="px-4 py-2 text-sm font-medium text-[#4c669a] hover:text-red-500 transition">
                Annuler
            </button>
        </div>
    </x-card>
</div>
@endif

{{-- Main Content --}}
<form action="{{ route('importation.store-verification', $importation) }}" method="POST">
    @csrf
    
    <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
        {{-- Left:   Document Preview (1/4) --}}
        <div class="xl:col-span-1">
            <div class="sticky top-24 space-y-4" x-data="{ currentDoc: 0 }">
                {{-- Document Selector --}}
                <x-card title="Documents" :padding="false">
                    <div class="divide-y divide-[#e7ebf3] dark:divide-gray-800 max-h-[600px] overflow-y-auto">
                        @forelse($importation->fichiers ??  [] as $index => $fichier)
                            <button 
                                type="button"
                                @click="currentDoc = {{ $index }}"
                                : class="currentDoc === {{ $index }} ? 'bg-blue-50 dark:bg-blue-900/20 border-l-4 border-l-[#135bec]' : 'border-l-4 border-l-transparent hover:bg-[#f8f9fc] dark:hover:bg-gray-800'"
                                class="w-full p-4 text-left transition-all"
                            >
                                <div class="flex items-center gap-3">
                                    <div class="size-12 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-900/10 flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-[#135bec] text-xl">description</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-[#0d121b] dark:text-white truncate">
                                            {{ $fichier->nom_original ??   'Doc ' . ($index + 1) }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-1">
                                            @if($fichier->ocr_traite ??  false)
                                                <x-badge variant="success" size="xs">OCR OK</x-badge>
                                            @else
                                                <x-badge variant="warning" size="xs">En attente</x-badge>
                                            @endif
                                            @if(($fichier->ocr_confiance ?? 95) < 80)
                                                <span class="text-xs text-orange-600 flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-[12px]">warning</span>
                                                    {{ $fichier->ocr_confiance ?? 75 }}%
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </button>
                        @empty
                            @foreach(range(1, 3) as $i)
                                <button 
                                    type="button"
                                    class="w-full p-4 text-left border-l-4 border-l-transparent hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition-all"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="size-12 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-900/10 flex items-center justify-center flex-shrink-0">
                                            <span class="material-symbols-outlined text-[#135bec] text-xl">description</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-[#0d121b] dark:text-white truncate">
                                                Document {{ $i }}
                                            </p>
                                            <x-badge variant="success" size="xs">OCR OK</x-badge>
                                        </div>
                                    </div>
                                </button>
                            @endforeach
                        @endforelse
                    </div>
                </x-card>

                {{-- OCR Confidence --}}
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/10 dark:to-emerald-900/10 rounded-xl p-4 border border-green-100 dark:border-green-900/20">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-green-900 dark:text-green-300">Confiance OCR</span>
                        <span class="text-2xl font-bold text-green-600">95%</span>
                    </div>
                    <div class="h-2 bg-white/50 dark:bg-black/20 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500 rounded-full" style="width: 95%"></div>
                    </div>
                    <p class="text-xs text-green-700 dark:text-green-400 mt-2">Excellente qualité de reconnaissance</p>
                </div>
            </div>
        </div>

        {{-- Center:   Data Table (2/4) --}}
        <div class="xl:col-span-2 space-y-6">
            {{-- Table Actions --}}
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">
                    Notes Extraites 
                    <span class="ml-2 text-sm font-normal text-[#4c669a]">(35 étudiants)</span>
                </h3>
                <div class="flex items-center gap-2">
                    <button type="button" class="px-3 py-2 text-sm font-medium text-[#4c669a] hover:text-[#135bec] flex items-center gap-1">
                        <span class="material-symbols-outlined text-[18px]">download</span>
                        Exporter
                    </button>
                    <button type="button" class="px-3 py-2 text-sm font-medium text-[#4c669a] hover:text-[#135bec] flex items-center gap-1">
                        <span class="material-symbols-outlined text-[18px]">compare</span>
                        Mode côte-à-côte
                    </button>
                </div>
            </div>

            {{-- Extracted Notes Table --}}
            <x-card : padding="false">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-[#f8f9fc] dark:bg-gray-800/50 border-b border-[#e7ebf3] dark:border-gray-800 sticky top-0">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                                </th>
                                <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Matricule</th>
                                <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Nom & Prénom</th>
                                <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark: text-gray-400">Note/20</th>
                                <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Confiance</th>
                                <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                            @forelse($notes ??  [] as $index => $note)
                                <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition" x-data="{ editing: false }">
                                    <td class="px-4 py-3">
                                        <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="font-mono text-[#4c669a] dark:text-gray-400">{{ $note['matricule'] ??  '2023-0001' }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div x-show="! editing">
                                            <p class="font-medium text-[#0d121b] dark:text-white">{{ $note['nom'] ?? 'ALAMI Ahmed' }}</p>
                                        </div>
                                        <input 
                                            x-show="editing" 
                                            type="text" 
                                            value="{{ $note['nom'] ?? 'ALAMI Ahmed' }}"
                                            class="w-full px-2 py-1 text-sm border border-[#135bec] rounded focus:ring-[#135bec] focus:border-[#135bec]"
                                            style="display: none;"
                                        >
                                    </td>
                                    <td class="px-4 py-3">
                                        <div x-show="!editing" class="flex items-center gap-2">
                                            <span class="font-bold {{ ($note['note'] ?? 15.5) >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $note['note'] ??  15.5 }}
                                            </span>
                                            @if(($note['confiance'] ?? 98) < 80)
                                                <span class="material-symbols-outlined text-orange-500 text-[16px]" title="Faible confiance">warning</span>
                                            @endif
                                        </div>
                                        <input 
                                            x-show="editing" 
                                            type="number" 
                                            step="0.25"
                                            min="0"
                                            max="20"
                                            value="{{ $note['note'] ?? 15.5 }}"
                                            class="w-20 px-2 py-1 text-sm border border-[#135bec] rounded focus: ring-[#135bec] focus:border-[#135bec]"
                                            style="display: none;"
                                        >
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="flex-1 h-1. 5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                                <div class="h-full bg-{{ ($note['confiance'] ?? 98) >= 90 ? 'green' : (($note['confiance'] ?? 98) >= 70 ? 'orange' : 'red') }}-500 rounded-full" style="width: {{ $note['confiance'] ?? 98 }}%"></div>
                                            </div>
                                            <span class="text-xs font-medium text-[#4c669a] w-10 text-right">{{ $note['confiance'] ?? 98 }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <button 
                                                type="button" 
                                                @click="editing = !editing"
                                                x-show="! editing"
                                                class="p-1 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 text-[#135bec] transition"
                                                title="Éditer"
                                            >
                                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                            </button>
                                            <div x-show="editing" class="flex gap-1" style="display: none;">
                                                <button 
                                                    type="button" 
                                                    @click="editing = false"
                                                    class="p-1 rounded hover:bg-green-50 dark:hover:bg-green-900/20 text-green-600 transition"
                                                    title="Valider"
                                                >
                                                    <span class="material-symbols-outlined text-[18px]">check</span>
                                                </button>
                                                <button 
                                                    type="button" 
                                                    @click="editing = false"
                                                    class="p-1 rounded hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 transition"
                                                    title="Annuler"
                                                >
                                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                {{-- Sample Data --}}
                                @foreach([
                                    ['matricule' => '2023-0001', 'nom' => 'ALAMI Ahmed', 'note' => 15.5, 'confiance' => 98],
                                    ['matricule' => '2023-0002', 'nom' => 'BENALI Fatima', 'note' => 12.75, 'confiance' => 95],
                                    ['matricule' => '2023-0003', 'nom' => 'CHAKIR Mohamed', 'note' => 8.5, 'confiance' => 72],
                                    ['matricule' => '2023-0004', 'nom' => 'IDRISSI Sara', 'note' => 16.25, 'confiance' => 99],
                                    ['matricule' => '2023-0005', 'nom' => 'MANSOURI Karim', 'note' => 14.0, 'confiance' => 96],
                                ] as $sample)
                                    <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition" x-data="{ editing: false }">
                                        <td class="px-4 py-3">
                                            <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="font-mono text-[#4c669a] dark: text-gray-400">{{ $sample['matricule'] }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div x-show="!editing">
                                                <p class="font-medium text-[#0d121b] dark:text-white">{{ $sample['nom'] }}</p>
                                            </div>
                                            <input 
                                                x-show="editing" 
                                                type="text" 
                                                value="{{ $sample['nom'] }}"
                                                class="w-full px-2 py-1 text-sm border border-[#135bec] rounded focus:ring-[#135bec] focus:border-[#135bec]"
                                                style="display: none;"
                                            >
                                        </td>
                                        <td class="px-4 py-3">
                                            <div x-show="!editing" class="flex items-center gap-2">
                                                <span class="font-bold {{ $sample['note'] >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                                    {{ $sample['note'] }}
                                                </span>
                                                @if($sample['confiance'] < 80)
                                                    <span class="material-symbols-outlined text-orange-500 text-[16px]" title="Faible confiance">warning</span>
                                                @endif
                                            </div>
                                            <input 
                                                x-show="editing" 
                                                type="number" 
                                                step="0.25"
                                                min="0"
                                                max="20"
                                                value="{{ $sample['note'] }}"
                                                class="w-20 px-2 py-1 text-sm border border-[#135bec] rounded focus:ring-[#135bec] focus:border-[#135bec]"
                                                style="display: none;"
                                            >
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                <div class="flex-1 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                                    <div class="h-full bg-{{ $sample['confiance'] >= 90 ? 'green' : ($sample['confiance'] >= 70 ? 'orange' : 'red') }}-500 rounded-full" style="width: {{ $sample['confiance'] }}%"></div>
                                                </div>
                                                <span class="text-xs font-medium text-[#4c669a] w-10 text-right">{{ $sample['confiance'] }}%</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                <button 
                                                    type="button" 
                                                    @click="editing = !editing"
                                                    x-show="!editing"
                                                    class="p-1 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 text-[#135bec] transition"
                                                    title="Éditer"
                                                >
                                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                                </button>
                                                <div x-show="editing" class="flex gap-1" style="display: none;">
                                                    <button 
                                                        type="button" 
                                                        @click="editing = false"
                                                        class="p-1 rounded hover:bg-green-50 dark:hover:bg-green-900/20 text-green-600 transition"
                                                        title="Valider"
                                                    >
                                                        <span class="material-symbols-outlined text-[18px]">check</span>
                                                    </button>
                                                    <button 
                                                        type="button" 
                                                        @click="editing = false"
                                                        class="p-1 rounded hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 transition"
                                                        title="Annuler"
                                                    >
                                                        <span class="material-symbols-outlined text-[18px]">close</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>

            {{-- Bulk Actions --}}
            <div class="flex items-center justify-between px-4 py-3 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg border border-[#e7ebf3] dark:border-gray-700">
                <span class="text-sm text-[#4c669a] dark:text-gray-400">
                    <span class="font-bold text-[#135bec]">0</span> ligne(s) sélectionnée(s)
                </span>
                <div class="flex items-center gap-2">
                    <button type="button" class="px-3 py-1.5 text-sm font-medium text-[#4c669a] hover:text-[#135bec] rounded-lg hover:bg-white dark:hover:bg-gray-700 transition">
                        Tout sélectionner
                    </button>
                    <button type="button" class="px-3 py-1.5 text-sm font-medium text-[#4c669a] hover: text-red-500 rounded-lg hover: bg-white dark:hover:bg-gray-700 transition">
                        Supprimer sélection
                    </button>
                </div>
            </div>
        </div>

        {{-- Right:   Summary & Actions (1/4) --}}
        <div class="xl:col-span-1 space-y-6">
            {{-- Summary Stats --}}
            <x-card title="Résumé" icon="summarize">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-lg bg-green-50 dark:bg-green-900/10">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600">check_circle</span>
                            <span class="text-sm font-medium text-green-900 dark:text-green-300">Valides</span>
                        </div>
                        <span class="text-lg font-bold text-green-600">32</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-lg bg-orange-50 dark:bg-orange-900/10">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-orange-600">warning</span>
                            <span class="text-sm font-medium text-orange-900 dark:text-orange-300">À vérifier</span>
                        </div>
                        <span class="text-lg font-bold text-orange-600">3</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-lg bg-blue-50 dark:bg-blue-900/10">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#135bec]">groups</span>
                            <span class="text-sm font-medium text-blue-900 dark:text-blue-300">Total étudiants</span>
                        </div>
                        <span class="text-lg font-bold text-[#135bec]">35</span>
                    </div>

                    <hr class="border-[#e7ebf3] dark:border-gray-700">

                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-[#4c669a] dark: text-gray-400">Moyenne générale</span>
                            <span class="font-bold text-[#0d121b] dark:text-white">13.45/20</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-[#4c669a] dark:text-gray-400">Note minimale</span>
                            <span class="font-bold text-red-600">7. 5/20</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-[#4c669a] dark: text-gray-400">Note maximale</span>
                            <span class="font-bold text-green-600">18.75/20</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-[#4c669a] dark:text-gray-400">Taux de réussite</span>
                            <span class="font-bold text-green-600">91.4%</span>
                        </div>
                    </div>
                </div>
            </x-card>

            {{-- Warnings --}}
            <div class="bg-orange-50 dark:bg-orange-900/10 rounded-xl p-4 border border-orange-100 dark:border-orange-900/20">
                <div class="flex items-start gap-3 mb-3">
                    <span class="material-symbols-outlined text-orange-600 text-[20px] mt-0.5">warning</span>
                    <div>
                        <p class="text-sm font-semibold text-orange-900 dark:text-orange-300">Attention !</p>
                        <p class="text-xs text-orange-700 dark:text-orange-400 mt-1">
                            3 lignes nécessitent votre attention (faible confiance OCR)
                        </p>
                    </div>
                </div>
                <button type="button" class="w-full py-2 bg-orange-100 dark:bg-orange-900/20 hover:bg-orange-200 dark:hover:bg-orange-900/30 rounded-lg text-sm font-medium text-orange-900 dark:text-orange-300 transition">
                    Voir les erreurs
                </button>
            </div>

            {{-- Final Actions --}}
            <div class="space-y-3">
                <x-button type="submit" variant="primary" size="lg" icon="check_circle" class="w-full">
                    Valider & Finaliser
                </x-button>

                <button type="button" class="w-full py-2.5 text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Enregistrer brouillon
                </button>

                <button type="button" class="w-full py-2.5 text-sm font-medium text-red-500 hover:text-red-600 transition flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">cancel</span>
                    Annuler l'importation
                </button>
            </div>

            {{-- Help --}}
            <div class="bg-blue-50 dark:bg-blue-900/10 rounded-xl p-4 border border-blue-100 dark:border-blue-900/20">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-blue-600 text-[20px] mt-0.5">lightbulb</span>
                    <div>
                        <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">Raccourcis clavier :</p>
                        <ul class="text-xs text-blue-700 dark: text-blue-400 space-y-1">
                            <li><kbd class="px-1. 5 py-0.5 bg-white dark:bg-gray-800 rounded text-xs">E</kbd> Éditer la ligne sélectionnée</li>
                            <li><kbd class="px-1.5 py-0.5 bg-white dark:bg-gray-800 rounded text-xs">↑ ↓</kbd> Naviguer entre les lignes</li>
                            <li><kbd class="px-1.5 py-0.5 bg-white dark:bg-gray-800 rounded text-xs">Enter</kbd> Valider modification</li>
                            <li><kbd class="px-1.5 py-0.5 bg-white dark:bg-gray-800 rounded text-xs">Esc</kbd> Annuler modification</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        // E pour éditer
        if (e.key === 'e' || e.key === 'E') {
            console.log('Edit mode');
        }
        // Escape pour annuler
        if (e.key === 'Escape') {
            console.log('Cancel edit');
        }
    });

    // Auto-save
    let autoSaveTimer;
    document.querySelectorAll('input[type="number"], input[type="text"]').forEach(input => {
        input.addEventListener('change', () => {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                console.log('Auto-saving changes.. .');
                // Implement AJAX save
            }, 2000);
        });
    });
</script>
@endpush