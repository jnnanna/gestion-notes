@extends('layouts.app')

@section('title', 'Gestion des Étudiants')
@section('page-title', 'Gestion des Étudiants')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Étudiants', 'url' => route('etudiants.index')],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="size-12 rounded-xl bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center text-white shadow-lg shadow-teal-500/20">
                    <span class="material-symbols-outlined text-2xl icon-filled">school</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                        Gestion des Étudiants
                    </h1>
                </div>
            </div>
            <p class="text-[#4c669a] dark:text-gray-400 text-lg leading-relaxed">
                Consultez et gérez les dossiers de vos étudiants
            </p>
        </div>
        <div class="flex gap-3">
            <x-button variant="secondary" icon="upload" size="md">
                Importer (CSV/Excel)
            </x-button>
            <x-button variant="primary" icon="add" size="md">
                Ajouter un Étudiant
            </x-button>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat-card 
        title="Total Étudiants" 
        value="{{ $stats['total'] ?? 1247 }}" 
        icon="groups" 
        iconBg="teal"
        subtitle="Tous niveaux"
    />
    
    <x-stat-card 
        title="Actifs" 
        value="{{ $stats['actifs'] ?? 1198 }}" 
        icon="person_check" 
        iconBg="green"
        trend="up"
        trendValue="96%"
        subtitle="Inscrits cette année"
    />
    
    <x-stat-card 
        title="Nouveaux" 
        value="{{ $stats['nouveaux'] ?? 312 }}" 
        icon="person_add" 
        iconBg="blue"
        subtitle="Cette année"
    />
    
    <x-stat-card 
        title="Moyenne Générale" 
        value="{{ $stats['moyenne'] ??  '13.2' }}/20" 
        icon="trending_up" 
        iconBg="purple"
        subtitle="Tous étudiants"
    />
</div>

{{-- Filters Bar --}}
<div class="bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl p-5 shadow-sm mb-6">
    <form method="GET" action="{{ route('etudiants.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <x-input 
                type="search"
                name="search"
                placeholder="Rechercher (nom, matricule... )"
                icon="search"
                value="{{ request('search') }}"
                class="md:col-span-2"
            />
            
            <x-select 
                name="filiere_id" 
                label="Filière"
                :options="[
                    '' => 'Toutes les filières',
                    1 => 'Génie Logiciel',
                    2 => 'Big Data & IA',
                    3 => 'Réseaux & Télécoms',
                    4 => 'Systèmes Embarqués',
                ]"
                value="{{ request('filiere_id') }}"
            />
            
            <x-select 
                name="niveau" 
                label="Niveau"
                :options="[
                    '' => 'Tous les niveaux',
                    'L1' => 'Licence 1',
                    'L2' => 'Licence 2',
                    'L3' => 'Licence 3',
                    'M1' => 'Master 1',
                    'M2' => 'Master 2',
                ]"
                value="{{ request('niveau') }}"
            />
            
            <div class="flex items-end gap-2">
                <x-button type="submit" variant="secondary" size="md" icon="search" class="flex-1">
                    Rechercher
                </x-button>
                <a href="{{ route('etudiants.index') }}" class="px-3 py-2 text-sm text-[#4c669a] hover: text-[#0d121b] dark:hover:text-white transition">
                    <span class="material-symbols-outlined">refresh</span>
                </a>
            </div>
        </div>
    </form>
</div>

{{-- Quick Actions --}}
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <span class="text-sm text-[#4c669a] dark: text-gray-400">
            <span class="font-bold text-[#135bec]">{{ $etudiants->total() ?? 1247 }}</span> étudiant(s)
        </span>
        <div class="h-4 w-px bg-[#e7ebf3] dark:bg-gray-700"></div>
        <x-select 
            name="per_page"
            : options="[
                '10' => '10 par page',
                '25' => '25 par page',
                '50' => '50 par page',
                '100' => '100 par page',
            ]"
            size="sm"
            class="w-32"
        />
    </div>
    
    <div class="flex items-center gap-2">
        <button class="px-3 py-2 text-sm font-medium text-[#4c669a] hover:text-[#135bec] border border-[#e7ebf3] dark:border-gray-700 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition flex items-center gap-1">
            <span class="material-symbols-outlined text-[18px]">download</span>
            Exporter
        </button>
        <button class="px-3 py-2 text-sm font-medium text-[#4c669a] hover:text-[#135bec] border border-[#e7ebf3] dark: border-gray-700 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition flex items-center gap-1">
            <span class="material-symbols-outlined text-[18px]">print</span>
            Imprimer
        </button>
    </div>
</div>

{{-- Table --}}
<x-card : padding="false">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-[#f8f9fc] dark:bg-gray-800/50 border-b border-[#e7ebf3] dark:border-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left w-12">
                        <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                    </th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Photo</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Matricule</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Nom & Prénom</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Filière</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Niveau</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Groupe</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Contact</th>
                    <th class="px-4 py-3 text-right font-semibold text-[#4c669a] dark:text-gray-400">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                @forelse($etudiants ?? [] as $etudiant)
                    <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition">
                        <td class="px-4 py-3">
                            <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                        </td>
                        <td class="px-4 py-3">
                            <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('{{ $etudiant->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($etudiant->nom_complet).'&background=135bec&color=fff' }}');"></div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-mono text-[#135bec] font-medium">{{ $etudiant->matricule }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-[#0d121b] dark:text-white">{{ $etudiant->nom_complet }}</p>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $etudiant->email }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-[#4c669a] dark:text-gray-400">{{ $etudiant->filiere->nom }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <x-badge variant="default">{{ $etudiant->niveau }}</x-badge>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-[#4c669a] dark:text-gray-400">{{ $etudiant->groupe ?? '-' }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-[#4c669a] dark:text-gray-400">{{ $etudiant->telephone ?? '-' }}</span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('etudiants.show', $etudiant) }}" class="p-1.5 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 text-[#135bec] transition" title="Voir">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </a>
                                <a href="{{ route('etudiants.edit', $etudiant) }}" class="p-1.5 rounded hover:bg-purple-50 dark:hover:bg-purple-900/20 text-purple-600 transition" title="Modifier">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <a href="{{ route('etudiants.notes', $etudiant) }}" class="p-1.5 rounded hover:bg-green-50 dark:hover:bg-green-900/20 text-green-600 transition" title="Notes">
                                    <span class="material-symbols-outlined text-[18px]">description</span>
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
                        ['matricule' => '2023-0001', 'nom' => 'ALAMI', 'prenom' => 'Ahmed', 'email' => 'ahmed.alami@etudiant.ma', 'filiere' => 'Génie Logiciel', 'niveau' => 'L3', 'groupe' => 'A', 'tel' => '+212 6 12 34 56 78'],
                        ['matricule' => '2023-0002', 'nom' => 'BENALI', 'prenom' => 'Fatima', 'email' => 'fatima.benali@etudiant.ma', 'filiere' => 'Génie Logiciel', 'niveau' => 'L3', 'groupe' => 'A', 'tel' => '+212 6 23 45 67 89'],
                        ['matricule' => '2023-0003', 'nom' => 'CHAKIR', 'prenom' => 'Mohamed', 'email' => 'mohamed.chakir@etudiant.ma', 'filiere' => 'Génie Logiciel', 'niveau' => 'L3', 'groupe' => 'B', 'tel' => '+212 6 34 56 78 90'],
                        ['matricule' => '2023-0004', 'nom' => 'IDRISSI', 'prenom' => 'Sara', 'email' => 'sara.idrissi@etudiant.ma', 'filiere' => 'Big Data & IA', 'niveau' => 'M1', 'groupe' => 'A', 'tel' => '+212 6 45 67 89 01'],
                        ['matricule' => '2023-0005', 'nom' => 'MANSOURI', 'prenom' => 'Karim', 'email' => 'karim.mansouri@etudiant.ma', 'filiere' => 'Réseaux & Télécoms', 'niveau' => 'L3', 'groupe' => 'A', 'tel' => '+212 6 56 78 90 12'],
                    ] as $sample)
                        <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition">
                            <td class="px-4 py-3">
                                <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                            </td>
                            <td class="px-4 py-3">
                                <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($sample['prenom'].' '.$sample['nom']) }}&background=135bec&color=fff');"></div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-mono text-[#135bec] font-medium">{{ $sample['matricule'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-medium text-[#0d121b] dark:text-white">{{ $sample['nom'] }} {{ $sample['prenom'] }}</p>
                                <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $sample['email'] }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-[#4c669a] dark:text-gray-400">{{ $sample['filiere'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <x-badge variant="default">{{ $sample['niveau'] }}</x-badge>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-[#4c669a] dark:text-gray-400">{{ $sample['groupe'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-[#4c669a] dark:text-gray-400">{{ $sample['tel'] }}</span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('etudiants.show', 1) }}" class="p-1.5 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 text-[#135bec] transition" title="Voir">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    </a>
                                    <a href="#" class="p-1.5 rounded hover:bg-purple-50 dark:hover:bg-purple-900/20 text-purple-600 transition" title="Modifier">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    <a href="#" class="p-1.5 rounded hover:bg-green-50 dark:hover:bg-green-900/20 text-green-600 transition" title="Notes">
                                        <span class="material-symbols-outlined text-[18px]">description</span>
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
                Affichage de 1 à 5 sur {{ $stats['total'] ?? 1247 }} résultats
            </span>
            <div class="flex items-center gap-2">
                {{-- Pagination here --}}
            </div>
        </div>
    </div>
</x-card>
@endsection