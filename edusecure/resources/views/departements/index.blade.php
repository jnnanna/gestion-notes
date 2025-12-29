@extends('layouts.app')

@section('title', 'Gestion des Départements')
@section('page-title', 'Gestion des Départements')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Départements', 'url' => route('departements. index')],
    ];
@endphp

{{-- Page Heading & Actions --}}
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
    <div class="max-w-2xl">
        <h1 class="text-3xl md:text-4xl font-black tracking-tight text-[#0d121b] dark:text-white mb-2">
            Gestion des Départements
        </h1>
        <p class="text-[#4c669a] dark: text-gray-400 text-lg leading-relaxed">
            Structure organisationnelle de l'établissement et responsables académiques. 
        </p>
    </div>
    <div class="flex gap-3">
        <x-button variant="primary" icon="add" size="md" href="{{ route('departements. create') }}">
            Nouveau Département
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
        <a href="{{ route('filieres.index') }}" class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
            <span class="material-symbols-outlined group-hover:text-[#135bec]">schema</span>
            Filières
        </a>
        <a href="{{ route('departements.index') }}" class="relative flex items-center gap-2 pb-4 text-sm font-bold text-[#135bec]">
            <span class="material-symbols-outlined">corporate_fare</span>
            Départements
            <span class="absolute bottom-0 left-0 h-0.5 w-full bg-[#135bec]"></span>
        </a>
        <a href="{{ route('semestres.index') }}" class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
            <span class="material-symbols-outlined group-hover: text-[#135bec]">calendar_month</span>
            Semestres
        </a>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat-card 
        title="Total Départements" 
        value="5" 
        icon="corporate_fare" 
        iconBg="blue"
        subtitle="Actifs"
    />
    <x-stat-card 
        title="Filières Totales" 
        value="24" 
        icon="schema" 
        iconBg="purple"
        subtitle="Réparties"
    />
    <x-stat-card 
        title="Enseignants" 
        value="180" 
        icon="person" 
        iconBg="green"
        subtitle="Tous départements"
    />
    <x-stat-card 
        title="Étudiants" 
        value="3,450" 
        icon="groups" 
        iconBg="orange"
        subtitle="Inscrits"
    />
</div>

{{-- Départements List --}}
<div class="space-y-6">
    @forelse($departements ??  [] as $departement)
        <x-card : padding="false">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    {{-- Left:  Department Info --}}
                    <div class="flex items-start gap-4 flex-1">
                        <div class="size-16 rounded-xl bg-gradient-to-br from-[#135bec] to-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/20 flex-shrink-0">
                            <span class="material-symbols-outlined text-3xl icon-filled">corporate_fare</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-xl font-bold text-[#0d121b] dark: text-white">
                                    {{ $departement->nom ??  'Département Informatique' }}
                                </h3>
                                <x-badge variant="success" dot>Actif</x-badge>
                            </div>
                            <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-3">
                                {{ $departement->description ?? 'Sciences du numérique et technologies de l\'information' }}
                            </p>
                            <div class="flex flex-wrap gap-4 text-sm">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px] text-[#4c669a]">schema</span>
                                    <span class="text-[#4c669a] dark:text-gray-400">
                                        <span class="font-bold text-[#0d121b] dark:text-white">{{ $departement->filieres_count ??  8 }}</span> filières
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px] text-[#4c669a]">person</span>
                                    <span class="text-[#4c669a] dark:text-gray-400">
                                        <span class="font-bold text-[#0d121b] dark:text-white">{{ $departement->enseignants_count ?? 45 }}</span> enseignants
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px] text-[#4c669a]">groups</span>
                                    <span class="text-[#4c669a] dark:text-gray-400">
                                        <span class="font-bold text-[#0d121b] dark:text-white">{{ $departement->etudiants_count ?? 1250 }}</span> étudiants
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Chef & Actions --}}
                    <div class="flex flex-col items-end gap-4 flex-shrink-0">
                        {{-- Chef de Département --}}
                        <div class="bg-[#f8f9fc] dark:bg-gray-800/50 rounded-lg p-3 border border-[#e7ebf3] dark:border-gray-700">
                            <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase tracking-wider mb-2">Chef de Département</p>
                            <div class="flex items-center gap-3">
                                <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($departement->chef->name ??  'Pr Benali') }}&background=135bec&color=fff');"></div>
                                <div>
                                    <p class="font-bold text-[#0d121b] dark:text-white">{{ $departement->chef->name ?? 'Pr.  Ahmed Benali' }}</p>
                                    <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $departement->chef->email ?? 'a.benali@university.edu' }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-2">
                            <a href="{{ route('departements.show', $departement->id ??  1) }}" class="px-4 py-2 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-sm font-medium text-[#0d121b] dark:text-white hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition-colors flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                Voir détails
                            </a>
                            <a href="{{ route('departements.edit', $departement->id ?? 1) }}" class="px-4 py-2 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-sm font-medium text-[#0d121b] dark:text-white hover:bg-[#f8f9fc] dark:hover: bg-gray-800 transition-colors flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                Modifier
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>
    @empty
        {{-- Sample Data --}}
        @foreach([
            ['nom' => 'Département Informatique', 'desc' => 'Sciences du numérique et technologies de l\'information', 'filieres' => 8, 'enseignants' => 45, 'etudiants' => 1250, 'chef' => 'Pr. Ahmed Benali', 'email' => 'a.benali@university.edu'],
            ['nom' => 'Département Mathématiques', 'desc' => 'Mathématiques pures et appliquées', 'filieres' => 5, 'enseignants' => 32, 'etudiants' => 680, 'chef' => 'Pr. Marie Dubois', 'email' => 'm.dubois@university.edu'],
            ['nom' => 'Département Physique', 'desc' => 'Physique fondamentale et sciences de la matière', 'filieres' => 4, 'enseignants' => 28, 'etudiants' => 520, 'chef' => 'Dr. Albert Einstein', 'email' => 'a.einstein@university.edu'],
            ['nom' => 'Département Chimie', 'desc' => 'Chimie organique, inorganique et analytique', 'filieres' => 3, 'enseignants' => 25, 'etudiants' => 450, 'chef' => 'Pr. Antoine Lavoisier', 'email' => 'a.lavoisier@university.edu'],
            ['nom' => 'Département Biologie', 'desc' => 'Sciences de la vie et biotechnologies', 'filieres' => 4, 'enseignants' => 30, 'etudiants' => 550, 'chef' => 'Dr. Charles Darwin', 'email' => 'c.darwin@university.edu'],
        ] as $dept)
            <x-card :padding="false">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="size-16 rounded-xl bg-gradient-to-br from-[#135bec] to-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/20 flex-shrink-0">
                                <span class="material-symbols-outlined text-3xl icon-filled">corporate_fare</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-xl font-bold text-[#0d121b] dark: text-white">{{ $dept['nom'] }}</h3>
                                    <x-badge variant="success" dot>Actif</x-badge>
                                </div>
                                <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-3">{{ $dept['desc'] }}</p>
                                <div class="flex flex-wrap gap-4 text-sm">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px] text-[#4c669a]">schema</span>
                                        <span class="text-[#4c669a] dark:text-gray-400">
                                            <span class="font-bold text-[#0d121b] dark:text-white">{{ $dept['filieres'] }}</span> filières
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px] text-[#4c669a]">person</span>
                                        <span class="text-[#4c669a] dark:text-gray-400">
                                            <span class="font-bold text-[#0d121b] dark:text-white">{{ $dept['enseignants'] }}</span> enseignants
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px] text-[#4c669a]">groups</span>
                                        <span class="text-[#4c669a] dark:text-gray-400">
                                            <span class="font-bold text-[#0d121b] dark:text-white">{{ $dept['etudiants'] }}</span> étudiants
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-end gap-4 flex-shrink-0">
                            <div class="bg-[#f8f9fc] dark:bg-gray-800/50 rounded-lg p-3 border border-[#e7ebf3] dark:border-gray-700">
                                <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase tracking-wider mb-2">Chef de Département</p>
                                <div class="flex items-center gap-3">
                                    <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($dept['chef']) }}&background=135bec&color=fff');"></div>
                                    <div>
                                        <p class="font-bold text-[#0d121b] dark:text-white">{{ $dept['chef'] }}</p>
                                        <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $dept['email'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="#" class="px-4 py-2 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-sm font-medium text-[#0d121b] dark:text-white hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    Voir détails
                                </a>
                                <a href="#" class="px-4 py-2 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-sm font-medium text-[#0d121b] dark:text-white hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                    Modifier
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        @endforeach
    @endforelse
</div>
@endsection