@extends('layouts.app')

@section('title', 'Gestion des Filières')
@section('page-title', 'Gestion des Filières')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Filières', 'url' => route('filieres.index')],
    ];
@endphp

{{-- Page Heading & Actions --}}
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
    <div class="max-w-2xl">
        <h1 class="text-3xl md:text-4xl font-black tracking-tight text-[#0d121b] dark:text-white mb-2">
            Gestion des Filières
        </h1>
        <p class="text-[#4c669a] dark:text-gray-400 text-lg leading-relaxed">
            Organisez les filières par département et niveau académique. 
        </p>
    </div>
    <div class="flex gap-3">
        <x-button variant="secondary" icon="upload_file" size="md">
            Importer CSV
        </x-button>
        <x-button variant="primary" icon="add" size="md" href="{{ route('filieres.create') }}">
            Nouvelle Filière
        </x-button>
    </div>
</div>

{{-- Tabs Navigation --}}
<div class="mb-6 border-b border-[#e7ebf3] dark:border-gray-800">
    <div class="flex gap-8">
        <a href="{{ route('modules.index') }}" class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
            <span class="material-symbols-outlined group-hover:text-[#135bec]">view_module</span>
            Modules
        </a>
        <a href="{{ route('filieres.index') }}" class="relative flex items-center gap-2 pb-4 text-sm font-bold text-[#135bec]">
            <span class="material-symbols-outlined">schema</span>
            Filières
            <span class="absolute bottom-0 left-0 h-0.5 w-full bg-[#135bec]"></span>
        </a>
        <a href="{{ route('departements.index') }}" class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
            <span class="material-symbols-outlined group-hover:text-[#135bec]">corporate_fare</span>
            Départements
        </a>
        <a href="{{ route('semestres.index') }}" class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
            <span class="material-symbols-outlined group-hover:text-[#135bec]">calendar_month</span>
            Semestres
        </a>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat-card 
        title="Total Filières" 
        value="8" 
        icon="schema" 
        iconBg="purple"
        subtitle="Actives"
    />
    <x-stat-card 
        title="Départements" 
        value="3" 
        icon="corporate_fare" 
        iconBg="blue"
        subtitle="Sciences, Lettres, Droit"
    />
    <x-stat-card 
        title="Modules Rattachés" 
        value="42" 
        icon="view_module" 
        iconBg="green"
        subtitle="Total"
    />
    <x-stat-card 
        title="Étudiants Inscrits" 
        value="1,250" 
        icon="groups" 
        iconBg="orange"
        subtitle="Tous niveaux"
    />
</div>

{{-- Filters --}}
<div class="bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl p-5 shadow-sm mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-select 
            name="departement_filter" 
            label="Filtrer par Département"
            :options="[
                '' => 'Tous les départements',
                1 => 'Informatique',
                2 => 'Mathématiques',
                3 => 'Physique',
            ]"
            placeholder="Tous les départements"
        />
        
        <x-select 
            name="niveau_filter" 
            label="Filtrer par Niveau"
            :options="[
                '' => 'Tous les niveaux',
                'L1' => 'Licence 1',
                'L2' => 'Licence 2',
                'L3' => 'Licence 3',
                'M1' => 'Master 1',
                'M2' => 'Master 2',
            ]"
            placeholder="Tous les niveaux"
        />
        
        <x-input 
            name="search" 
            label="Recherche" 
            icon="search"
            placeholder="Nom de filière..."
        />
    </div>
</div>

{{-- Filières Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($filieres ?? [] as $filiere)
        <x-card :padding="false">
            <div class="p-6 space-y-4">
                {{-- Header --}}
                <div class="flex items-start justify-between">
                    <div class="flex items-center gap-3">
                        <div class="size-12 rounded-lg bg-gradient-to-br from-[#135bec] to-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-blue-500/20">
                            {{ strtoupper(substr($filiere->code ??  'GL', 0, 2)) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-[#0d121b] dark:text-white">
                                {{ $filiere->nom ?? 'Génie Logiciel' }}
                            </h3>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">
                                {{ $filiere->departement->nom ?? 'Informatique' }}
                            </p>
                        </div>
                    </div>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="p-1.5 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 text-[#4c669a]">
                            <span class="material-symbols-outlined text-[20px]">more_vert</span>
                        </button>
                        <div x-show="open" @click. away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-[#1a2234] rounded-lg shadow-xl border border-[#e7ebf3] dark:border-gray-800 py-2 z-10" style="display: none;">
                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-[#0d121b] dark:text-white hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                Modifier
                            </a>
                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                Supprimer
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Info Badges --}}
                <div class="flex flex-wrap gap-2">
                    <x-badge variant="info">
                        {{ $filiere->niveau ??  'Licence 3' }}
                    </x-badge>
                    <x-badge variant="default">
                        {{ $filiere->modules_count ?? 12 }} modules
                    </x-badge>
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-[#e7ebf3] dark:border-gray-800">
                    <div>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase tracking-wider mb-1">Étudiants</p>
                        <p class="text-2xl font-bold text-[#0d121b] dark:text-white">
                            {{ $filiere->etudiants_count ?? 245 }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase tracking-wider mb-1">Chef Filière</p>
                        <div class="flex items-center gap-2">
                            <div class="size-6 rounded-full bg-cover bg-center" style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($filiere->chef->name ??  'Dr Martin') }}&background=135bec&color=fff');"></div>
                            <p class="text-xs font-medium text-[#0d121b] dark:text-white truncate">
                                {{ $filiere->chef->name ?? 'Dr.  Martin' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-3 bg-[#f8f9fc] dark:bg-gray-800/50 border-t border-[#e7ebf3] dark:border-gray-800 flex items-center justify-between">
                <x-badge variant="success" dot>Active</x-badge>
                <a href="{{ route('filieres.show', $filiere->id ?? 1) }}" class="text-sm font-medium text-[#135bec] hover:text-[#0f4bc4] flex items-center gap-1">
                    Voir détails
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        </x-card>
    @empty
        {{-- Sample Cards --}}
        @foreach([
            ['code' => 'GL', 'nom' => 'Génie Logiciel', 'dept' => 'Informatique', 'niveau' => 'Licence 3', 'modules' => 12, 'etudiants' => 245, 'chef' => 'Dr. Martin'],
            ['code' => 'BD', 'nom' => 'Big Data & IA', 'dept' => 'Informatique', 'niveau' => 'Master 1', 'modules' => 10, 'etudiants' => 85, 'chef' => 'Pr. Benali'],
            ['code' => 'RT', 'nom' => 'Réseaux & Télécoms', 'dept' => 'Informatique', 'niveau' => 'Licence 3', 'modules' => 11, 'etudiants' => 180, 'chef' => 'Dr. Amrani'],
            ['code' => 'MA', 'nom' => 'Mathématiques Appliquées', 'dept' => 'Mathématiques', 'niveau' => 'Licence 2', 'modules' => 15, 'etudiants' => 150, 'chef' => 'Pr. Dubois'],
            ['code' => 'PH', 'nom' => 'Physique Fondamentale', 'dept' => 'Physique', 'niveau' => 'Master 2', 'modules' => 8, 'etudiants' => 45, 'chef' => 'Dr. Einstein'],
            ['code' => 'CH', 'nom' => 'Chimie Organique', 'dept' => 'Chimie', 'niveau' => 'Licence 3', 'modules' => 14, 'etudiants' => 120, 'chef' => 'Pr. Lavoisier'],
        ] as $sample)
            <x-card :padding="false">
                <div class="p-6 space-y-4">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <div class="size-12 rounded-lg bg-gradient-to-br from-[#135bec] to-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-blue-500/20">
                                {{ $sample['code'] }}
                            </div>
                            <div>
                                <h3 class="font-bold text-[#0d121b] dark: text-white">{{ $sample['nom'] }}</h3>
                                <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $sample['dept'] }}</p>
                            </div>
                        </div>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="p-1.5 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 text-[#4c669a]">
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <x-badge variant="info">{{ $sample['niveau'] }}</x-badge>
                        <x-badge variant="default">{{ $sample['modules'] }} modules</x-badge>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-[#e7ebf3] dark:border-gray-800">
                        <div>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase tracking-wider mb-1">Étudiants</p>
                            <p class="text-2xl font-bold text-[#0d121b] dark:text-white">{{ $sample['etudiants'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase tracking-wider mb-1">Chef Filière</p>
                            <div class="flex items-center gap-2">
                                <div class="size-6 rounded-full bg-cover bg-center" style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($sample['chef']) }}&background=135bec&color=fff');"></div>
                                <p class="text-xs font-medium text-[#0d121b] dark:text-white truncate">{{ $sample['chef'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-3 bg-[#f8f9fc] dark:bg-gray-800/50 border-t border-[#e7ebf3] dark:border-gray-800 flex items-center justify-between">
                    <x-badge variant="success" dot>Active</x-badge>
                    <a href="#" class="text-sm font-medium text-[#135bec] hover:text-[#0f4bc4] flex items-center gap-1">
                        Voir détails
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </x-card>
        @endforeach
    @endforelse
</div>
@endsection