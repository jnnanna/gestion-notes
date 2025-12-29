@extends('layouts.app')

@section('title', 'Historique des Exports')
@section('page-title', 'Historique des Exports')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Exportation', 'url' => route('exportation.index')],
        ['label' => 'Historique', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="size-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/20">
                    <span class="material-symbols-outlined text-2xl icon-filled">history</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                        Historique des Exports
                    </h1>
                </div>
            </div>
            <p class="text-[#4c669a] dark:text-gray-400 text-lg leading-relaxed">
                Retrouvez et téléchargez vos exports précédents
            </p>
        </div>
        <div class="flex gap-3">
            <form action="{{ route('exportation.nettoyer-expires') }}" method="POST" class="inline">
                @csrf
                <x-button type="submit" variant="secondary" icon="delete_sweep" size="md">
                    Nettoyer les exports expirés
                </x-button>
            </form>
            <a href="{{ route('exportation.index') }}">
                <x-button variant="primary" icon="add" size="md">
                    Nouvel Export
                </x-button>
            </a>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat-card 
        title="Total Exports" 
        value="{{ $stats['total'] ?? 48 }}" 
        icon="file_download" 
        iconBg="indigo"
        subtitle="Tous les fichiers"
    />
    
    <x-stat-card 
        title="Disponibles" 
        value="{{ $stats['disponibles'] ?? 42 }}" 
        icon="check_circle" 
        iconBg="green"
        subtitle="Non expirés"
    />
    
    <x-stat-card 
        title="Expirés" 
        value="{{ $stats['expires'] ?? 6 }}" 
        icon="schedule" 
        iconBg="orange"
        subtitle="À nettoyer"
    />
    
    <x-stat-card 
        title="Espace utilisé" 
        value="{{ $stats['espace'] ?? '285' }}MB" 
        icon="storage" 
        iconBg="purple"
        subtitle="Sur 1GB"
    />
</div>

{{-- Filters Bar --}}
<div class="bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl p-5 shadow-sm mb-6">
    <form method="GET" action="{{ route('exportation.historique') }}">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <x-select 
                name="type_filter" 
                label="Type de document"
                :options="[
                    '' => 'Tous les types',
                    'releve' => 'Relevé de Notes',
                    'pv' => 'Procès-Verbal',
                    'bulletin' => 'Bulletin',
                    'liste' => 'Liste Étudiants',
                    'donnees_brutes' => 'Données Brutes',
                ]"
            />
            
            <x-select 
                name="format_filter" 
                label="Format"
                :options="[
                    '' => 'Tous les formats',
                    'pdf' => 'PDF',
                    'excel' => 'Excel',
                    'csv' => 'CSV',
                ]"
            />
            
            <x-select 
                name="statut_filter" 
                label="Statut"
                :options="[
                    '' => 'Tous',
                    'disponible' => 'Disponible',
                    'expire' => 'Expiré',
                ]"
            />
            
            <x-input 
                type="date"
                name="date_filter"
                label="Date de génération"
                icon="calendar_today"
            />
        </div>
        
        <div class="flex items-center justify-end gap-3 mt-4">
            <button type="reset" class="text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                Réinitialiser
            </button>
            <x-button type="submit" variant="secondary" size="sm" icon="search">
                Rechercher
            </x-button>
        </div>
    </form>
</div>

{{-- Exports List --}}
<div class="space-y-4">
    @forelse($exports ?? [] as $export)
        <x-card :padding="false">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    {{-- Left: Info --}}
                    <div class="flex items-start gap-4 flex-1">
                        {{-- Icon --}}
                        <div class="size-14 rounded-xl bg-gradient-to-br from-{{ $export->format->value === 'pdf' ? 'red' : ($export->format->value === 'excel' ? 'green' : 'blue') }}-100 to-{{ $export->format->value === 'pdf' ? 'red' : ($export->format->value === 'excel' ? 'green' : 'blue') }}-50 dark:from-{{ $export->format->value === 'pdf' ? 'red' : ($export->format->value === 'excel' ? 'green' : 'blue') }}-900/30 dark:to-{{ $export->format->value === 'pdf' ? 'red' : ($export->format->value === 'excel' ? 'green' : 'blue') }}-900/10 flex items-center justify-center flex-shrink-0 border border-{{ $export->format->value === 'pdf' ? 'red' : ($export->format->value === 'excel' ? 'green' : 'blue') }}-200 dark:border-{{ $export->format->value === 'pdf' ? 'red' : ($export->format->value === 'excel' ? 'green' : 'blue') }}-800">
                            <span class="material-symbols-outlined text-{{ $export->format->value === 'pdf' ? 'red' : ($export->format->value === 'excel' ? 'green' : 'blue') }}-600 text-2xl">
                                {{ $export->format->value === 'pdf' ? 'picture_as_pdf' : ($export->format->value === 'excel' ? 'table_chart' : 'text_snippet') }}
                            </span>
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg font-bold text-[#0d121b] dark:text-white truncate">
                                    {{ $export->nom_fichier }}
                                </h3>
                                <x-badge :variant="$export->est_expire ? 'danger' : 'success'">
                                    {{ $export->est_expire ? 'Expiré' : 'Disponible' }}
                                </x-badge>
                            </div>
                            
                            <div class="flex flex-wrap items-center gap-4 text-sm text-[#4c669a] dark:text-gray-400 mb-3">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">description</span>
                                    {{ $export->type_document->label() }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">data_usage</span>
                                    {{ $export->taille_humaine }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                    {{ $export->created_at->format('d/m/Y à H:i') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">download</span>
                                    {{ $export->nb_telechargements }} téléchargement(s)
                                </span>
                                @if(! $export->est_expire)
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">schedule</span>
                                        Expire {{ $export->expire_at->diffForHumans() }}
                                    </span>
                                @endif
                            </div>
                            
                            {{-- Parameters --}}
                            @if($export->parametres)
                                <div class="flex flex-wrap gap-2">
                                    @foreach($export->parametres as $key => $value)
                                        <span class="px-2 py-1 bg-[#f8f9fc] dark:bg-gray-800 rounded text-xs text-[#4c669a] dark:text-gray-400">
                                            {{ ucfirst($key) }}: <span class="font-medium text-[#0d121b] dark:text-white">{{ $value }}</span>
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Right: Actions --}}
                    <div class="flex items-center gap-2 flex-shrink-0">
                        @if(! $export->est_expire)
                            <a href="{{ route('exportation.telecharger', $export) }}" class="px-4 py-2 rounded-lg bg-[#135bec] text-white text-sm font-medium hover:bg-[#0f4bc4] transition flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">download</span>
                                Télécharger
                            </a>
                        @else
                            <span class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-sm font-medium cursor-not-allowed">
                                Expiré
                            </span>
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
                                <a href="{{ route('exportation.apercu') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 text-sm text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    Aperçu
                                </a>
                                <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                                    <span class="material-symbols-outlined text-[18px]">content_copy</span>
                                    Dupliquer
                                </button>
                                <hr class="my-2 border-[#e7ebf3] dark:border-gray-700">
                                <form action="{{ route('exportation.destroy', $export) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>
    @empty
        {{-- Sample Data --}}
        @foreach([
            ['nom' => 'Releve_Notes_GL_S5_2024.pdf', 'type' => 'Relevé de Notes', 'format' => 'pdf', 'taille' => '2.3 MB', 'downloads' => 5, 'date' => '15/12/2024 14:30', 'expire' => false, 'expire_at' => 'dans 28 jours', 'params' => ['Filière' => 'Génie Logiciel', 'Semestre' => 'S5']],
            ['nom' => 'PV_Deliberation_BD_2024.pdf', 'type' => 'Procès-Verbal', 'format' => 'pdf', 'taille' => '1.8 MB', 'downloads' => 12, 'date' => '14/12/2024 16:45', 'expire' => false, 'expire_at' => 'dans 27 jours', 'params' => ['Filière' => 'Big Data & IA', 'Session' => 'Janvier 2024']],
            ['nom' => 'Liste_Etudiants_RT_L3.xlsx', 'type' => 'Liste Étudiants', 'format' => 'excel', 'taille' => '456 KB', 'downloads' => 8, 'date' => '13/12/2024 10:20', 'expire' => false, 'expire_at' => 'dans 26 jours', 'params' => ['Filière' => 'Réseaux & Télécoms', 'Niveau' => 'L3']],
            ['nom' => 'Bulletin_ALAMI_Ahmed_S5.pdf', 'type' => 'Bulletin', 'format' => 'pdf', 'taille' => '180 KB', 'downloads' => 3, 'date' => '10/11/2024 09:15', 'expire' => true, 'expire_at' => 'il y a 5 jours', 'params' => ['Étudiant' => 'ALAMI Ahmed', 'Semestre' => 'S5']],
        ] as $sample)
            <x-card :padding="false">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="size-14 rounded-xl bg-gradient-to-br from-{{ $sample['format'] === 'pdf' ? 'red' : 'green' }}-100 to-{{ $sample['format'] === 'pdf' ? 'red' : 'green' }}-50 dark:from-{{ $sample['format'] === 'pdf' ? 'red' : 'green' }}-900/30 dark:to-{{ $sample['format'] === 'pdf' ? 'red' : 'green' }}-900/10 flex items-center justify-center flex-shrink-0 border border-{{ $sample['format'] === 'pdf' ? 'red' : 'green' }}-200 dark:border-{{ $sample['format'] === 'pdf' ? 'red' : 'green' }}-800">
                                <span class="material-symbols-outlined text-{{ $sample['format'] === 'pdf' ? 'red' : 'green' }}-600 text-2xl">
                                    {{ $sample['format'] === 'pdf' ? 'picture_as_pdf' : 'table_chart' }}
                                </span>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white truncate">{{ $sample['nom'] }}</h3>
                                    <x-badge :variant="$sample['expire'] ? 'danger' : 'success'">
                                        {{ $sample['expire'] ? 'Expiré' : 'Disponible' }}
                                    </x-badge>
                                </div>
                                
                                <div class="flex flex-wrap items-center gap-4 text-sm text-[#4c669a] dark:text-gray-400 mb-3">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">description</span>
                                        {{ $sample['type'] }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">data_usage</span>
                                        {{ $sample['taille'] }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                        {{ $sample['date'] }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">download</span>
                                        {{ $sample['downloads'] }} téléchargement(s)
                                    </span>
                                    @if(!$sample['expire'])
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">schedule</span>
                                            Expire {{ $sample['expire_at'] }}
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex flex-wrap gap-2">
                                    @foreach($sample['params'] as $key => $value)
                                        <span class="px-2 py-1 bg-[#f8f9fc] dark:bg-gray-800 rounded text-xs text-[#4c669a] dark:text-gray-400">
                                            {{ $key }}: <span class="font-medium text-[#0d121b] dark:text-white">{{ $value }}</span>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if(!$sample['expire'])
                                <a href="#" class="px-4 py-2 rounded-lg bg-[#135bec] text-white text-sm font-medium hover:bg-[#0f4bc4] transition flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">download</span>
                                    Télécharger
                                </a>
                            @else
                                <span class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-sm font-medium cursor-not-allowed">
                                    Expiré
                                </span>
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
                                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        Aperçu
                                    </a>
                                    <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                                        <span class="material-symbols-outlined text-[18px]">content_copy</span>
                                        Dupliquer
                                    </button>
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

{{-- Pagination --}}
@if(isset($exports) && $exports->hasPages())
    <div class="mt-8">
        {{ $exports->links() }}
    </div>
@endif

{{-- Empty State --}}
@if(count($exports ?? []) === 0 && request()->has('type_filter'))
    <div class="text-center py-16">
        <div class="size-20 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mx-auto mb-4">
            <span class="material-symbols-outlined text-4xl text-[#4c669a]">folder_open</span>
        </div>
        <h3 class="text-xl font-bold text-[#0d121b] dark:text-white mb-2">Aucun export trouvé</h3>
        <p class="text-[#4c669a] dark:text-gray-400 mb-4">
            Aucun export ne correspond à vos critères de recherche. 
        </p>
        <a href="{{ route('exportation.historique') }}" class="inline-flex items-center gap-2 text-sm font-medium text-[#135bec] hover:text-[#0f4bc4]">
            <span class="material-symbols-outlined text-[18px]">refresh</span>
            Réinitialiser les filtres
        </a>
    </div>
@endif
@endsection