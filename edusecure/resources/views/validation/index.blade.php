@extends('layouts.app')

@section('title', 'Validation des Notes')
@section('page-title', 'Validation des Notes')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Validation', 'url' => route('validation.index')],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="size-12 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <span class="material-symbols-outlined text-2xl icon-filled">task_alt</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                        Validation des Notes
                    </h1>
                </div>
            </div>
            <p class="text-[#4c669a] dark:text-gray-400 text-lg leading-relaxed">
                Validez ou rejetez les feuilles de notes soumises par les enseignants
            </p>
        </div>
        <div class="flex gap-3">
            <x-button variant="secondary" icon="filter_list" size="md">
                Filtres avancés
            </x-button>
            <x-button variant="primary" icon="done_all" size="md">
                Valider la sélection
            </x-button>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat-card 
        title="En attente" 
        value="{{ $stats['en_attente'] ??  12 }}" 
        icon="pending_actions" 
        iconBg="orange"
        subtitle="À traiter"
    />
    
    <x-stat-card 
        title="Validées aujourd'hui" 
        value="{{ $stats['validees_today'] ?? 8 }}" 
        icon="check_circle" 
        iconBg="green"
        trend="up"
        trendValue="+3"
        subtitle="Ce jour"
    />
    
    <x-stat-card 
        title="Rejetées" 
        value="{{ $stats['rejetees'] ?? 2 }}" 
        icon="cancel" 
        iconBg="red"
        subtitle="Erreurs détectées"
    />
    
    <x-stat-card 
        title="Temps moyen" 
        value="{{ $stats['temps_moyen'] ??  '3.5' }}min" 
        icon="schedule" 
        iconBg="blue"
        subtitle="Par validation"
    />
</div>

{{-- Filters Bar --}}
<div class="bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl p-5 shadow-sm mb-6">
    <form method="GET" action="{{ route('validation.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <x-select 
                name="filiere_filter" 
                label="Filière"
                :options="[
                    '' => 'Toutes les filières',
                    1 => 'Génie Logiciel',
                    2 => 'Big Data & IA',
                    3 => 'Réseaux & Télécoms',
                ]"
                placeholder="Toutes"
            />
            
            <x-select 
                name="module_filter" 
                label="Module"
                :options="[
                    '' => 'Tous les modules',
                    1 => 'Algorithmique',
                    2 => 'Bases de Données',
                    3 => 'Développement Web',
                ]"
                placeholder="Tous"
            />
            
            <x-select 
                name="enseignant_filter" 
                label="Enseignant"
                :options="[
                    '' => 'Tous les enseignants',
                    1 => 'Dr. Sarah Martin',
                    2 => 'Pr. Ahmed Benali',
                ]"
                placeholder="Tous"
            />
            
            <x-select 
                name="priorite_filter" 
                label="Priorité"
                :options="[
                    '' => 'Toutes',
                    'urgent' => 'Urgent',
                    'normale' => 'Normale',
                ]"
                placeholder="Toutes"
            />
        </div>
        
        <div class="flex items-center justify-end gap-3 mt-4">
            <button type="reset" class="text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                Réinitialiser
            </button>
            <x-button type="submit" variant="secondary" size="sm" icon="search">
                Appliquer les filtres
            </x-button>
        </div>
    </form>
</div>

{{-- Tabs --}}
<div class="mb-6 border-b border-[#e7ebf3] dark:border-gray-800">
    <div class="flex gap-8">
        <a href="{{ route('validation.index') }}" class="relative flex items-center gap-2 pb-4 text-sm font-bold text-[#135bec]">
            <span class="material-symbols-outlined">pending_actions</span>
            En attente
            <x-badge variant="warning">{{ $stats['en_attente'] ?? 12 }}</x-badge>
            <span class="absolute bottom-0 left-0 h-0.5 w-full bg-[#135bec]"></span>
        </a>
        <a href="{{ route('validation.index', ['tab' => 'validees']) }}" class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
            <span class="material-symbols-outlined group-hover:text-[#135bec]">check_circle</span>
            Validées
            <x-badge variant="default">{{ $stats['validees_total'] ?? 45 }}</x-badge>
        </a>
        <a href="{{ route('validation.index', ['tab' => 'rejetees']) }}" class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
            <span class="material-symbols-outlined group-hover:text-[#135bec]">cancel</span>
            Rejetées
            <x-badge variant="default">{{ $stats['rejetees'] ?? 2 }}</x-badge>
        </a>
        <a href="{{ route('validation.index', ['tab' => 'toutes']) }}" class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
            <span class="material-symbols-outlined group-hover:text-[#135bec]">list</span>
            Toutes
        </a>
    </div>
</div>

{{-- Feuilles List --}}
<div class="space-y-4">
    @forelse($feuillesEnAttente ?? [] as $feuille)
        <x-card :padding="false">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    {{-- Left:  Info --}}
                    <div class="flex items-start gap-4 flex-1">
                        <div class="size-14 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-900/10 flex items-center justify-center flex-shrink-0 border border-blue-200 dark:border-blue-800">
                            <span class="material-symbols-outlined text-[#135bec] text-2xl">description</span>
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">
                                    {{ $feuille->module->nom ??  'Algorithmique Avancée' }}
                                </h3>
                                <x-badge variant="info">{{ $feuille->code ?? 'FN-2024-001' }}</x-badge>
                                @if(($feuille->priorite ??  'normale') === 'urgent')
                                    <x-badge variant="danger" icon="priority_high">Urgent</x-badge>
                                @endif
                            </div>
                            
                            <div class="flex flex-wrap items-center gap-4 text-sm text-[#4c669a] dark: text-gray-400 mb-3">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">school</span>
                                    {{ $feuille->module->filiere->nom ?? 'Génie Logiciel - L3' }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">person</span>
                                    {{ $feuille->enseignant->name ?? 'Dr. Sarah Martin' }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                    {{ $feuille->date_examen?->format('d/m/Y') ?? '15/12/2024' }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">groups</span>
                                    {{ $feuille->notes_count ?? 35 }} étudiants
                                </span>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <x-badge variant="warning" dot>En attente</x-badge>
                                <span class="text-xs text-[#4c669a] dark:text-gray-400">
                                    Soumis {{ $feuille->soumis_at?->diffForHumans() ?? 'il y a 2h' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Stats & Actions --}}
                    <div class="flex flex-col items-end gap-4 flex-shrink-0">
                        {{-- Quick Stats --}}
                        <div class="grid grid-cols-3 gap-3">
                            <div class="text-center px-3 py-2 bg-green-50 dark:bg-green-900/10 rounded-lg border border-green-100 dark:border-green-900/20">
                                <p class="text-xs text-green-700 dark:text-green-400 mb-1">Moyenne</p>
                                <p class="text-lg font-bold text-green-600">{{ $feuille->moyenne ??  '13.45' }}</p>
                            </div>
                            <div class="text-center px-3 py-2 bg-blue-50 dark:bg-blue-900/10 rounded-lg border border-blue-100 dark: border-blue-900/20">
                                <p class="text-xs text-blue-700 dark:text-blue-400 mb-1">Réussite</p>
                                <p class="text-lg font-bold text-[#135bec]">{{ $feuille->taux_reussite ?? '91' }}%</p>
                            </div>
                            <div class="text-center px-3 py-2 bg-purple-50 dark:bg-purple-900/10 rounded-lg border border-purple-100 dark:border-purple-900/20">
                                <p class="text-xs text-purple-700 dark:text-purple-400 mb-1">Conf.</p>
                                <p class="text-lg font-bold text-purple-600">{{ $feuille->confiance_ocr ?? '96' }}%</p>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-2">
                            <a href="{{ route('validation.show', $feuille) }}" class="px-4 py-2 rounded-lg bg-[#135bec] text-white text-sm font-medium hover:bg-[#0f4bc4] transition flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                Examiner
                            </a>
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
                                    <form action="{{ route('validation.valider', $feuille) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-green-600 hover:bg-green-50 dark:hover:bg-green-900/10">
                                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                            Valider rapidement
                                        </button>
                                    </form>
                                    <form action="{{ route('validation.rejeter', $feuille) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10">
                                            <span class="material-symbols-outlined text-[18px]">cancel</span>
                                            Rejeter
                                        </button>
                                    </form>
                                    <hr class="my-2 border-[#e7ebf3] dark:border-gray-700">
                                    <a href="{{ route('feuilles-notes.historique', $feuille) }}" class="flex items-center gap-2 px-4 py-2 text-sm text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                                        <span class="material-symbols-outlined text-[18px]">history</span>
                                        Voir historique
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>
    @empty
        {{-- Sample Data --}}
        @foreach([
            ['module' => 'Algorithmique Avancée', 'code' => 'FN-2024-001', 'filiere' => 'Génie Logiciel - L3', 'enseignant' => 'Dr. Sarah Martin', 'date' => '15/12/2024', 'etudiants' => 35, 'moyenne' => '13.45', 'reussite' => 91, 'confiance' => 96, 'soumis' => 'il y a 2h', 'urgent' => false],
            ['module' => 'Bases de Données', 'code' => 'FN-2024-002', 'filiere' => 'Génie Logiciel - L3', 'enseignant' => 'Pr. Ahmed Benali', 'date' => '14/12/2024', 'etudiants' => 32, 'moyenne' => '12.80', 'reussite' => 87, 'confiance' => 94, 'soumis' => 'il y a 5h', 'urgent' => true],
            ['module' => 'Développement Web', 'code' => 'FN-2024-003', 'filiere' => 'Génie Logiciel - L3', 'enseignant' => 'Dr. Marie Dubois', 'date' => '13/12/2024', 'etudiants' => 38, 'moyenne' => '14.20', 'reussite' => 95, 'confiance' => 98, 'soumis' => 'hier', 'urgent' => false],
        ] as $sample)
            <x-card :padding="false">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="size-14 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-900/10 flex items-center justify-center flex-shrink-0 border border-blue-200 dark:border-blue-800">
                                <span class="material-symbols-outlined text-[#135bec] text-2xl">description</span>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">{{ $sample['module'] }}</h3>
                                    <x-badge variant="info">{{ $sample['code'] }}</x-badge>
                                    @if($sample['urgent'])
                                        <x-badge variant="danger" icon="priority_high">Urgent</x-badge>
                                    @endif
                                </div>
                                
                                <div class="flex flex-wrap items-center gap-4 text-sm text-[#4c669a] dark: text-gray-400 mb-3">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">school</span>
                                        {{ $sample['filiere'] }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">person</span>
                                        {{ $sample['enseignant'] }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                        {{ $sample['date'] }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">groups</span>
                                        {{ $sample['etudiants'] }} étudiants
                                    </span>
                                </div>
                                
                                <div class="flex items-center gap-2">
                                    <x-badge variant="warning" dot>En attente</x-badge>
                                    <span class="text-xs text-[#4c669a] dark:text-gray-400">Soumis {{ $sample['soumis'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-end gap-4 flex-shrink-0">
                            <div class="grid grid-cols-3 gap-3">
                                <div class="text-center px-3 py-2 bg-green-50 dark:bg-green-900/10 rounded-lg border border-green-100 dark:border-green-900/20">
                                    <p class="text-xs text-green-700 dark:text-green-400 mb-1">Moyenne</p>
                                    <p class="text-lg font-bold text-green-600">{{ $sample['moyenne'] }}</p>
                                </div>
                                <div class="text-center px-3 py-2 bg-blue-50 dark:bg-blue-900/10 rounded-lg border border-blue-100 dark:border-blue-900/20">
                                    <p class="text-xs text-blue-700 dark:text-blue-400 mb-1">Réussite</p>
                                    <p class="text-lg font-bold text-[#135bec]">{{ $sample['reussite'] }}%</p>
                                </div>
                                <div class="text-center px-3 py-2 bg-purple-50 dark:bg-purple-900/10 rounded-lg border border-purple-100 dark:border-purple-900/20">
                                    <p class="text-xs text-purple-700 dark:text-purple-400 mb-1">Conf.</p>
                                    <p class="text-lg font-bold text-purple-600">{{ $sample['confiance'] }}%</p>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('validation.show', 1) }}" class="px-4 py-2 rounded-lg bg-[#135bec] text-white text-sm font-medium hover:bg-[#0f4bc4] transition flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    Examiner
                                </a>
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
                                        <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-green-600 hover:bg-green-50 dark:hover:bg-green-900/10">
                                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                            Valider rapidement
                                        </button>
                                        <button class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10">
                                            <span class="material-symbols-outlined text-[18px]">cancel</span>
                                            Rejeter
                                        </button>
                                        <hr class="my-2 border-[#e7ebf3] dark:border-gray-700">
                                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                                            <span class="material-symbols-outlined text-[18px]">history</span>
                                            Voir historique
                                        </a>
                                    </div>
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
@if(isset($feuillesEnAttente) && $feuillesEnAttente->hasPages())
    <div class="mt-8">
        {{ $feuillesEnAttente->links() }}
    </div>
@endif

{{-- Empty State (si aucune feuille) --}}
@if(count($feuillesEnAttente ??  []) === 0 && request()->has('filiere_filter'))
    <div class="text-center py-16">
        <div class="size-20 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mx-auto mb-4">
            <span class="material-symbols-outlined text-4xl text-[#4c669a]">check_circle</span>
        </div>
        <h3 class="text-xl font-bold text-[#0d121b] dark: text-white mb-2">Aucune feuille à valider</h3>
        <p class="text-[#4c669a] dark: text-gray-400">
            Toutes les feuilles correspondant à vos critères ont été traitées.
        </p>
        <a href="{{ route('validation.index') }}" class="mt-4 inline-flex items-center gap-2 text-sm font-medium text-[#135bec] hover:text-[#0f4bc4]">
            <span class="material-symbols-outlined text-[18px]">refresh</span>
            Réinitialiser les filtres
        </a>
    </div>
@endif
@endsection