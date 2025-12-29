@extends('layouts.app')

@section('title', 'Aperçu du Document')
@section('page-title', 'Aperçu du Document')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Exportation', 'url' => route('exportation.index')],
        ['label' => 'Aperçu', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button onclick="window.close()" class="size-10 rounded-lg border border-[#e7ebf3] dark:border-gray-700 flex items-center justify-center text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-2xl font-black text-[#0d121b] dark:text-white">
                        Aperçu du Document
                    </h1>
                    <x-badge variant="info">{{ $export->type_document->label() ??  'Relevé de Notes' }}</x-badge>
                </div>
                <div class="flex items-center gap-4 text-sm text-[#4c669a] dark:text-gray-400">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">school</span>
                        {{ $export->parametres['filiere'] ?? 'Génie Logiciel - L3' }}
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                        {{ $export->parametres['annee'] ?? '2023-2024' }}
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">description</span>
                        Format: {{ strtoupper($export->format->value ??  'PDF') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            {{-- View Options --}}
            <div class="flex items-center bg-white dark:bg-[#1a2234] rounded-lg border border-[#e7ebf3] dark:border-gray-700 p-1" x-data="{ zoom: 100 }">
                <button 
                    @click="zoom = Math.max(50, zoom - 10)"
                    class="p-2 rounded hover:bg-[#f8f9fc] dark:hover:bg-gray-800 text-[#4c669a] transition"
                    title="Zoom arrière"
                >
                    <span class="material-symbols-outlined text-[20px]">zoom_out</span>
                </button>
                <span class="px-3 text-sm font-medium text-[#0d121b] dark:text-white min-w-[60px] text-center" x-text="zoom + '%'">100%</span>
                <button 
                    @click="zoom = Math.min(200, zoom + 10)"
                    class="p-2 rounded hover:bg-[#f8f9fc] dark:hover:bg-gray-800 text-[#4c669a] transition"
                    title="Zoom avant"
                >
                    <span class="material-symbols-outlined text-[20px]">zoom_in</span>
                </button>
                <div class="h-6 w-px bg-[#e7ebf3] dark:bg-gray-700 mx-2"></div>
                <button 
                    class="p-2 rounded hover:bg-[#f8f9fc] dark:hover:bg-gray-800 text-[#4c669a] transition"
                    title="Plein écran"
                    onclick="document.getElementById('preview-container').requestFullscreen()"
                >
                    <span class="material-symbols-outlined text-[20px]">fullscreen</span>
                </button>
            </div>

            {{-- Actions --}}
            <form action="{{ route('exportation.generer') }}" method="POST" class="inline">
                @csrf
                <x-button type="submit" variant="primary" size="md" icon="download">
                    Télécharger
                </x-button>
            </form>
        </div>
    </div>
</div>

{{-- Preview Container --}}
<div id="preview-container" class="bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm overflow-hidden">
    <div class="p-8 bg-gray-100 dark:bg-gray-900 min-h-screen flex items-start justify-center">
        {{-- Document Preview --}}
        <div class="w-full max-w-4xl bg-white shadow-2xl" style="aspect-ratio: 210/297;">
            {{-- Sample Document Content --}}
            <div class="p-12 h-full flex flex-col">
                {{-- Header --}}
                <div class="text-center mb-8 border-b-2 border-gray-800 pb-6">
                    <div class="flex items-center justify-between mb-4">
                        <img src="https://placehold.co/120x60/135bec/ffffff?text=LOGO" alt="Logo" class="h-16">
                        <div class="text-right">
                            <p class="text-xs text-gray-600">Année Académique</p>
                            <p class="font-bold text-lg">2023-2024</p>
                        </div>
                    </div>
                    <h1 class="text-3xl font-black text-gray-900 mb-2">RELEVÉ DE NOTES</h1>
                    <p class="text-sm text-gray-600 uppercase tracking-wider">Document Officiel</p>
                </div>

                {{-- Student Info --}}
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Étudiant</p>
                        <p class="font-bold text-gray-900">ALAMI Ahmed</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Matricule</p>
                        <p class="font-bold text-gray-900">2023-0001</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Filière</p>
                        <p class="font-bold text-gray-900">Génie Logiciel - Licence 3</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Semestre</p>
                        <p class="font-bold text-gray-900">S5</p>
                    </div>
                </div>

                {{-- Notes Table --}}
                <div class="flex-1 mb-8">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-gray-800 text-white">
                                <th class="border border-gray-700 px-3 py-2 text-left">Module</th>
                                <th class="border border-gray-700 px-3 py-2 text-center w-20">Coef.</th>
                                <th class="border border-gray-700 px-3 py-2 text-center w-24">Note/20</th>
                                <th class="border border-gray-700 px-3 py-2 text-center w-32">Mention</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach([
                                ['module' => 'Algorithmique Avancée', 'coef' => 4, 'note' => 15.50, 'mention' => 'Bien'],
                                ['module' => 'Bases de Données', 'coef' => 4, 'note' => 14.25, 'mention' => 'Bien'],
                                ['module' => 'Génie Logiciel', 'coef' => 3, 'note' => 16.00, 'mention' => 'Très Bien'],
                                ['module' => 'Développement Web', 'coef' => 3, 'note' => 13.75, 'mention' => 'Assez Bien'],
                                ['module' => 'Probabilités', 'coef' => 2, 'note' => 12.50, 'mention' => 'Assez Bien'],
                                ['module' => 'Anglais Technique', 'coef' => 2, 'note' => 14.00, 'mention' => 'Bien'],
                            ] as $row)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-3 py-2">{{ $row['module'] }}</td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">{{ $row['coef'] }}</td>
                                    <td class="border border-gray-300 px-3 py-2 text-center font-bold">{{ number_format($row['note'], 2) }}</td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">{{ $row['mention'] }}</td>
                                </tr>
                            @endforeach
                            <tr class="bg-gray-100 font-bold">
                                <td class="border border-gray-300 px-3 py-2" colspan="2">MOYENNE GÉNÉRALE</td>
                                <td class="border border-gray-300 px-3 py-2 text-center text-lg text-green-600">14.42</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">Bien</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Footer --}}
                <div class="mt-auto">
                    <div class="grid grid-cols-2 gap-8 mb-6">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Décision du jury</p>
                            <p class="font-bold text-green-600">ADMIS</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Crédits obtenus</p>
                            <p class="font-bold">30 ECTS</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 text-center border-t-2 border-gray-300 pt-6">
                        <div>
                            <p class="text-xs text-gray-500 mb-3">Le Directeur des Études</p>
                            <div class="h-16 border-b border-gray-400"></div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-3">Cachet de l'Établissement</p>
                            <div class="h-16 flex items-center justify-center">
                                <div class="size-16 rounded-full border-2 border-gray-400 flex items-center justify-center">
                                    <span class="text-xs text-gray-400">CACHET</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-3">Le Chef de Département</p>
                            <div class="h-16 border-b border-gray-400"></div>
                        </div>
                    </div>

                    <div class="text-center mt-6">
                        <p class="text-xs text-gray-500">
                            Document généré le {{ now()->format('d/m/Y à H:i') }} • 
                            Code vérification: {{ strtoupper(Str::random(8)) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Info Panel (Floating) --}}
<div class="fixed bottom-6 right-6 bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-2xl p-4 max-w-sm" x-data="{ open: true }" x-show="open" x-transition>
    <div class="flex items-start justify-between mb-3">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-blue-600">info</span>
            <h3 class="font-bold text-[#0d121b] dark:text-white">Informations</h3>
        </div>
        <button @click="open = false" class="text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>
    <div class="space-y-2 text-sm">
        <div class="flex justify-between">
            <span class="text-[#4c669a]">Type</span>
            <span class="font-medium text-[#0d121b] dark:text-white">Relevé de Notes</span>
        </div>
        <div class="flex justify-between">
            <span class="text-[#4c669a]">Format</span>
            <span class="font-medium text-[#0d121b] dark:text-white">PDF A4</span>
        </div>
        <div class="flex justify-between">
            <span class="text-[#4c669a]">Pages</span>
            <span class="font-medium text-[#0d121b] dark:text-white">1</span>
        </div>
        <div class="flex justify-between">
            <span class="text-[#4c669a]">Taille estimée</span>
            <span class="font-medium text-[#0d121b] dark:text-white">~180 KB</span>
        </div>
    </div>
    <div class="mt-4 pt-4 border-t border-[#e7ebf3] dark:border-gray-700">
        <p class="text-xs text-[#4c669a] dark:text-gray-400">
            <span class="material-symbols-outlined text-[14px] inline align-middle">info</span>
            Ceci est un aperçu. Le document final peut légèrement différer. 
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        // Escape pour fermer
        if (e.key === 'Escape') {
            window.close();
        }
        
        // Ctrl/Cmd + P pour imprimer
        if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            window.print();
        }
    });

    // Print styles
    window.matchMedia('print').addListener((mql) => {
        if (mql.matches) {
            document.querySelector('#preview-container').style.padding = '0';
        }
    });
</script>
@endpush

@push('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #preview-container, #preview-container * {
            visibility: visible;
        }
        #preview-container {
            position: absolute;
            left: 0;
            top: 0;
            padding: 0 !important;
            background: white !important;
        }
    }
</style>
@endpush