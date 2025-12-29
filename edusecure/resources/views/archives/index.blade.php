@extends('layouts.app')

@section('title', 'Archives')
@section('page-title', 'Archives')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Archives', 'url' => route('archives.index')],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="size-12 rounded-xl bg-gradient-to-br from-slate-500 to-slate-600 flex items-center justify-center text-white shadow-lg shadow-slate-500/20">
                    <span class="material-symbols-outlined text-2xl icon-filled">archive</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                        Archives
                    </h1>
                </div>
            </div>
            <p class="text-[#4c669a] dark:text-gray-400 text-lg leading-relaxed">
                Consultez les données archivées des années précédentes
            </p>
        </div>
    </div>
</div>

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat-card 
        title="Total Archives" 
        value="{{ $stats['total'] ??  156 }}" 
        icon="archive" 
        iconBg="slate"
        subtitle="Tous documents"
    />
    
    <x-stat-card 
        title="Feuilles de Notes" 
        value="{{ $stats['feuilles'] ?? 98 }}" 
        icon="description" 
        iconBg="blue"
        subtitle="Archivées"
    />
    
    <x-stat-card 
        title="Années Clôturées" 
        value="{{ $stats['annees'] ?? 3 }}" 
        icon="event" 
        iconBg="purple"
        subtitle="Disponibles"
    />
    
    <x-stat-card 
        title="Espace Utilisé" 
        value="{{ $stats['espace'] ?? '2.4' }}GB" 
        icon="storage" 
        iconBg="orange"
        subtitle="Stockage"
    />
</div>

{{-- Filters --}}
<div class="bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl p-5 shadow-sm mb-6">
    <form method="GET" action="{{ route('archives.recherche') }}">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <x-input 
                type="search"
                name="search"
                placeholder="Rechercher..."
                icon="search"
            />
            
            <x-select 
                name="annee" 
                label="Année Académique"
                :options="[
                    '' => 'Toutes',
                    '2023-2024' => '2023-2024',
                    '2022-2023' => '2022-2023',
                    '2021-2022' => '2021-2022',
                ]"
            />
            
            <x-select 
                name="type" 
                label="Type"
                :options="[
                    '' => 'Tous types',
                    'feuille_note' => 'Feuille de Notes',
                    'releve' => 'Relevé',
                    'pv' => 'PV',
                ]"
            />
            
            <div class="flex items-end">
                <x-button type="submit" variant="secondary" size="md" icon="search" class="w-full">
                    Rechercher
                </x-button>
            </div>
        </div>
    </form>
</div>

{{-- Archives List --}}
<div class="space-y-4">
    @foreach([
        ['annee' => '2023-2024', 'type' => 'Feuilles de Notes', 'count' => 45, 'size' => '890 MB', 'date' => '30/06/2024'],
        ['annee' => '2022-2023', 'type' => 'Feuilles de Notes', 'count' => 42, 'size' => '856 MB', 'date' => '30/06/2023'],
        ['annee' => '2021-2022', 'type' => 'Feuilles de Notes', 'count' => 38, 'size' => '780 MB', 'date' => '30/06/2022'],
    ] as $archive)
        <x-card : padding="false">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="size-14 rounded-xl bg-gradient-to-br from-slate-100 to-slate-50 dark:from-slate-900/30 dark:to-slate-900/10 flex items-center justify-center border border-slate-200 dark:border-slate-800 flex-shrink-0">
                            <span class="material-symbols-outlined text-slate-600 text-2xl">folder</span>
                        </div>
                        
                        <div class="flex-1">
                            <h3 class="text-xl font-black text-[#0d121b] dark: text-white mb-2">
                                {{ $archive['annee'] }} - {{ $archive['type'] }}
                            </h3>
                            
                            <div class="flex flex-wrap items-center gap-4 text-sm text-[#4c669a] dark: text-gray-400">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">description</span>
                                    {{ $archive['count'] }} documents
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">data_usage</span>
                                    {{ $archive['size'] }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                    Archivé le {{ $archive['date'] }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('archives.show', 1) }}" class="px-4 py-2 rounded-lg bg-[#135bec] text-white text-sm font-medium hover:bg-[#0f4bc4] transition">
                            Consulter
                        </a>
                        <button class="p-2 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition">
                            <span class="material-symbols-outlined text-[20px]">download</span>
                        </button>
                    </div>
                </div>
            </div>
        </x-card>
    @endforeach
</div>
@endsection