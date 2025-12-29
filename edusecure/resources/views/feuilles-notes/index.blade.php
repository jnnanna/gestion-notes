@extends('layouts.app')

@section('title', 'Feuilles de Notes')
@section('page-title', 'Feuilles de Notes')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Feuilles de Notes', 'url' => route('feuilles-notes.index')],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="size-12 rounded-xl bg-gradient-to-br from-[#135bec] to-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                    <span class="material-symbols-outlined text-2xl icon-filled">description</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                        Feuilles de Notes
                    </h1>
                </div>
            </div>
            <p class="text-[#4c669a] dark:text-gray-400 text-lg leading-relaxed">
                Consultez et gérez toutes les feuilles de notes importées
            </p>
        </div>
        <div class="flex gap-3">
            <x-button variant="secondary" icon="filter_list" size="md">
                Filtres
            </x-button>
            <a href="{{ route('importation.index') }}">
                <x-button variant="primary" icon="add" size="md">
                    Nouvelle Importation
                </x-button>
            </a>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat-card 
        title="Total Feuilles" 
        value="{{ $stats['total'] ??  156 }}" 
        icon="description" 
        iconBg="blue"
        subtitle="Toutes années"
    />
    
    <x-stat-card 
        title="Validées" 
        value="{{ $stats['validees'] ?? 142 }}" 
        icon="check_circle" 
        iconBg="green"
        trend="up"
        trendValue="91%"
        subtitle="Taux validation"
    />
    
    <x-stat-card 
        title="En attente" 
        value="{{ $stats['en_attente'] ?? 12 }}" 
        icon="pending_actions" 
        iconBg="orange"
        subtitle="À traiter"
    />
    
    <x-stat-card 
        title="Verrouillées" 
        value="{{ $stats['verrouillees'] ?? 98 }}" 
        icon="lock" 
        iconBg="purple"
        subtitle="Finalisées"
    />
</div>

{{-- Filters Bar --}}
<div class="bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl p-5 shadow-sm mb-6">
    <form method="GET" action="{{ route('feuilles-notes.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <x-input 
                type="search"
                name="search"
                placeholder="Rechercher..."
                icon="search"
                value="{{ request('search') }}"
            />
            
            <x-select 
                name="statut" 
                label="Statut"
                :options="[
                    '' => 'Tous les statuts',
                    'brouillon' => 'Brouillon',
                    'soumis' => 'Soumis',
                    'valide' => 'Validé',
                    'verrouille' => 'Verrouillé',
                    'rejete' => 'Rejeté',
                ]"
                value="{{ request('statut') }}"
            />
            
            <x-select 
                name="filiere_id" 
                label="Filière"
                :options="[
                    '' => 'Toutes',
                    1 => 'Génie Logiciel',
                    2 => 'Big Data & IA',
                    3 => 'Réseaux & Télécoms',
                ]"
                value="{{ request('filiere_id') }}"
            />
            
            <x-select 
                name="annee_id" 
                label="Année"
                :options="[
                    '' => 'Toutes',
                    1 => '2023-2024',
                    2 => '2024-2025',
                ]"
                value="{{ request('annee_id') }}"
            />
            
            <div class="flex items-end gap-2">
                <x-button type="submit" variant="secondary" size="md" icon="search" class="flex-1">
                    Rechercher
                </x-button>
                <a href="{{ route('feuilles-notes.index') }}" class="px-3 py-2 text-sm text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                    <span class="material-symbols-outlined">refresh</span>
                </a>
            </div>
        </div>
    </form>
</div>

{{-- Tabs --}}
<div class="mb-6 border-b border-[#e7ebf3] dark:border-gray-800">
    <div class="flex gap-8">
        <a href="{{ route('feuilles-notes.index') }}" class="relative flex items-center gap-2 pb-4 text-sm font-bold text-[#135bec]">
            <span class="material-symbols-outlined">list</span>
            Toutes
            <x-badge variant="default">{{ $stats['total'] ??  156 }}</x-badge>
            <span class="absolute bottom-0 left-0 h-0.5 w-full bg-[#135bec]"></span>
        </a>
        <a href="{{ route('feuilles-notes.index', ['statut' => 'soumis']) }}" class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
            <span class="material-symbols-outlined group-hover:text-[#135bec]">pending_actions</span>
            En attente
            <x-badge variant="warning">{{ $stats['en_attente'] ?? 12 }}</x-badge>
        </a>
        <a href="{{ route('feuilles-notes.index', ['statut' => 'valide']) }}" class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
            <span class="material-symbols-outlined group-hover:text-[#135bec]">check_circle</span>
            Validées
            <x-badge variant="success">{{ $stats['validees'] ?? 142 }}</x-badge>
        </a>
        <a href="{{ route('feuilles-notes.index', ['statut' => 'verrouille']) }}" class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
            <span class="material-symbols-outlined group-hover:text-[#135bec]">lock</span>
            Verrouillées
            <x-badge variant="default">{{ $stats['verrouillees'] ?? 98 }}</x-badge>
        </a>
    </div>
</div>

{{-- Table --}}
<x-card :padding="false">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-[#f8f9fc] dark:bg-gray-800/50 border-b border-[#e7ebf3] dark:border-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left w-12">
                        <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                    </th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Code</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Module</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Filière</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Enseignant</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Étudiants</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Date</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Statut</th>
                    <th class="px-4 py-3 text-right font-semibold text-[#4c669a] dark:text-gray-400">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                @forelse($feuillesNotes ??  [] as $feuille)
                    <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition">
                        <td class="px-4 py-3">
                            <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-mono text-[#135bec] font-medium">{{ $feuille->code }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-[#0d121b] dark:text-white">{{ $feuille->module->nom }}</p>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $feuille->module->code }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-[#4c669a] dark:text-gray-400">{{ $feuille->module->filiere->nom }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-[#4c669a] dark:text-gray-400">{{ $feuille->enseignant->name }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-medium text-[#0d121b] dark:text-white">{{ $feuille->notes_count }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-[#4c669a] dark:text-gray-400">{{ $feuille->date_examen?->format('d/m/Y') }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <x-badge :variant="$feuille->statut->value === 'valide' ? 'success' : ($feuille->statut->value === 'soumis' ? 'warning' : ($feuille->statut->value === 'verrouille' ? 'default' : 'danger'))">
                                {{ $feuille->statut->label() }}
                            </x-badge>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('feuilles-notes.show', $feuille) }}" class="p-1.5 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 text-[#135bec] transition" title="Voir">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </a>
                                <a href="{{ route('feuilles-notes.historique', $feuille) }}" class="p-1.5 rounded hover:bg-purple-50 dark:hover:bg-purple-900/20 text-purple-600 transition" title="Historique">
                                    <span class="material-symbols-outlined text-[18px]">history</span>
                                </a>
                                <button class="p-1.5 rounded hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 transition" title="Supprimer">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    {{-- Sample Data --}}
                    @foreach([
                        ['code' => 'FN-2024-001', 'module' => 'Algorithmique Avancée', 'module_code' => 'INF-301', 'filiere' => 'Génie Logiciel - L3', 'enseignant' => 'Dr. Sarah Martin', 'etudiants' => 35, 'date' => '15/12/2024', 'statut' => 'valide'],
                        ['code' => 'FN-2024-002', 'module' => 'Bases de Données', 'module_code' => 'INF-302', 'filiere' => 'Génie Logiciel - L3', 'enseignant' => 'Pr. Ahmed Benali', 'etudiants' => 32, 'date' => '14/12/2024', 'statut' => 'soumis'],
                        ['code' => 'FN-2024-003', 'module' => 'Développement Web', 'module_code' => 'INF-304', 'filiere' => 'Génie Logiciel - L3', 'enseignant' => 'Dr. Marie Dubois', 'etudiants' => 38, 'date' => '13/12/2024', 'statut' => 'verrouille'],
                        ['code' => 'FN-2024-004', 'module' => 'Machine Learning', 'module_code' => 'BD-502', 'filiere' => 'Big Data & IA - M1', 'enseignant' => 'Pr. Karim El Amrani', 'etudiants' => 28, 'date' => '12/12/2024', 'statut' => 'valide'],
                        ['code' => 'FN-2024-005', 'module' => 'Réseaux & Sécurité', 'module_code' => 'RT-401', 'filiere' => 'Réseaux & Télécoms - L3', 'enseignant' => 'Dr. Hassan Idrissi', 'etudiants' => 30, 'date' => '11/12/2024', 'statut' => 'valide'],
                    ] as $sample)
                        <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition">
                            <td class="px-4 py-3">
                                <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-mono text-[#135bec] font-medium">{{ $sample['code'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-medium text-[#0d121b] dark:text-white">{{ $sample['module'] }}</p>
                                <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $sample['module_code'] }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-[#4c669a] dark:text-gray-400">{{ $sample['filiere'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-[#4c669a] dark:text-gray-400">{{ $sample['enseignant'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-[#0d121b] dark:text-white">{{ $sample['etudiants'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-[#4c669a] dark:text-gray-400">{{ $sample['date'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <x-badge :variant="$sample['statut'] === 'valide' ? 'success' : ($sample['statut'] === 'soumis' ? 'warning' : 'default')">
                                    {{ ucfirst($sample['statut']) }}
                                </x-badge>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('feuilles-notes.show', 1) }}" class="p-1.5 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 text-[#135bec] transition" title="Voir">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    </a>
                                    <a href="{{ route('feuilles-notes.historique', 1) }}" class="p-1.5 rounded hover:bg-purple-50 dark:hover:bg-purple-900/20 text-purple-600 transition" title="Historique">
                                        <span class="material-symbols-outlined text-[18px]">history</span>
                                    </a>
                                    <button class="p-1.5 rounded hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 transition" title="Supprimer">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Table Footer --}}
    <div class="p-4 bg-[#f8f9fc] dark:bg-gray-800/50 border-t border-[#e7ebf3] dark:border-gray-800">
        <div class="flex items-center justify-between">
            <span class="text-sm text-[#4c669a] dark:text-gray-400">
                Affichage de 1 à 5 sur {{ $stats['total'] ??  156 }} résultats
            </span>
            <div class="flex items-center gap-2">
                {{-- Pagination here --}}
            </div>
        </div>
    </div>
</x-card>
@endsection