@extends('layouts.app')

@section('title', ($etudiant->nom_complet ?? 'Étudiant'))
@section('page-title', 'Fiche Étudiant')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Étudiants', 'url' => route('etudiants.index')],
        ['label' => $etudiant->matricule ?? '2023-0001', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('etudiants.index') }}" class="size-10 rounded-lg border border-[#e7ebf3] dark:border-gray-700 flex items-center justify-center text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('etudiants.releve', $etudiant) }}" class="px-4 py-2 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">description</span>
                Relevé de Notes
            </a>
            <a href="{{ route('etudiants.edit', $etudiant) }}">
                <x-button variant="secondary" size="md" icon="edit">
                    Modifier
                </x-button>
            </a>
        </div>
    </div>

    {{-- Student Card --}}
    <x-card>
        <div class="flex flex-col md:flex-row gap-6">
            {{-- Photo --}}
            <div class="flex-shrink-0">
                <div class="size-32 rounded-xl bg-cover bg-center border-4 border-white dark:border-gray-800 shadow-xl" style="background-image: url('{{ $etudiant->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($etudiant->nom_complet ?? 'ALAMI Ahmed').'&size=256&background=135bec&color=fff' }}');"></div>
            </div>

            {{-- Info --}}
            <div class="flex-1">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h1 class="text-3xl font-black text-[#0d121b] dark:text-white mb-2">
                            {{ $etudiant->nom_complet ?? 'ALAMI Ahmed' }}
                        </h1>
                        <div class="flex items-center gap-3">
                            <x-badge variant="info" size="lg">{{ $etudiant->matricule ?? '2023-0001' }}</x-badge>
                            <x-badge variant="success">Actif</x-badge>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase mb-1">Filière</p>
                        <p class="font-bold text-[#0d121b] dark:text-white">{{ $etudiant->filiere->nom ?? 'Génie Logiciel' }}</p>
                        <p class="text-sm text-[#4c669a] dark:text-gray-400">{{ $etudiant->niveau ?? 'Licence 3' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase mb-1">Email</p>
                        <a href="mailto:{{ $etudiant->email }}" class="font-medium text-[#135bec] hover:underline">
                            {{ $etudiant->email ?? 'ahmed.alami@etudiant.ma' }}
                        </a>
                    </div>
                    <div>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase mb-1">Téléphone</p>
                        <a href="tel:{{ $etudiant->telephone }}" class="font-medium text-[#0d121b] dark:text-white">
                            {{ $etudiant->telephone ?? '+212 6 12 34 56 78' }}
                        </a>
                    </div>
                    <div>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase mb-1">Groupe</p>
                        <p class="font-medium text-[#0d121b] dark:text-white">{{ $etudiant->groupe ?? 'Groupe A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase mb-1">Date d'inscription</p>
                        <p class="font-medium text-[#0d121b] dark:text-white">{{ $etudiant->created_at?->format('d/m/Y') ?? '01/09/2023' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400 uppercase mb-1">Année académique</p>
                        <p class="font-medium text-[#0d121b] dark:text-white">2023-2024</p>
                    </div>
                </div>
            </div>
        </div>
    </x-card>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat-card 
        title="Moyenne Générale" 
        value="{{ $etudiant->moyenne_generale ?? '14.2' }}/20" 
        icon="trending_up" 
        iconBg="green"
        subtitle="Semestre en cours"
    />
    
    <x-stat-card 
        title="Modules Suivis" 
        value="{{ $etudiant->modules_count ?? 6 }}" 
        icon="book" 
        iconBg="blue"
        subtitle="Ce semestre"
    />
    
    <x-stat-card 
        title="Crédits Validés" 
        value="{{ $etudiant->credits_valides ?? 120 }}" 
        icon="workspace_premium" 
        iconBg="purple"
        subtitle="Sur 180 ECTS"
    />
    
    <x-stat-card 
        title="Taux de Réussite" 
        value="{{ $etudiant->taux_reussite ?? 92 }}%" 
        icon="percent" 
        iconBg="teal"
        subtitle="Global"
    />
</div>

{{-- Main Content --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    {{-- Left:   Notes & Performance (2/3) --}}
    <div class="xl:col-span-2 space-y-6">
        {{-- Notes du Semestre --}}
        <x-card title="Notes du Semestre Actuel" icon="description">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#f8f9fc] dark:bg-gray-800/50 border-b border-[#e7ebf3] dark:border-gray-800">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Module</th>
                            <th class="px-4 py-3 text-center font-semibold text-[#4c669a] dark:text-gray-400 w-20">Coef.</th>
                            <th class="px-4 py-3 text-center font-semibold text-[#4c669a] dark:text-gray-400 w-24">Note/20</th>
                            <th class="px-4 py-3 text-center font-semibold text-[#4c669a] dark:text-gray-400 w-32">Mention</th>
                            <th class="px-4 py-3 text-center font-semibold text-[#4c669a] dark:text-gray-400 w-20">ECTS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                        @forelse($etudiant->notes ?? [] as $note)
                            <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition">
                                <td class="px-4 py-3">
                                    <p class="font-medium text-[#0d121b] dark:text-white">{{ $note->module->nom }}</p>
                                    <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $note->module->code }}</p>
                                </td>
                                <td class="px-4 py-3 text-center text-[#4c669a]">{{ $note->module->coefficient }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="text-lg font-bold {{ $note->note_finale >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ number_format($note->note_finale, 2) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <x-badge :variant="$note->note_finale >= 16 ? 'success' : ($note->note_finale >= 14 ? 'info' : ($note->note_finale >= 12 ? 'default' : ($note->note_finale >= 10 ? 'warning' : 'danger')))">
                                        {{ $note->mention }}
                                    </x-badge>
                                </td>
                                <td class="px-4 py-3 text-center font-medium text-[#0d121b] dark:text-white">
                                    {{ $note->module->credit_ects }}
                                </td>
                            </tr>
                        @empty
                            {{-- Sample Data --}}
                            @foreach([
                                ['module' => 'Algorithmique Avancée', 'code' => 'INF-301', 'coef' => 4, 'note' => 15.5, 'mention' => 'Bien', 'ects' => 6],
                                ['module' => 'Bases de Données', 'code' => 'INF-302', 'coef' => 4, 'note' => 14.25, 'mention' => 'Bien', 'ects' => 6],
                                ['module' => 'Génie Logiciel', 'code' => 'INF-303', 'coef' => 3, 'note' => 16.0, 'mention' => 'Très Bien', 'ects' => 5],
                                ['module' => 'Développement Web', 'code' => 'INF-304', 'coef' => 3, 'note' => 13.75, 'mention' => 'Assez Bien', 'ects' => 5],
                                ['module' => 'Probabilités', 'code' => 'MAT-201', 'coef' => 2, 'note' => 12.5, 'mention' => 'Assez Bien', 'ects' => 4],
                                ['module' => 'Anglais Technique', 'code' => 'ANG-101', 'coef' => 2, 'note' => 14.0, 'mention' => 'Bien', 'ects' => 3],
                            ] as $sample)
                                <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition">
                                    <td class="px-4 py-3">
                                        <p class="font-medium text-[#0d121b] dark:text-white">{{ $sample['module'] }}</p>
                                        <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $sample['code'] }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-center text-[#4c669a]">{{ $sample['coef'] }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="text-lg font-bold {{ $sample['note'] >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($sample['note'], 2) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <x-badge :variant="$sample['note'] >= 16 ? 'success' : ($sample['note'] >= 14 ? 'info' : ($sample['note'] >= 12 ? 'default' : ($sample['note'] >= 10 ? 'warning' : 'danger')))">
                                            {{ $sample['mention'] }}
                                        </x-badge>
                                    </td>
                                    <td class="px-4 py-3 text-center font-medium text-[#0d121b] dark:text-white">{{ $sample['ects'] }}</td>
                                </tr>
                            @endforeach
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-100 dark:bg-gray-800 border-t-2 border-gray-300 dark:border-gray-700">
                        <tr>
                            <td class="px-4 py-3 font-bold text-[#0d121b] dark:text-white" colspan="2">MOYENNE GÉNÉRALE</td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-xl font-bold text-green-600">14.42</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <x-badge variant="success">Bien</x-badge>
                            </td>
                            <td class="px-4 py-3 text-center font-bold text-[#0d121b] dark:text-white">29</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </x-card>

        {{-- Evolution --}}
        <x-card title="Évolution des Résultats" icon="show_chart">
            <div class="h-64 flex items-center justify-center bg-gray-50 dark:bg-gray-900 rounded-lg">
                <div class="text-center">
                    <span class="material-symbols-outlined text-6xl text-[#4c669a] mb-4">show_chart</span>
                    <p class="text-sm text-[#4c669a]">Graphique d'évolution des moyennes</p>
                </div>
            </div>
        </x-card>
    </div>

    {{-- Right: Additional Info (1/3) --}}
    <div class="space-y-6">
        {{-- Quick Actions --}}
        <x-card title="Actions Rapides" icon="touch_app">
            <div class="space-y-2">
                <button class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition text-left">
                    <div class="size-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-[#135bec]">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <div>
                        <p class="font-medium text-[#0d121b] dark:text-white text-sm">Envoyer un email</p>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400">Contacter l'étudiant</p>
                    </div>
                </button>

                <button class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition text-left">
                    <div class="size-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600">
                        <span class="material-symbols-outlined">description</span>
                    </div>
                    <div>
                        <p class="font-medium text-[#0d121b] dark:text-white text-sm">Relevé de notes</p>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400">Télécharger PDF</p>
                    </div>
                </button>

                <button class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition text-left">
                    <div class="size-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600">
                        <span class="material-symbols-outlined">article</span>
                    </div>
                    <div>
                        <p class="font-medium text-[#0d121b] dark:text-white text-sm">Bulletin</p>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400">Générer le bulletin</p>
                    </div>
                </button>

                <button class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition text-left">
                    <div class="size-10 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600">
                        <span class="material-symbols-outlined">history</span>
                    </div>
                    <div>
                        <p class="font-medium text-[#0d121b] dark:text-white text-sm">Historique</p>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400">Voir tout</p>
                    </div>
                </button>
            </div>
        </x-card>

        {{-- Distribution Notes --}}
        <x-card title="Distribution des Notes" icon="pie_chart">
            <div class="space-y-3">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-[#4c669a]">16-20 (TB)</span>
                        <span class="text-sm font-bold text-green-600">1</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                        <div class="h-full bg-green-500 rounded-full" style="width: 17%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-[#4c669a]">14-16 (B)</span>
                        <span class="text-sm font-bold text-blue-600">3</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                        <div class="h-full bg-blue-500 rounded-full" style="width: 50%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-[#4c669a]">12-14 (AB)</span>
                        <span class="text-sm font-bold text-purple-600">2</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                        <div class="h-full bg-purple-500 rounded-full" style="width: 33%"></div>
                    </div>
                </div>
            </div>
        </x-card>

        {{-- Info Card --}}
        <div class="bg-gradient-to-br from-[#135bec] to-blue-600 rounded-xl p-6 text-white">
            <div class="flex items-start gap-3 mb-4">
                <span class="material-symbols-outlined text-3xl">info</span>
                <div>
                    <h4 class="font-bold text-lg mb-1">Statut Académique</h4>
                    <p class="text-sm text-blue-100">Étudiant en règle</p>
                </div>
            </div>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-blue-100">Inscription</span>
                    <span class="font-bold">Valide</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-blue-100">Paiement</span>
                    <span class="font-bold">À jour</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-blue-100">Assiduité</span>
                    <span class="font-bold">95%</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection