@extends('layouts.app')

@section('title', 'Années Académiques')
@section('page-title', 'Années Académiques')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Années Académiques', 'url' => route('annees-academiques.index')],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="size-12 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-white shadow-lg shadow-amber-500/20">
                    <span class="material-symbols-outlined text-2xl icon-filled">event</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                        Années Académiques
                    </h1>
                </div>
            </div>
            <p class="text-[#4c669a] dark:text-gray-400 text-lg leading-relaxed">
                Gérez les années scolaires et leurs périodes
            </p>
        </div>
        <div class="flex gap-3">
            <x-button variant="primary" icon="add" size="md">
                Nouvelle Année
            </x-button>
        </div>
    </div>
</div>

{{-- Current Year Banner --}}
<div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl p-6 text-white mb-8">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="size-16 rounded-xl bg-white/20 flex items-center justify-center">
                <span class="material-symbols-outlined text-4xl">event_available</span>
            </div>
            <div>
                <p class="text-amber-100 text-sm mb-1">Année en cours</p>
                <h2 class="text-3xl font-black">2024-2025</h2>
                <p class="text-amber-100 text-sm mt-1">01/09/2024 - 30/06/2025</p>
            </div>
        </div>
        <div class="text-right">
            <p class="text-amber-100 text-sm mb-1">Progression</p>
            <p class="text-4xl font-black">45%</p>
            <div class="w-32 h-2 bg-white/20 rounded-full mt-2">
                <div class="h-full bg-white rounded-full" style="width: 45%"></div>
            </div>
        </div>
    </div>
</div>

{{-- Years List --}}
<div class="space-y-4">
    @forelse($anneesAcademiques ?? [] as $annee)
        <x-card :padding="false">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="size-14 rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 dark:from-amber-900/30 dark:to-amber-900/10 flex items-center justify-center border border-amber-200 dark:border-amber-800 flex-shrink-0">
                            <span class="material-symbols-outlined text-amber-600 text-2xl">event</span>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-2xl font-black text-[#0d121b] dark:text-white">
                                    {{ $annee->annee }}
                                </h3>
                                @if($annee->active)
                                    <x-badge variant="success" dot>Active</x-badge>
                                @endif
                                @if($annee->cloturee)
                                    <x-badge variant="default">Clôturée</x-badge>
                                @endif
                            </div>
                            
                            <div class="flex flex-wrap items-center gap-4 text-sm text-[#4c669a] dark:text-gray-400">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                    {{ $annee->date_debut?->format('d/m/Y') }} - {{ $annee->date_fin?->format('d/m/Y') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">groups</span>
                                    {{ $annee->etudiants_count ?? 0 }} étudiants
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">description</span>
                                    {{ $annee->feuilles_notes_count ?? 0 }} feuilles de notes
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0">
                        @if(!$annee->cloturee)
                            <button class="px-4 py-2 rounded-lg bg-[#135bec] text-white text-sm font-medium hover:bg-[#0f4bc4] transition flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                Voir
                            </button>
                        @endif
                        
                        <div class="relative" x-data="{ open: false }">
                            <button 
                                @click="open = !open"
                                class="p-2 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition"
                            >
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                            <div 
                                x-show="open" 
                                @click.away="open = false"
                                x-transition
                                class="absolute right-0 mt-2 w-48 bg-white dark:bg-[#1a2234] rounded-lg shadow-xl border border-[#e7ebf3] dark:border-gray-800 py-2 z-10"
                                style="display: none;"
                            >
                                <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                    Modifier
                                </button>
                                @if(!$annee->active && !$annee->cloturee)
                                    <form action="{{ route('annees-academiques.activer', $annee) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-green-600 hover:bg-green-50 dark:hover:bg-green-900/10">
                                            <span class="material-symbols-outlined text-[18px]">play_circle</span>
                                            Activer
                                        </button>
                                    </form>
                                @endif
                                @if($annee->active && !$annee->cloturee)
                                    <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-orange-600 hover:bg-orange-50 dark:hover:bg-orange-900/10">
                                        <span class="material-symbols-outlined text-[18px]">lock</span>
                                        Clôturer
                                    </button>
                                @endif
                                @if($annee->cloturee)
                                    <a href="{{ route('archives.index', ['annee' => $annee->id]) }}" class="flex items-center gap-2 px-4 py-2 text-sm text-purple-600 hover:bg-purple-50 dark:hover:bg-purple-900/10">
                                        <span class="material-symbols-outlined text-[18px]">archive</span>
                                        Voir archives
                                    </a>
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
            </div>
        </x-card>
    @empty
        {{-- Sample Data --}}
        @foreach([
            ['annee' => '2024-2025', 'debut' => '01/09/2024', 'fin' => '30/06/2025', 'etudiants' => 1247, 'feuilles' => 156, 'active' => true, 'cloturee' => false],
            ['annee' => '2023-2024', 'debut' => '01/09/2023', 'fin' => '30/06/2024', 'etudiants' => 1198, 'feuilles' => 142, 'active' => false, 'cloturee' => true],
            ['annee' => '2022-2023', 'debut' => '01/09/2022', 'fin' => '30/06/2023', 'etudiants' => 1156, 'feuilles' => 138, 'active' => false, 'cloturee' => true],
        ] as $sample)
            <x-card :padding="false">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="size-14 rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 dark:from-amber-900/30 dark:to-amber-900/10 flex items-center justify-center border border-amber-200 dark:border-amber-800 flex-shrink-0">
                                <span class="material-symbols-outlined text-amber-600 text-2xl">event</span>
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-2xl font-black text-[#0d121b] dark:text-white">{{ $sample['annee'] }}</h3>
                                    @if($sample['active'])
                                        <x-badge variant="success" dot>Active</x-badge>
                                    @endif
                                    @if($sample['cloturee'])
                                        <x-badge variant="default">Clôturée</x-badge>
                                    @endif
                                </div>
                                
                                <div class="flex flex-wrap items-center gap-4 text-sm text-[#4c669a] dark:text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                        {{ $sample['debut'] }} - {{ $sample['fin'] }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">groups</span>
                                        {{ $sample['etudiants'] }} étudiants
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">description</span>
                                        {{ $sample['feuilles'] }} feuilles de notes
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if(!$sample['cloturee'])
                                <button class="px-4 py-2 rounded-lg bg-[#135bec] text-white text-sm font-medium hover:bg-[#0f4bc4] transition flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    Voir
                                </button>
                            @endif
                            
                            <div class="relative" x-data="{ open: false }">
                                <button 
                                    @click="open = !open"
                                    class="p-2 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition"
                                >
                                    <span class="material-symbols-outlined text-[20px]">more_vert</span>
                                </button>
                                <div 
                                    x-show="open" 
                                    @click.away="open = false"
                                    x-transition
                                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-[#1a2234] rounded-lg shadow-xl border border-[#e7ebf3] dark:border-gray-800 py-2 z-10"
                                    style="display: none;"
                                >
                                    <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                        Modifier
                                    </button>
                                    @if($sample['cloturee'])
                                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-purple-600 hover:bg-purple-50 dark:hover:bg-purple-900/10">
                                            <span class="material-symbols-outlined text-[18px]">archive</span>
                                            Voir archives
                                        </a>
                                    @else
                                        @if(!$sample['active'])
                                            <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-green-600 hover:bg-green-50 dark:hover:bg-green-900/10">
                                                <span class="material-symbols-outlined text-[18px]">play_circle</span>
                                                Activer
                                            </button>
                                        @else
                                            <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-orange-600 hover:bg-orange-50 dark:hover:bg-orange-900/10">
                                                <span class="material-symbols-outlined text-[18px]">lock</span>
                                                Clôturer
                                            </button>
                                        @endif
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
                </div>
            </x-card>
        @endforeach
    @endforelse
</div>
@endsection