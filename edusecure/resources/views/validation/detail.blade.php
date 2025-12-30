@extends('layouts.app')

@section('title', 'Validation - ' . ($feuilleNote->module->nom ?? 'Module'))
@section('page-title', 'Validation de la Feuille de Notes')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Validation', 'url' => route('validation.index')],
        ['label' => $feuilleNote->code ?? 'FN-2024-001', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('validation.index') }}" class="size-10 rounded-lg border border-[#e7ebf3] dark:border-gray-700 flex items-center justify-center text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-2xl font-black text-[#0d121b] dark:text-white">
                        {{ $feuilleNote->module->nom ?? 'Algorithmique Avancée' }}
                    </h1>
                    <x-badge variant="info">{{ $feuilleNote->code ?? 'FN-2024-001' }}</x-badge>
                    <x-badge variant="warning" dot>En attente de validation</x-badge>
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
            {{-- View Mode Toggle --}}
            <div class="flex items-center bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-700 p-1" x-data="{ mode: 'split' }">
                <button 
                    @click="mode = 'split'"
                    :class="mode === 'split' ? 'bg-[#135bec] text-white' : 'text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white'"
                    class="px-3 py-1.5 rounded text-sm font-medium transition flex items-center gap-1"
                >
                    <span class="material-symbols-outlined text-[18px]">view_column</span>
                    Côte-à-côte
                </button>
                <button 
                    @click="mode = 'overlay'"
                    :class="mode === 'overlay' ? 'bg-[#135bec] text-white' : 'text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white'"
                    class="px-3 py-1.5 rounded text-sm font-medium transition flex items-center gap-1"
                >
                    <span class="material-symbols-outlined text-[18px]">layers</span>
                    Superposition
                </button>
                <button 
                    @click="mode = 'table'"
                    :class="mode === 'table' ? 'bg-[#135bec] text-white' : 'text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white'"
                    class="px-3 py-1.5 rounded text-sm font-medium transition flex items-center gap-1"
                >
                    <span class="material-symbols-outlined text-[18px]">table_chart</span>
                    Tableau seul
                </button>
            </div>

            {{-- Actions --}}
            <form action="{{ route('validation.rejeter', $feuilleNote) }}" method="POST" class="inline">
                @csrf
                <x-button type="submit" variant="danger" size="md" icon="cancel">
                    Rejeter
                </x-button>
            </form>
            
            <form action="{{ route('validation.valider', $feuilleNote) }}" method="POST" class="inline">
                @csrf
                <x-button type="submit" variant="success" size="md" icon="check_circle">
                    Valider
                </x-button>
            </form>
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
            <p class="text-2xl font-bold text-green-600">{{ $feuilleNote->moyenne ??  '13. 45' }}/20</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Min</p>
            <p class="text-2xl font-bold text-red-600">{{ $feuilleNote->note_min ?? '7. 5' }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Max</p>
            <p class="text-2xl font-bold text-green-600">{{ $feuilleNote->note_max ?? '18.75' }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark: text-gray-400 mb-1">Réussite</p>
            <p class="text-2xl font-bold text-[#135bec]">{{ $feuilleNote->taux_reussite ?? 91 }}%</p>
        </div>
        <div class="bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-800 p-4">
            <p class="text-xs text-[#4c669a] dark: text-gray-400 mb-1">Confiance OCR</p>
            <p class="text-2xl font-bold text-purple-600">{{ $feuilleNote->confiance_ocr ?? 96 }}%</p>
        </div>
    </div>
</div>

{{-- Main Content: Split View --}}
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6" x-data="{ mode: 'split' }">
    {{-- Left: Document Preview --}}
    <div x-show="mode !== 'table'" class="space-y-4">
        <x-card title="Document Original" icon="description" :padding="false">
            {{-- Document Viewer --}}
            <div class="relative bg-gray-100 dark:bg-gray-900 aspect-[210/297]">
                {{-- PDF/Image Preview --}}
                <div class="absolute inset-0 flex items-center justify-center">
                    @if($feuilleNote->fichierImporte?->type_mime === 'application/pdf')
                        <iframe 
                            src="{{ $feuilleNote->fichierImporte->url ?? '/placeholder-pdf.pdf' }}" 
                            class="w-full h-full"
                            frameborder="0"
                        ></iframe>
                    @else
                        <img 
                            src="{{ $feuilleNote->fichierImporte?->url ?? 'https://placehold.co/600x800/e7ebf3/4c669a?text=Document' }}" 
                            alt="Document" 
                            class="w-full h-full object-contain"
                        >
                    @endif
                </div>

                {{-- Zoom Controls --}}
                <div class="absolute top-4 right-4 flex flex-col gap-2">
                    <button class="size-10 rounded-lg bg-white dark:bg-[#1a2234] shadow-lg border border-[#e7ebf3] dark:border-gray-700 flex items-center justify-center text-[#4c669a] hover:text-[#135bec] transition">
                        <span class="material-symbols-outlined">zoom_in</span>
                    </button>
                    <button class="size-10 rounded-lg bg-white dark:bg-[#1a2234] shadow-lg border border-[#e7ebf3] dark:border-gray-700 flex items-center justify-center text-[#4c669a] hover:text-[#135bec] transition">
                        <span class="material-symbols-outlined">zoom_out</span>
                    </button>
                    <button class="size-10 rounded-lg bg-white dark:bg-[#1a2234] shadow-lg border border-[#e7ebf3] dark:border-gray-700 flex items-center justify-center text-[#4c669a] hover:text-[#135bec] transition">
                        <span class="material-symbols-outlined">download</span>
                    </button>
                </div>

                {{-- Quality Indicator --}}
                <div class="absolute bottom-4 left-4">
                    <div class="bg-white dark:bg-[#1a2234] rounded-lg shadow-lg px-3 py-2 flex items-center gap-2">
                        <div class="size-2 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-xs font-medium text-[#4c669a] dark:text-gray-400">
                            Qualité OCR : <span class="font-bold text-green-600">96%</span>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Document Info --}}
            <div class="p-4 bg-[#f8f9fc] dark:bg-gray-800/50 border-t border-[#e7ebf3] dark:border-gray-800">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-[#4c669a] dark:text-gray-400 mb-1">Fichier</p>
                        <p class="font-medium text-[#0d121b] dark:text-white">{{ $feuilleNote->fichierImporte?->nom_original ?? 'Feuille_Notes_Algo.pdf' }}</p>
                    </div>
                    <div>
                        <p class="text-[#4c669a] dark:text-gray-400 mb-1">Taille</p>
                        <p class="font-medium text-[#0d121b] dark:text-white">{{ $feuilleNote->fichierImporte?->taille_humaine ?? '2.3 MB' }}</p>
                    </div>
                    <div>
                        <p class="text-[#4c669a] dark:text-gray-400 mb-1">Importé le</p>
                        <p class="font-medium text-[#0d121b] dark:text-white">{{ $feuilleNote->created_at?->format('d/m/Y à H:i') ?? '15/12/2024 à 14:30' }}</p>
                    </div>
                    <div>
                        <p class="text-[#4c669a] dark:text-gray-400 mb-1">Pages</p>
                        <p class="font-medium text-[#0d121b] dark:text-white">{{ $feuilleNote->fichierImporte?->nb_pages ?? 1 }}</p>
                    </div>
                </div>
            </div>
        </x-card>
    </div>

    {{-- Right: Data Table --}}
    <div :class="mode === 'table' ? 'xl:col-span-2' : ''" class="space-y-4">
        <x-card :padding="false">
            <x-slot name="title">
                <div class="flex items-center justify-between w-full">
                    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">
                        Notes Extraites
                        <span class="ml-2 text-sm font-normal text-[#4c669a]">({{ $feuilleNote->notes_count ?? 35 }} étudiants)</span>
                    </h3>
                    <div class="flex items-center gap-2">
                        <x-input 
                            type="search"
                            placeholder="Rechercher..."
                            icon="search"
                            size="sm"
                            class="w-64"
                        />
                        <button class="p-2 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 text-[#4c669a] transition">
                            <span class="material-symbols-outlined text-[20px]">filter_list</span>
                        </button>
                    </div>
                </div>
            </x-slot>

            <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#f8f9fc] dark:bg-gray-800/50 border-b border-[#e7ebf3] dark:border-gray-800 sticky top-0 z-10">
                        <tr>
                            <th class="px-4 py-3 text-left w-12">
                                <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">#</th>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Matricule</th>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Nom & Prénom</th>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Note/20</th>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Confiance</th>
                            <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Statut</th>
                            <th class="px-4 py-3 text-right font-semibold text-[#4c669a] dark:text-gray-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                        @forelse($feuilleNote->notes ?? [] as $index => $note)
                            <tr 
                                class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition {{ ($note->confiance ?? 98) < 80 ? 'bg-orange-50/50 dark:bg-orange-900/10' : '' }}"
                                x-data="{ editing: false }"
                            >
                                <td class="px-4 py-3">
                                    <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                                </td>
                                <td class="px-4 py-3 text-[#4c669a] dark:text-gray-400 font-medium">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">
                                    <span class="font-mono text-[#4c669a] dark:text-gray-400">{{ $note->etudiant->matricule ?? '2023-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div x-show="!editing">
                                        <p class="font-medium text-[#0d121b] dark:text-white">{{ $note->etudiant->nom_complet ?? 'ALAMI Ahmed' }}</p>
                                    </div>
                                    <input 
                                        x-show="editing" 
                                        type="text" 
                                        value="{{ $note->etudiant->nom_complet ?? 'ALAMI Ahmed' }}"
                                        class="w-full px-2 py-1 text-sm border border-[#135bec] rounded focus:ring-[#135bec]"
                                        style="display: none;"
                                    >
                                </td>
                                <td class="px-4 py-3">
                                    <div x-show="!editing" class="flex items-center gap-2">
                                        <span class="text-lg font-bold {{ ($note->note_examen ?? 15.5) >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($note->note_examen ?? 15.5, 2) }}
                                        </span>
                                        @if(($note->confiance ?? 98) < 80)
                                            <span class="material-symbols-outlined text-orange-500 text-[16px]" title="Faible confiance">warning</span>
                                        @endif
                                    </div>
                                    <input 
                                        x-show="editing" 
                                        type="number" 
                                        step="0.25"
                                        min="0"
                                        max="20"
                                        value="{{ $note->note_examen ?? 15.5 }}"
                                        class="w-24 px-2 py-1 text-sm border border-[#135bec] rounded focus:ring-[#135bec]"
                                        style="display: none;"
                                    >
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="flex-1 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden max-w-[80px]">
                                            <div class="h-full bg-{{ ($note->confiance ?? 98) >= 90 ? 'green' : (($note->confiance ?? 98) >= 70 ? 'orange' : 'red') }}-500 rounded-full" style="width: {{ $note->confiance ?? 98 }}%"></div>
                                        </div>
                                        <span class="text-xs font-medium text-[#4c669a] w-10 text-right">{{ $note->confiance ?? 98 }}%</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if(($note->note_examen ?? 15.5) >= 10)
                                        <x-badge variant="success">Admis</x-badge>
                                    @else
                                        <x-badge variant="danger">Échec</x-badge>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button 
                                            type="button" 
                                            @click="editing = !editing"
                                            x-show="!editing"
                                            class="p-1.5 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 text-[#135bec] transition"
                                            title="Éditer"
                                        >
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </button>
                                        <div x-show="editing" class="flex gap-1" style="display: none;">
                                            <button 
                                                type="button" 
                                                @click="editing = false"
                                                class="p-1.5 rounded hover:bg-green-50 dark:hover:bg-green-900/20 text-green-600 transition"
                                                title="Valider"
                                            >
                                                <span class="material-symbols-outlined text-[18px]">check</span>
                                            </button>
                                            <button 
                                                type="button" 
                                                @click="editing = false"
                                                class="p-1.5 rounded hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 transition"
                                                title="Annuler"
                                            >
                                                <span class="material-symbols-outlined text-[18px]">close</span>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Sample Data --}}
                            @foreach([
                                ['matricule' => '2023-0001', 'nom' => 'ALAMI Ahmed', 'note' => 15.5, 'confiance' => 98],
                                ['matricule' => '2023-0002', 'nom' => 'BENALI Fatima', 'note' => 12.75, 'confiance' => 95],
                                ['matricule' => '2023-0003', 'nom' => 'CHAKIR Mohamed', 'note' => 8.5, 'confiance' => 72],
                                ['matricule' => '2023-0004', 'nom' => 'IDRISSI Sara', 'note' => 16.25, 'confiance' => 99],
                                ['matricule' => '2023-0005', 'nom' => 'MANSOURI Karim', 'note' => 14.0, 'confiance' => 96],
                                ['matricule' => '2023-0006', 'nom' => 'ZAHRA Amina', 'note' => 11.5, 'confiance' => 93],
                                ['matricule' => '2023-0007', 'nom' => 'HASSAN Omar', 'note' => 13.25, 'confiance' => 97],
                            ] as $i => $sample)
                                <tr 
                                    class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition {{ $sample['confiance'] < 80 ? 'bg-orange-50/50 dark:bg-orange-900/10' : '' }}"
                                    x-data="{ editing: false }"
                                >
                                    <td class="px-4 py-3">
                                        <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                                    </td>
                                    <td class="px-4 py-3 text-[#4c669a] dark:text-gray-400 font-medium">{{ $i + 1 }}</td>
                                    <td class="px-4 py-3">
                                        <span class="font-mono text-[#4c669a] dark:text-gray-400">{{ $sample['matricule'] }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div x-show="!editing">
                                            <p class="font-medium text-[#0d121b] dark:text-white">{{ $sample['nom'] }}</p>
                                        </div>
                                        <input 
                                            x-show="editing" 
                                            type="text" 
                                            value="{{ $sample['nom'] }}"
                                            class="w-full px-2 py-1 text-sm border border-[#135bec] rounded focus:ring-[#135bec]"
                                            style="display: none;"
                                        >
                                    </td>
                                    <td class="px-4 py-3">
                                        <div x-show="!editing" class="flex items-center gap-2">
                                            <span class="text-lg font-bold {{ $sample['note'] >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                                {{ number_format($sample['note'], 2) }}
                                            </span>
                                            @if($sample['confiance'] < 80)
                                                <span class="material-symbols-outlined text-orange-500 text-[16px]" title="Faible confiance">warning</span>
                                            @endif
                                        </div>
                                        <input 
                                            x-show="editing" 
                                            type="number" 
                                            step="0.25"
                                            min="0"
                                            max="20"
                                            value="{{ $sample['note'] }}"
                                            class="w-24 px-2 py-1 text-sm border border-[#135bec] rounded focus:ring-[#135bec]"
                                            style="display:  none;"
                                        >
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="flex-1 h-1.5 bg-gray-200 dark: bg-gray-700 rounded-full overflow-hidden max-w-[80px]">
                                                <div class="h-full bg-{{ $sample['confiance'] >= 90 ? 'green' : ($sample['confiance'] >= 70 ? 'orange' : 'red') }}-500 rounded-full" style="width: {{ $sample['confiance'] }}%"></div>
                                            </div>
                                            <span class="text-xs font-medium text-[#4c669a] w-10 text-right">{{ $sample['confiance'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($sample['note'] >= 10)
                                            <x-badge variant="success">Admis</x-badge>
                                        @else
                                            <x-badge variant="danger">Échec</x-badge>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <button 
                                                type="button" 
                                                @click="editing = ! editing"
                                                x-show="!editing"
                                                class="p-1.5 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 text-[#135bec] transition"
                                                title="Éditer"
                                            >
                                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                            </button>
                                            <div x-show="editing" class="flex gap-1" style="display: none;">
                                                <button 
                                                    type="button" 
                                                    @click="editing = false"
                                                    class="p-1.5 rounded hover:bg-green-50 dark:hover:bg-green-900/20 text-green-600 transition"
                                                    title="Valider"
                                                >
                                                    <span class="material-symbols-outlined text-[18px]">check</span>
                                                </button>
                                                <button 
                                                    type="button" 
                                                    @click="editing = false"
                                                    class="p-1.5 rounded hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 transition"
                                                    title="Annuler"
                                                >
                                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Table Footer --}}
            <div class="p-4 bg-[#f8f9fc] dark:bg-gray-800/50 border-t border-[#e7ebf3] dark:border-gray-800">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4 text-sm">
                        <span class="text-[#4c669a] dark:text-gray-400">
                            <span class="font-bold text-[#135bec]">0</span> ligne(s) sélectionnée(s)
                        </span>
                        <button class="text-[#135bec] hover:text-[#0f4bc4] font-medium">Tout sélectionner</button>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-1.5 text-sm font-medium text-[#4c669a] hover:text-[#135bec] rounded-lg hover:bg-white dark:hover:bg-gray-700 transition">
                            Exporter sélection
                        </button>
                        <button class="px-3 py-1.5 text-sm font-medium text-red-500 hover:text-red-600 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/10 transition">
                            Supprimer sélection
                        </button>
                    </div>
                </div>
            </div>
        </x-card>

        {{-- Comments Section --}}
        <x-card title="Commentaires et Remarques" icon="comment">
            <div class="space-y-4">
                <textarea 
                    rows="3" 
                    placeholder="Ajouter un commentaire ou une remarque pour l'enseignant..."
                    class="w-full rounded-lg border border-[#e7ebf3] dark:border-gray-700 bg-white dark:bg-[#1a2234] px-4 py-3 text-sm text-[#0d121b] dark:text-white placeholder-[#4c669a] focus:ring-2 focus:ring-[#135bec] focus:border-transparent"
                ></textarea>
                <div class="flex items-center justify-end">
                    <x-button variant="secondary" size="sm" icon="send">
                        Ajouter un commentaire
                    </x-button>
                </div>
            </div>
        </x-card>
    </div>
</div>

{{-- Floating Action Bar --}}
<div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-[#1a2234] border-t border-[#e7ebf3] dark:border-gray-800 shadow-2xl p-4 z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-4">
            <x-badge variant="warning" size="lg">En attente de validation</x-badge>
            <span class="text-sm text-[#4c669a] dark:text-gray-400">
                {{ $feuilleNote->notes_count ?? 35 }} notes • Moyenne: {{ $feuilleNote->moyenne ?? '13.45' }}/20
            </span>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="{{ route('validation.index') }}" class="px-4 py-2 text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                Annuler
            </a>
            
            <form action="{{ route('validation.rejeter', $feuilleNote) }}" method="POST" class="inline">
                @csrf
                <x-button type="submit" variant="danger" size="md" icon="cancel">
                    Rejeter
                </x-button>
            </form>
            
            <form action="{{ route('validation.valider', $feuilleNote) }}" method="POST" class="inline">
                @csrf
                <x-button type="submit" variant="success" size="md" icon="check_circle">
                    Valider & Finaliser
                </x-button>
            </form>
        </div>
    </div>
</div>

<div class="h-24"></div>

@endsection

@push('scripts')
<script>
    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        // Ctrl/Cmd + Enter pour valider
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            console.log('Quick validate');
            // Submit validation form (implement if desired)
        }
        
        // Escape pour annuler
        if (e.key === 'Escape') {
            window.location.href = '{{ route('validation.index') }}';
        }
    });
</script>
@endpush