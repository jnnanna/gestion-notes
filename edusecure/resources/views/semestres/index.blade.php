@extends('layouts.app')

@section('title', 'Gestion des Semestres')
@section('page-title', 'Gestion des Semestres')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Semestres', 'url' => route('semestres.index')],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="size-12 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center text-white shadow-lg shadow-cyan-500/20">
                    <span class="material-symbols-outlined text-2xl icon-filled">calendar_view_month</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                        Gestion des Semestres
                    </h1>
                </div>
            </div>
            <p class="text-[#4c669a] dark:text-gray-400 text-lg leading-relaxed">
                Configurez les semestres académiques et leurs périodes
            </p>
        </div>
        <div class="flex gap-3">
            <x-button variant="primary" icon="add" size="md" x-data @click="$dispatch('open-modal', 'create-semestre')">
                Nouveau Semestre
            </x-button>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat-card 
        title="Total Semestres" 
        value="{{ $stats['total'] ?? 12 }}" 
        icon="calendar_month" 
        iconBg="cyan"
        subtitle="Tous niveaux"
    />
    
    <x-stat-card 
        title="Semestre Actif" 
        value="{{ $stats['actif'] ?? 'S5' }}" 
        icon="play_circle" 
        iconBg="green"
        subtitle="En cours"
    />
    
    <x-stat-card 
        title="Modules" 
        value="{{ $stats['modules'] ?? 48 }}" 
        icon="book" 
        iconBg="blue"
        subtitle="Total modules"
    />
    
    <x-stat-card 
        title="Étudiants" 
        value="{{ $stats['etudiants'] ?? 1247 }}" 
        icon="groups" 
        iconBg="purple"
        subtitle="Inscrits"
    />
</div>

{{-- Semestres Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($semestres ?? [] as $semestre)
        <x-card :padding="false">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="size-12 rounded-xl bg-gradient-to-br from-cyan-100 to-cyan-50 dark:from-cyan-900/30 dark:to-cyan-900/10 flex items-center justify-center border border-cyan-200 dark:border-cyan-800">
                            <span class="material-symbols-outlined text-cyan-600 text-2xl">calendar_month</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-[#0d121b] dark:text-white">
                                {{ $semestre->nom }}
                            </h3>
                            <p class="text-sm text-[#4c669a] dark:text-gray-400">{{ $semestre->code }}</p>
                        </div>
                    </div>
                    @if($semestre->actif)
                        <x-badge variant="success" dot>Actif</x-badge>
                    @endif
                </div>

                <div class="space-y-3 mb-4">
                    <div class="flex items-center gap-2 text-sm">
                        <span class="material-symbols-outlined text-[#4c669a] text-[18px]">calendar_today</span>
                        <span class="text-[#4c669a] dark:text-gray-400">
                            {{ $semestre->date_debut?->format('d/m/Y') }} - {{ $semestre->date_fin?->format('d/m/Y') }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="material-symbols-outlined text-[#4c669a] text-[18px]">schedule</span>
                        <span class="text-[#4c669a] dark:text-gray-400">
                            {{ $semestre->duree_semaines }} semaines
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="material-symbols-outlined text-[#4c669a] text-[18px]">book</span>
                        <span class="font-medium text-[#0d121b] dark:text-white">
                            {{ $semestre->modules_count ?? 0 }} modules
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-4 border-t border-[#e7ebf3] dark:border-gray-800">
                    <button class="flex-1 py-2 text-sm font-medium text-[#135bec] hover:bg-blue-50 dark:hover:bg-blue-900/10 rounded-lg transition">
                        Voir les modules
                    </button>
                    <div class="relative" x-data="{ open: false }">
                        <button 
                            @click="open = !open"
                            class="p-2 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 text-[#4c669a] transition"
                        >
                            <span class="material-symbols-outlined text-[20px]">more_vert</span>
                        </button>
                        <div 
                            x-show="open" 
                            @click.away="open = false"
                            x-transition
                            class="absolute right-0 bottom-full mb-2 w-48 bg-white dark:bg-[#1a2234] rounded-lg shadow-xl border border-[#e7ebf3] dark:border-gray-800 py-2 z-10"
                            style="display: none;"
                        >
                            <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                Modifier
                            </button>
                            @if(!$semestre->actif)
                                <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-green-600 hover:bg-green-50 dark:hover:bg-green-900/10">
                                    <span class="material-symbols-outlined text-[18px]">play_circle</span>
                                    Activer
                                </button>
                            @endif
                            <hr class="my-2 border-[#e7ebf3] dark:border-gray-700">
                            <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>
    @empty
        {{-- Sample Data --}}
        @foreach([
            ['nom' => 'Semestre 1', 'code' => 'S1', 'debut' => '01/09/2024', 'fin' => '31/01/2025', 'semaines' => 20, 'modules' => 6, 'actif' => false],
            ['nom' => 'Semestre 2', 'code' => 'S2', 'debut' => '01/02/2025', 'fin' => '30/06/2025', 'semaines' => 20, 'modules' => 6, 'actif' => false],
            ['nom' => 'Semestre 3', 'code' => 'S3', 'debut' => '01/09/2024', 'fin' => '31/01/2025', 'semaines' => 20, 'modules' => 7, 'actif' => false],
            ['nom' => 'Semestre 4', 'code' => 'S4', 'debut' => '01/02/2025', 'fin' => '30/06/2025', 'semaines' => 20, 'modules' => 7, 'actif' => false],
            ['nom' => 'Semestre 5', 'code' => 'S5', 'debut' => '01/09/2024', 'fin' => '31/01/2025', 'semaines' => 20, 'modules' => 8, 'actif' => true],
            ['nom' => 'Semestre 6', 'code' => 'S6', 'debut' => '01/02/2025', 'fin' => '30/06/2025', 'semaines' => 20, 'modules' => 8, 'actif' => false],
        ] as $sample)
            <x-card :padding="false">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="size-12 rounded-xl bg-gradient-to-br from-cyan-100 to-cyan-50 dark:from-cyan-900/30 dark:to-cyan-900/10 flex items-center justify-center border border-cyan-200 dark:border-cyan-800">
                                <span class="material-symbols-outlined text-cyan-600 text-2xl">calendar_month</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-[#0d121b] dark:text-white">{{ $sample['nom'] }}</h3>
                                <p class="text-sm text-[#4c669a] dark:text-gray-400">{{ $sample['code'] }}</p>
                            </div>
                        </div>
                        @if($sample['actif'])
                            <x-badge variant="success" dot>Actif</x-badge>
                        @endif
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined text-[#4c669a] text-[18px]">calendar_today</span>
                            <span class="text-[#4c669a] dark:text-gray-400">{{ $sample['debut'] }} - {{ $sample['fin'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined text-[#4c669a] text-[18px]">schedule</span>
                            <span class="text-[#4c669a] dark:text-gray-400">{{ $sample['semaines'] }} semaines</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined text-[#4c669a] text-[18px]">book</span>
                            <span class="font-medium text-[#0d121b] dark:text-white">{{ $sample['modules'] }} modules</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-4 border-t border-[#e7ebf3] dark:border-gray-800">
                        <button class="flex-1 py-2 text-sm font-medium text-[#135bec] hover:bg-blue-50 dark:hover:bg-blue-900/10 rounded-lg transition">
                            Voir les modules
                        </button>
                        <div class="relative" x-data="{ open: false }">
                            <button 
                                @click="open = !open"
                                class="p-2 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 text-[#4c669a] transition"
                            >
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                            <div 
                                x-show="open" 
                                @click.away="open = false"
                                x-transition
                                class="absolute right-0 bottom-full mb-2 w-48 bg-white dark:bg-[#1a2234] rounded-lg shadow-xl border border-[#e7ebf3] dark:border-gray-800 py-2 z-10"
                                style="display: none;"
                            >
                                <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                    Modifier
                                </button>
                                @if(!$sample['actif'])
                                    <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-green-600 hover:bg-green-50 dark:hover:bg-green-900/10">
                                        <span class="material-symbols-outlined text-[18px]">play_circle</span>
                                        Activer
                                    </button>
                                @endif
                                <hr class="my-2 border-[#e7ebf3] dark:border-gray-700">
                                <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                    Supprimer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        @endforeach
    @endforelse
</div>

{{-- Create Modal (placeholder) --}}
<div x-data="{ open: false }" @open-modal.window="open = ($event.detail === 'create-semestre')" x-show="open" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black/50" @click="open = false"></div>
        <div class="relative bg-white dark:bg-[#1a2234] rounded-xl shadow-2xl max-w-2xl w-full p-6">
            <h3 class="text-xl font-bold text-[#0d121b] dark:text-white mb-4">Nouveau Semestre</h3>
            <p class="text-[#4c669a]">Formulaire de création à implémenter... </p>
            <div class="flex justify-end gap-3 mt-6">
                <button @click="open = false" class="px-4 py-2 text-sm font-medium text-[#4c669a]">Annuler</button>
                <x-button variant="primary" size="sm">Créer</x-button>
            </div>
        </div>
    </div>
</div>
@endsection