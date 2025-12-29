@extends('layouts. app')

@section('title', 'Tableau de Bord')
@section('page-title', 'Tableau de Bord')

@section('content')
{{-- Welcome Message --}}
<div class="mb-8">
    <h1 class="text-2xl md:text-3xl font-bold text-[#0d121b] dark:text-white tracking-tight">
        Bonjour, {{ auth()->user()->name }}
    </h1>
    <p class="text-[#4c669a] dark:text-gray-400 mt-1">
        Voici l'aperçu de votre espace de gestion des notes.
    </p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat-card 
        title="Feuilles Scannées" 
        : value="$stats['feuilles_scannees'] ?? '1,240'" 
        icon="description" 
        iconBg="blue"
        trend="up"
        trendValue="+5%"
        subtitle="Ce mois"
    />
    
    <x-stat-card 
        title="Modules Actifs" 
        : value="$stats['modules_actifs'] ?? '12'" 
        icon="view_module" 
        iconBg="purple"
        subtitle="En cours"
    />
    
    <x-stat-card 
        title="Validations Requises" 
        :value="$stats['validations_requises'] ?? '3'" 
        icon="pending_actions" 
        iconBg="orange"
        subtitle="En attente de traitement"
    />
    
    <x-stat-card 
        title="Alertes Système" 
        :value="$stats['alertes_systeme'] ?? '2'" 
        icon="warning" 
        iconBg="red"
        subtitle="Nécessite votre attention"
    />
</div>

{{-- Two Column Layout --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    {{-- Left Column (2/3) --}}
    <div class="xl:col-span-2 space-y-8">
        {{-- Recent Activities Table --}}
        <x-card title="Activités Récentes" : padding="false">
            <x-slot name="title">
                <div class="flex items-center justify-between w-full">
                    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">Activités Récentes</h3>
                    <a href="{{ route('feuilles-notes.index') }}" class="text-sm font-medium text-[#135bec] hover:text-[#0f4bc4] transition">
                        Tout voir
                    </a>
                </div>
            </x-slot>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#f8f9fc] dark:bg-gray-800/50 text-[#4c669a] dark:text-gray-400 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-medium">Module</th>
                            <th class="px-6 py-4 font-medium">Professeur</th>
                            <th class="px-6 py-4 font-medium">Date</th>
                            <th class="px-6 py-4 font-medium">Statut</th>
                            <th class="px-6 py-4 font-medium text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                        @forelse($activites ??  [] as $activite)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-8 rounded bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-[#135bec] font-bold text-xs">
                                            {{ strtoupper(substr($activite['code'] ?? 'AL', 0, 2)) }}
                                        </div>
                                        <span class="text-sm font-medium text-[#0d121b] dark:text-white">
                                            {{ $activite['module'] ?? 'Algorithmique Avancée' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4c669a] dark: text-gray-400">
                                    {{ $activite['professeur'] ?? 'Dr. Sarah Martin' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4c669a] dark:text-gray-400">
                                    {{ $activite['date'] ?? '29 Déc, 10:23' }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statut = $activite['statut'] ?? 'valide';
                                        $variants = [
                                            'valide' => 'success',
                                            'en_attente' => 'warning',
                                            'erreur' => 'danger',
                                        ];
                                    @endphp
                                    <x-badge :variant="$variants[$statut]" dot>
                                        {{ ucfirst(str_replace('_', ' ', $statut)) }}
                                    </x-badge>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-[#4c669a] hover:text-[#135bec] transition">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            {{-- Sample Data --}}
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-8 rounded bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-[#135bec] font-bold text-xs">AL</div>
                                        <span class="text-sm font-medium text-[#0d121b] dark:text-white">Algorithmique Avancée</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4c669a] dark:text-gray-400">Dr. Sarah Martin</td>
                                <td class="px-6 py-4 text-sm text-[#4c669a] dark:text-gray-400">29 Déc, 10:23</td>
                                <td class="px-6 py-4">
                                    <x-badge variant="success" dot>Validé</x-badge>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-[#4c669a] hover:text-[#135bec] transition">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-8 rounded bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 font-bold text-xs">BD</div>
                                        <span class="text-sm font-medium text-[#0d121b] dark: text-white">Bases de Données</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4c669a] dark: text-gray-400">Pr. Ahmed Mansouri</td>
                                <td class="px-6 py-4 text-sm text-[#4c669a] dark:text-gray-400">29 Déc, 09:45</td>
                                <td class="px-6 py-4">
                                    <x-badge variant="warning" dot>En attente</x-badge>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-[#4c669a] hover:text-[#135bec] transition">
                                        <span class="material-symbols-outlined text-[20px]">more_vert</span>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover: bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-8 rounded bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center text-pink-600 font-bold text-xs">RS</div>
                                        <span class="text-sm font-medium text-[#0d121b] dark:text-white">Réseaux & Systèmes</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4c669a] dark:text-gray-400">Dr. Marie Dubois</td>
                                <td class="px-6 py-4 text-sm text-[#4c669a] dark:text-gray-400">28 Déc, 16:30</td>
                                <td class="px-6 py-4">
                                    <x-badge variant="danger" dot>Erreur OCR</x-badge>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-[#4c669a] hover:text-[#135bec] transition">
                                        <span class="material-symbols-outlined text-[20px]">replay</span>
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>

        {{-- Chart Section --}}
        <x-card title="Répartition des Moyennes">
            <x-slot name="title">
                <div class="flex items-center justify-between w-full">
                    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">Répartition des Moyennes</h3>
                    <select class="bg-[#f8f9fc] dark:bg-gray-800 border-none rounded-lg text-xs font-medium px-3 py-1. 5 focus:ring-0">
                        <option>Ce Semestre</option>
                        <option>Semestre Précédent</option>
                        <option>Année Complète</option>
                    </select>
                </div>
            </x-slot>

            <div class="relative w-full h-48 flex items-end justify-between gap-2 px-2">
                {{-- Grid Lines --}}
                <div class="absolute inset-0 flex flex-col justify-between z-0">
                    <div class="w-full h-px bg-gray-100 dark:bg-gray-800"></div>
                    <div class="w-full h-px bg-gray-100 dark:bg-gray-800"></div>
                    <div class="w-full h-px bg-gray-100 dark:bg-gray-800"></div>
                    <div class="w-full h-px bg-gray-100 dark:bg-gray-800"></div>
                    <div class="w-full h-px bg-gray-100 dark:bg-gray-800"></div>
                </div>

                {{-- Bars --}}
                @foreach([
                    ['height' => '40%', 'label' => '15%'],
                    ['height' => '65%', 'label' => '28%'],
                    ['height' => '85%', 'label' => '35%'],
                    ['height' => '55%', 'label' => '18%'],
                    ['height' => '25%', 'label' => '4%'],
                ] as $index => $bar)
                    <div class="relative z-10 w-full bg-[#135bec]/{{ 20 + ($index * 15) }} rounded-t-sm hover:bg-[#135bec]/{{ 30 + ($index * 15) }} transition-all cursor-pointer group" style="height: {{ $bar['height'] }};">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                            {{ $bar['label'] }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between px-2 text-xs text-[#4c669a] font-medium mt-4">
                <span>0-8</span>
                <span>8-10</span>
                <span>10-12</span>
                <span>12-14</span>
                <span>14-20</span>
            </div>
        </x-card>
    </div>

    {{-- Right Column (1/3) --}}
    <div class="space-y-8">
        {{-- Quick Actions --}}
        <div class="flex flex-col gap-4">
            <h3 class="text-lg font-bold text-[#0d121b] dark:text-white px-1">Actions Rapides</h3>
            <div class="grid grid-cols-1 gap-3">
                <a href="{{ route('importation.index') }}" class="group flex items-center p-4 bg-[#135bec] text-white rounded-xl shadow-lg shadow-blue-200 dark:shadow-none hover:shadow-xl hover:bg-[#0f4bc4] transition-all">
                    <div class="bg-white/20 p-3 rounded-lg mr-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">add_a_photo</span>
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-lg leading-tight">Nouveau Scan</p>
                        <p class="text-blue-100 text-xs mt-0.5">Démarrer numérisation</p>
                    </div>
                    <span class="material-symbols-outlined ml-auto opacity-70">arrow_forward</span>
                </a>

                <a href="{{ route('importation.index') }}" class="group flex items-center p-4 bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl hover:border-[#135bec]/50 dark:hover:border-[#135bec]/50 transition-all text-[#0d121b] dark:text-white">
                    <div class="bg-blue-50 dark:bg-blue-900/20 text-[#135bec] p-3 rounded-lg mr-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">upload_file</span>
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-base leading-tight">Upload PDF</p>
                        <p class="text-[#4c669a] dark: text-gray-400 text-xs mt-0.5">Importer fichier existant</p>
                    </div>
                </a>

                <a href="{{ route('exportation.index') }}" class="group flex items-center p-4 bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl hover:border-[#135bec]/50 dark:hover:border-[#135bec]/50 transition-all text-[#0d121b] dark:text-white">
                    <div class="bg-purple-50 dark:bg-purple-900/20 text-purple-600 p-3 rounded-lg mr-4 group-hover: scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[24px]">assessment</span>
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-base leading-tight">Générer Rapport</p>
                        <p class="text-[#4c669a] dark:text-gray-400 text-xs mt-0.5">Exporter les données</p>
                    </div>
                </a>
            </div>
        </div>

        {{-- Recent Alerts --}}
        <x-card>
            <x-slot name="title">
                <div class="flex items-center justify-between w-full">
                    <h3 class="text-base font-bold text-[#0d121b] dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-orange-500">notifications_active</span>
                        Alertes Récentes
                    </h3>
                    <x-badge variant="warning">{{ count($alertes ??  []) > 0 ? count($alertes) : 2 }}</x-badge>
                </div>
            </x-slot>

            <div class="space-y-3">
                @forelse($alertes ?? [] as $alerte)
                    <div class="flex gap-3 items-start p-3 rounded-lg bg-{{ $alerte['type'] }}-50 dark:bg-{{ $alerte['type'] }}-900/10 border border-{{ $alerte['type'] }}-100 dark:border-{{ $alerte['type'] }}-900/20">
                        <span class="material-symbols-outlined text-{{ $alerte['type'] }}-600 text-[20px] mt-0.5">
                            {{ $alerte['icon'] }}
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-[#0d121b] dark: text-white">{{ $alerte['titre'] }}</p>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400 mt-1">{{ $alerte['message'] }}</p>
                            @if(isset($alerte['action']))
                                <button class="text-xs font-bold text-{{ $alerte['type'] }}-600 mt-2 hover:underline">
                                    {{ $alerte['action'] }}
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    {{-- Sample Alerts --}}
                    <div class="flex gap-3 items-start p-3 rounded-lg bg-orange-50 dark:bg-orange-900/10 border border-orange-100 dark:border-orange-900/20">
                        <span class="material-symbols-outlined text-orange-600 text-[20px] mt-0.5">warning</span>
                        <div>
                            <p class="text-sm font-semibold text-[#0d121b] dark:text-white">Moyenne Critique</p>
                            <p class="text-xs text-[#4c669a] dark: text-gray-400 mt-1">
                                Module "Chimie Org." :  La moyenne est inférieure à 8/20. 
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start p-3 rounded-lg bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/20">
                        <span class="material-symbols-outlined text-red-600 text-[20px] mt-0.5">error</span>
                        <div>
                            <p class="text-sm font-semibold text-[#0d121b] dark:text-white">Fichier Corrompu</p>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400 mt-1">
                                Scan #4024 illisible.  Veuillez re-scanner.
                            </p>
                            <button class="text-xs font-bold text-red-600 mt-2 hover:underline">Voir détails</button>
                        </div>
                    </div>
                @endforelse
            </div>
        </x-card>

        {{-- Security Card --}}
        <div class="relative rounded-xl overflow-hidden h-40 group cursor-pointer">
            <div class="absolute inset-0 bg-gradient-to-br from-[#135bec] to-blue-700"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
            <div class="absolute bottom-4 left-4 text-white z-10">
                <p class="font-bold text-lg">Sécurité Renforcée</p>
                <p class="text-xs text-blue-100 w-4/5">
                    Tous les documents sont chiffrés et archivés de manière sécurisée.
                </p>
            </div>
            <div class="absolute top-3 right-3 bg-white/20 backdrop-blur-sm p-1. 5 rounded-lg text-white">
                <span class="material-symbols-outlined text-[18px]">lock</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Vous pouvez ajouter du JavaScript pour les graphiques dynamiques ici
    console.log('Dashboard loaded');
</script>
@endpush