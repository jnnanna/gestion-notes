@extends('layouts.app')

@section('title', ($feuilleNote->module->nom ?? 'Feuille de Notes'))
@section('page-title', 'Détail Feuille de Notes')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Feuilles de Notes', 'url' => route('feuilles-notes.index')],
        ['label' => $feuilleNote->code ??  'FN-2024-001', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('feuilles-notes.index') }}" class="size-10 rounded-lg border border-[#e7ebf3] dark:border-gray-700 flex items-center justify-center text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-2xl font-black text-[#0d121b] dark:text-white">
                        {{ $feuilleNote->module->nom ?? 'Algorithmique Avancée' }}
                    </h1>
                    <x-badge variant="info">{{ $feuilleNote->code ?? 'FN-2024-001' }}</x-badge>
                    <x-badge :variant="($feuilleNote->statut->value ?? 'valide') === 'valide' ? 'success' : 'warning'">
                        {{ $feuilleNote->statut->label() ?? 'Validé' }}
                    </x-badge>
                </div>
                <div class="flex items-center gap-4 text-sm text-[#4c669a] dark:text-gray-400">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">school</span>
                        {{ $feuilleNote->module->filiere->nom ?? 'Génie Logiciel - L3' }}
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">person</span>
                        {{ $feuilleNote->enseignant->name ?? 'Dr. Sarah Martin' }}
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                        {{ $feuilleNote->date_examen?->format('d/m/Y') ?? '15/12/2024' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('feuilles-notes.historique', $feuilleNote) }}" class="px-4 py-2 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">history</span>
                Historique
            </a>
            <x-button variant="secondary" size="md" icon="download">
                Télécharger PDF
            </x-button>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Étudiants</p>
            <p class="text-2xl font-bold text-[#0d121b] dark:text-white">{{ $feuilleNote->notes_count ??  35 }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Moyenne</p>
            <p class="text-2xl font-bold text-green-600">{{ $feuilleNote->moyenne ??  '13.45' }}/20</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Min</p>
            <p class="text-2xl font-bold text-red-600">{{ $feuilleNote->note_min ?? '7.5' }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Max</p>
            <p class="text-2xl font-bold text-green-600">{{ $feuilleNote->note_max ?? '18.75' }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Réussite</p>
            <p class="text-2xl font-bold text-[#135bec]">{{ $feuilleNote->taux_reussite ?? 91 }}%</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Écart-type</p>
            <p class="text-2xl font-bold text-purple-600">{{ $feuilleNote->ecart_type ?? '3.2' }}</p>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div class="grid grid-cols-1 xl:grid-cols-4 gap-6">
    {{-- Left:  Table (3/4) --}}
    <div class="xl:col-span-3">
        <x-card :padding="false">
            <x-slot name="title">
                <div class="flex items-center justify-between w-full">
                    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">
                        Liste des Notes
                    </h3>
                    <x-input 
                        type="search"
                        placeholder="Rechercher un étudiant..."
                        icon="search"
                        size="sm"
                        class="w-64"
                    />
                </div>
            </x-slot>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#f8f9fc] dark:bg-gray-800/50 border-b border-[#e7ebf3] dark:border-gray-800 sticky top-0">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">#</th>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Matricule</th>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Nom & Prénom</th>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Note/20</th>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                        @forelse($feuilleNote->notes ??  [] as $index => $note)
                            <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition">
                                <td class="px-4 py-3 text-[#4c669a]">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">
                                    <span class="font-mono text-[#4c669a]">{{ $note->etudiant->matricule }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-[#0d121b] dark:text-white">{{ $note->etudiant->nom_complet }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-lg font-bold {{ $note->note_examen >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ number_format($note->note_examen, 2) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <x-badge :variant="$note->note_examen >= 10 ? 'success' : 'danger'">
                                        {{ $note->note_examen >= 10 ? 'Admis' : 'Échec' }}
                                    </x-badge>
                                </td>
                            </tr>
                        @empty
                            {{-- Sample Data --}}
                            @foreach([
                                ['matricule' => '2023-0001', 'nom' => 'ALAMI Ahmed', 'note' => 15.5],
                                ['matricule' => '2023-0002', 'nom' => 'BENALI Fatima', 'note' => 12.75],
                                ['matricule' => '2023-0003', 'nom' => 'CHAKIR Mohamed', 'note' => 8.5],
                                ['matricule' => '2023-0004', 'nom' => 'IDRISSI Sara', 'note' => 16.25],
                                ['matricule' => '2023-0005', 'nom' => 'MANSOURI Karim', 'note' => 14.0],
                            ] as $i => $sample)
                                <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition">
                                    <td class="px-4 py-3 text-[#4c669a]">{{ $i + 1 }}</td>
                                    <td class="px-4 py-3">
                                        <span class="font-mono text-[#4c669a]">{{ $sample['matricule'] }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-medium text-[#0d121b] dark:text-white">{{ $sample['nom'] }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-lg font-bold {{ $sample['note'] >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($sample['note'], 2) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <x-badge :variant="$sample['note'] >= 10 ? 'success' : 'danger'">
                                            {{ $sample['note'] >= 10 ? 'Admis' : 'Échec' }}
                                        </x-badge>
                                    </td>
                                </tr>
                            @endforeach
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>

    {{-- Right: Stats (1/4) --}}
    <div class="space-y-6">
        {{-- Distribution --}}
        <x-card title="Distribution des Notes" icon="bar_chart">
            <div class="space-y-3">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-[#4c669a]">16-20 (TB)</span>
                        <span class="text-sm font-bold text-green-600">5</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-green-500" style="width: 14%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-[#4c669a]">14-16 (B)</span>
                        <span class="text-sm font-bold text-blue-600">12</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500" style="width: 34%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-[#4c669a]">12-14 (AB)</span>
                        <span class="text-sm font-bold text-purple-600">10</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-purple-500" style="width: 29%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-[#4c669a]">10-12 (P)</span>
                        <span class="text-sm font-bold text-orange-600">5</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-orange-500" style="width: 14%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-[#4c669a]">&lt;10 (I)</span>
                        <span class="text-sm font-bold text-red-600">3</span>
                    </div>
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-red-500" style="width: 9%"></div>
                    </div>
                </div>
            </div>
        </x-card>

        {{-- Info --}}
        <x-card title="Informations" icon="info">
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-[#4c669a]">Type d'évaluation</span>
                    <span class="font-medium text-[#0d121b] dark:text-white">{{ $feuilleNote->type_evaluation ??  'Examen Final' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#4c669a]">Coefficient</span>
                    <span class="font-medium text-[#0d121b] dark:text-white">{{ $feuilleNote->module->coefficient ?? 4 }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#4c669a]">Crédits ECTS</span>
                    <span class="font-medium text-[#0d121b] dark:text-white">{{ $feuilleNote->module->credit_ects ?? 6 }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#4c669a]">Date création</span>
                    <span class="font-medium text-[#0d121b] dark:text-white">{{ $feuilleNote->created_at?->format('d/m/Y') }}</span>
                </div>
                @if($feuilleNote->valide_at)
                <div class="flex justify-between">
                    <span class="text-[#4c669a]">Validé le</span>
                    <span class="font-medium text-[#0d121b] dark:text-white">{{ $feuilleNote->valide_at->format('d/m/Y') }}</span>
                </div>
                @endif
            </div>
        </x-card>
    </div>
</div>
@endsection