@extends('layouts.app')

@section('title', 'Historique - ' . ($feuilleNote->module->nom ?? 'Module'))
@section('page-title', 'Historique des Modifications')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Validation', 'url' => route('validation.index')],
        ['label' => $feuilleNote->code ??  'FN-2024-001', 'url' => route('validation.show', $feuilleNote)],
        ['label' => 'Historique', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('validation.show', $feuilleNote) }}" class="size-10 rounded-lg border border-[#e7ebf3] dark:border-gray-700 flex items-center justify-center text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-2xl font-black text-[#0d121b] dark:text-white">
                        Historique des Modifications
                    </h1>
                    <x-badge variant="info">{{ $feuilleNote->code ?? 'FN-2024-001' }}</x-badge>
                </div>
                <div class="flex items-center gap-4 text-sm text-[#4c669a] dark: text-gray-400">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">school</span>
                        {{ $feuilleNote->module->nom ??  'Algorithmique Avancée' }}
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">person</span>
                        {{ $feuilleNote->enseignant->name ?? 'Dr. Sarah Martin' }}
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">history</span>
                        {{ $feuilleNote->historiqueValidations->count() ?? 12 }} événements
                    </span>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <x-button variant="secondary" size="md" icon="download">
                Exporter l'historique
            </x-button>
            <x-button variant="secondary" size="md" icon="filter_list">
                Filtres
            </x-button>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Événements</p>
            <p class="text-2xl font-bold text-[#0d121b] dark:text-white">{{ $stats['total'] ??  12 }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Modifications</p>
            <p class="text-2xl font-bold text-blue-600">{{ $stats['modifications'] ?? 8 }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Validations</p>
            <p class="text-2xl font-bold text-green-600">{{ $stats['validations'] ?? 3 }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Rejets</p>
            <p class="text-2xl font-bold text-red-600">{{ $stats['rejets'] ?? 1 }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark: text-gray-400 mb-1">Contributeurs</p>
            <p class="text-2xl font-bold text-purple-600">{{ $stats['contributeurs'] ?? 4 }}</p>
        </div>
    </div>
</div>

{{-- Filters Bar --}}
<div class="bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl p-5 shadow-sm mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <x-select 
            name="action_filter" 
            label="Type d'action"
            :options="[
                '' => 'Toutes les actions',
                'creation' => 'Création',
                'modification' => 'Modification',
                'validation' => 'Validation',
                'rejet' => 'Rejet',
                'verrouillage' => 'Verrouillage',
            ]"
        />
        
        <x-select 
            name="user_filter" 
            label="Utilisateur"
            :options="[
                '' => 'Tous les utilisateurs',
                1 => 'Dr. Sarah Martin',
                2 => 'Admin Système',
                3 => 'Pr.  Ahmed Benali',
            ]"
        />
        
        <x-input 
            type="date"
            name="date_debut"
            label="Date début"
            icon="calendar_today"
        />
        
        <x-input 
            type="date"
            name="date_fin"
            label="Date fin"
            icon="calendar_today"
        />
    </div>
    
    <div class="flex items-center justify-end gap-3 mt-4">
        <button type="button" class="text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
            Réinitialiser
        </button>
        <x-button variant="secondary" size="sm" icon="search">
            Appliquer
        </x-button>
    </div>
</div>

{{-- Timeline --}}
<div class="grid grid-cols-1 xl:grid-cols-4 gap-6">
    {{-- Main Timeline (3/4) --}}
    <div class="xl:col-span-3">
        <x-card : padding="false">
            <div class="p-6">
                <h3 class="text-lg font-bold text-[#0d121b] dark:text-white mb-6">Chronologie des Événements</h3>
                
                <div class="relative">
                    {{-- Vertical Line --}}
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#135bec] via-purple-500 to-gray-300 dark:to-gray-700"></div>
                    
                    {{-- Timeline Items --}}
                    <div class="space-y-8">
                        @forelse($feuilleNote->historiqueValidations ??  [] as $historique)
                            <div class="relative pl-16">
                                {{-- Icon --}}
                                <div class="absolute left-0 size-12 rounded-full bg-{{ $historique->action->color() ??  'blue' }}-100 dark:bg-{{ $historique->action->color() ?? 'blue' }}-900/30 border-4 border-white dark:border-[#0d121b] flex items-center justify-center shadow-lg">
                                    <span class="material-symbols-outlined text-{{ $historique->action->color() ?? 'blue' }}-600 text-xl">
                                        {{ $historique->action->icon() ?? 'circle' }}
                                    </span>
                                </div>

                                {{-- Content Card --}}
                                <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4 hover:shadow-md transition">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <x-badge : variant="$historique->action->badgeVariant() ?? 'default'">
                                                {{ $historique->action->label() ?? 'Action' }}
                                            </x-badge>
                                            <span class="text-sm text-[#4c669a] dark:text-gray-400">
                                                {{ $historique->created_at->format('d/m/Y à H:i') }}
                                            </span>
                                        </div>
                                        <span class="text-xs text-[#4c669a] dark:text-gray-400">
                                            {{ $historique->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="size-8 rounded-full bg-cover bg-center" style="background-image: url('{{ $historique->user->avatar_url }}');"></div>
                                        <div>
                                            <p class="font-medium text-[#0d121b] dark:text-white">{{ $historique->user->name }}</p>
                                            <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $historique->user->roles->first()->name ??  'Utilisateur' }}</p>
                                        </div>
                                    </div>

                                    <p class="text-sm text-[#4c669a] dark: text-gray-400 mb-3">
                                        {{ $historique->description }}
                                    </p>

                                    @if($historique->changements)
                                        <div class="bg-[#f8f9fc] dark:bg-gray-800/50 rounded-lg p-3 space-y-2">
                                            <p class="text-xs font-semibold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider mb-2">Modifications :</p>
                                            @foreach($historique->changements as $champ => $valeurs)
                                                <div class="flex items-center gap-2 text-sm">
                                                    <span class="font-medium text-[#0d121b] dark:text-white">{{ ucfirst($champ) }}:</span>
                                                    <span class="px-2 py-0.5 bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400 rounded line-through">{{ $valeurs['avant'] }}</span>
                                                    <span class="material-symbols-outlined text-[#4c669a] text-[14px]">arrow_forward</span>
                                                    <span class="px-2 py-0.5 bg-green-100 dark: bg-green-900/20 text-green-700 dark: text-green-400 rounded font-medium">{{ $valeurs['apres'] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if($historique->ip_address)
                                        <div class="flex items-center gap-2 mt-3 text-xs text-[#4c669a] dark:text-gray-400">
                                            <span class="material-symbols-outlined text-[14px]">computer</span>
                                            IP: {{ $historique->ip_address }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            {{-- Sample Data --}}
                            @foreach([
                                ['action' => 'validation', 'icon' => 'check_circle', 'color' => 'green', 'titre' => 'Feuille validée', 'user' => 'Pr. Ahmed Benali', 'role' => 'Chef de Département', 'desc' => 'La feuille de notes a été validée et approuvée pour publication.', 'time' => '15/12/2024 à 16:30', 'diff' => 'il y a 2 heures', 'changes' => null],
                                ['action' => 'modification', 'icon' => 'edit', 'color' => 'blue', 'titre' => 'Note modifiée', 'user' => 'Dr. Sarah Martin', 'role' => 'Enseignant', 'desc' => 'Correction de la note de l\'étudiant ALAMI Ahmed. ', 'time' => '15/12/2024 à 15:45', 'diff' => 'il y a 3 heures', 'changes' => ['Note' => ['avant' => '15.00', 'apres' => '15.50']]],
                                ['action' => 'rejet', 'icon' => 'cancel', 'color' => 'red', 'titre' => 'Feuille rejetée', 'user' => 'Admin Système', 'role' => 'Administrateur', 'desc' => 'Feuille rejetée en raison d\'incohérences dans les données OCR.', 'time' => '15/12/2024 à 14:20', 'diff' => 'il y a 4 heures', 'changes' => null],
                                ['action' => 'modification', 'icon' => 'edit', 'color' => 'blue', 'titre' => 'Correction multiple', 'user' => 'Dr. Sarah Martin', 'role' => 'Enseignant', 'desc' => 'Correction de 3 notes suite à une erreur de saisie.', 'time' => '15/12/2024 à 13:10', 'diff' => 'il y a 5 heures', 'changes' => null],
                                ['action' => 'creation', 'icon' => 'add_circle', 'color' => 'purple', 'titre' => 'Feuille créée', 'user' => 'Dr. Sarah Martin', 'role' => 'Enseignant', 'desc' => 'Création initiale de la feuille de notes suite à l\'importation OCR.', 'time' => '15/12/2024 à 12:00', 'diff' => 'il y a 6 heures', 'changes' => null],
                            ] as $event)
                                <div class="relative pl-16">
                                    <div class="absolute left-0 size-12 rounded-full bg-{{ $event['color'] }}-100 dark:bg-{{ $event['color'] }}-900/30 border-4 border-white dark:border-[#0d121b] flex items-center justify-center shadow-lg">
                                        <span class="material-symbols-outlined text-{{ $event['color'] }}-600 text-xl">{{ $event['icon'] }}</span>
                                    </div>

                                    <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4 hover:shadow-md transition">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex items-center gap-3">
                                                <x-badge :variant="$event['action'] === 'validation' ? 'success' : ($event['action'] === 'rejet' ? 'danger' :  ($event['action'] === 'creation' ? 'info' : 'default'))">
                                                    {{ ucfirst($event['action']) }}
                                                </x-badge>
                                                <span class="text-sm text-[#4c669a] dark:text-gray-400">{{ $event['time'] }}</span>
                                            </div>
                                            <span class="text-xs text-[#4c669a] dark:text-gray-400">{{ $event['diff'] }}</span>
                                        </div>

                                        <div class="flex items-center gap-3 mb-3">
                                            <div class="size-8 rounded-full bg-cover bg-center" style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($event['user']) }}&background=135bec&color=fff');"></div>
                                            <div>
                                                <p class="font-medium text-[#0d121b] dark: text-white">{{ $event['user'] }}</p>
                                                <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $event['role'] }}</p>
                                            </div>
                                        </div>

                                        <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-3">{{ $event['desc'] }}</p>

                                        @if($event['changes'])
                                            <div class="bg-[#f8f9fc] dark:bg-gray-800/50 rounded-lg p-3 space-y-2">
                                                <p class="text-xs font-semibold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider mb-2">Modifications :</p>
                                                @foreach($event['changes'] as $champ => $valeurs)
                                                    <div class="flex items-center gap-2 text-sm">
                                                        <span class="font-medium text-[#0d121b] dark:text-white">{{ $champ }}:</span>
                                                        <span class="px-2 py-0.5 bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400 rounded line-through">{{ $valeurs['avant'] }}</span>
                                                        <span class="material-symbols-outlined text-[#4c669a] text-[14px]">arrow_forward</span>
                                                        <span class="px-2 py-0.5 bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-400 rounded font-medium">{{ $valeurs['apres'] }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="flex items-center gap-2 mt-3 text-xs text-[#4c669a] dark:text-gray-400">
                                            <span class="material-symbols-outlined text-[14px]">computer</span>
                                            IP: 192.168.1.{{ rand(10, 250) }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforelse
                    </div>
                </div>
            </div>
        </x-card>
    </div>

    {{-- Right Sidebar :  Summary (1/4) --}}
    <div class="xl:col-span-1 space-y-6">
        {{-- Contributors --}}
        <x-card title="Contributeurs" icon="group">
            <div class="space-y-3">
                @foreach([
                    ['name' => 'Dr. Sarah Martin', 'role' => 'Enseignant', 'actions' => 8],
                    ['name' => 'Pr. Ahmed Benali', 'role' => 'Chef Département', 'actions' => 3],
                    ['name' => 'Admin Système', 'role' => 'Administrateur', 'actions' => 1],
                ] as $contributor)
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition">
                        <div class="size-10 rounded-full bg-cover bg-center flex-shrink-0" style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($contributor['name']) }}&background=135bec&color=fff');"></div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-[#0d121b] dark:text-white truncate">{{ $contributor['name'] }}</p>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $contributor['role'] }}</p>
                        </div>
                        <x-badge variant="default">{{ $contributor['actions'] }}</x-badge>
                    </div>
                @endforeach
            </div>
        </x-card>

        {{-- Activity Chart --}}
        <x-card title="Activité par type" icon="pie_chart">
            <div class="space-y-3">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-[#4c669a] dark:text-gray-400">Modifications</span>
                        <span class="text-sm font-bold text-[#0d121b] dark:text-white">67%</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500 rounded-full" style="width: 67%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-[#4c669a] dark:text-gray-400">Validations</span>
                        <span class="text-sm font-bold text-[#0d121b] dark:text-white">25%</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-green-500 rounded-full" style="width: 25%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-[#4c669a] dark:text-gray-400">Rejets</span>
                        <span class="text-sm font-bold text-[#0d121b] dark:text-white">8%</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-red-500 rounded-full" style="width: 8%"></div>
                    </div>
                </div>
            </div>
        </x-card>

        {{-- Export --}}
        <div class="bg-gradient-to-br from-[#135bec] to-blue-600 rounded-xl p-6 text-white">
            <div class="flex items-start gap-3 mb-4">
                <span class="material-symbols-outlined text-3xl">download</span>
                <div>
                    <h4 class="font-bold text-lg mb-1">Exporter l'historique</h4>
                    <p class="text-sm text-blue-100">Téléchargez un rapport complet</p>
                </div>
            </div>
            <button class="w-full py-2 bg-white/20 hover:bg-white/30 rounded-lg text-sm font-medium transition">
                Générer le rapport PDF
            </button>
        </div>
    </div>
</div>
@endsection