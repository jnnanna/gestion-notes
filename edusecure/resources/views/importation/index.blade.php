@extends('layouts.app')

@section('title', 'Importation de Notes')
@section('page-title', 'Importation & Numérisation')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Importation', 'url' => route('importation.index')],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-4">
        <div class="size-12 rounded-xl bg-gradient-to-br from-[#135bec] to-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
            <span class="material-symbols-outlined text-2xl icon-filled">document_scanner</span>
        </div>
        <div>
            <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                Importation & Numérisation des Notes
            </h1>
            <p class="text-[#4c669a] dark:text-gray-400 mt-1">
                Importez vos feuilles de notes par scan ou upload de fichiers PDF
            </p>
        </div>
    </div>
</div>

{{-- Stepper --}}
<div class="mb-8">
    <div class="flex items-center justify-between max-w-3xl mx-auto">
        {{-- Étape 1 :  Active --}}
        <div class="flex items-center gap-3 flex-1">
            <div class="size-10 rounded-full bg-[#135bec] text-white flex items-center justify-center font-bold shadow-lg shadow-blue-500/30">
                1
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-bold text-[#135bec]">Upload</p>
                <p class="text-xs text-[#4c669a] dark:text-gray-400">Fichiers & Scan</p>
            </div>
        </div>
        <div class="h-0.5 flex-1 bg-gray-200 dark:bg-gray-700 mx-2"></div>
        
        {{-- Étape 2 : Inactive --}}
        <div class="flex items-center gap-3 flex-1">
            <div class="size-10 rounded-full bg-gray-200 dark:bg-gray-700 text-[#4c669a] flex items-center justify-center font-bold">
                2
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-medium text-[#4c669a] dark:text-gray-400">Catégorisation</p>
                <p class="text-xs text-[#4c669a] dark:text-gray-500">Module & Filière</p>
            </div>
        </div>
        <div class="h-0.5 flex-1 bg-gray-200 dark:bg-gray-700 mx-2"></div>
        
        {{-- Étape 3 :  Inactive --}}
        <div class="flex items-center gap-3 flex-1">
            <div class="size-10 rounded-full bg-gray-200 dark:bg-gray-700 text-[#4c669a] flex items-center justify-center font-bold">
                3
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-medium text-[#4c669a] dark:text-gray-400">Vérification</p>
                <p class="text-xs text-[#4c669a] dark:text-gray-500">OCR & Validation</p>
            </div>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Left Column :  Upload Zone (2/3) --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Quick Import Methods --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Scanner --}}
            <div class="group relative overflow-hidden rounded-xl border-2 border-dashed border-[#135bec] bg-gradient-to-br from-blue-50 to-white dark:from-blue-900/10 dark:to-[#1a2234] p-6 hover:border-[#0f4bc4] hover:shadow-xl transition-all cursor-pointer">
                <div class="absolute top-3 right-3">
                    <span class="material-symbols-outlined text-[#135bec] text-4xl opacity-10 group-hover:opacity-20 transition">scanner</span>
                </div>
                <div class="relative z-10">
                    <div class="size-14 rounded-xl bg-[#135bec] text-white flex items-center justify-center mb-4 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">scanner</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white mb-2">Scanner Direct</h3>
                    <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">
                        Numérisez directement depuis votre scanner connecté
                    </p>
                    <button class="text-sm font-medium text-[#135bec] hover:text-[#0f4bc4] flex items-center gap-1">
                        Lancer le scan
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>
            </div>

            {{-- Mobile App --}}
            <div class="group relative overflow-hidden rounded-xl border-2 border-dashed border-purple-500 bg-gradient-to-br from-purple-50 to-white dark:from-purple-900/10 dark:to-[#1a2234] p-6 hover:border-purple-600 hover:shadow-xl transition-all cursor-pointer">
                <div class="absolute top-3 right-3">
                    <span class="material-symbols-outlined text-purple-500 text-4xl opacity-10 group-hover:opacity-20 transition">phone_iphone</span>
                </div>
                <div class="relative z-10">
                    <div class="size-14 rounded-xl bg-purple-500 text-white flex items-center justify-center mb-4 shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">phone_iphone</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white mb-2">App Mobile</h3>
                    <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">
                        Photographiez les feuilles depuis votre smartphone
                    </p>
                    <div class="flex items-center gap-2">
                        <div class="size-6 rounded bg-black text-white flex items-center justify-center">
                            <span class="text-xs font-bold">QR</span>
                        </div>
                        <span class="text-xs text-[#4c669a] dark:text-gray-400">Scannez pour télécharger</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- File Upload Zone --}}
        <form action="{{ route('importation.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <x-card>
                <x-slot name="title">
                    <div class="flex items-center justify-between w-full">
                        <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">Upload de Fichiers</h3>
                        <x-badge variant="info">PDF, JPG, PNG acceptés</x-badge>
                    </div>
                </x-slot>

                <div class="space-y-6">
                    {{-- Drag & Drop Zone --}}
                    <div x-data="{ 
                        files: [], 
                        isDragging: false,
                        handleFiles(fileList) {
                            this.files = Array.from(fileList);
                        }
                    }">
                        <div 
                            @drop.prevent="isDragging = false; handleFiles($event.dataTransfer.files)"
                            @dragover.prevent="isDragging = true"
                            @dragleave.prevent="isDragging = false"
                            :class="isDragging ? 'border-[#135bec] bg-blue-50 dark:bg-blue-900/20' : 'border-[#e7ebf3] dark:border-gray-700'"
                            class="relative rounded-xl border-2 border-dashed transition-all duration-200"
                        >
                            <input 
                                type="file" 
                                name="files[]" 
                                multiple 
                                accept=".pdf,.jpg,.jpeg,.png"
                                @change="handleFiles($event.target.files)"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20"
                                id="file-upload"
                            />
                            
                            <div class="flex flex-col items-center justify-center gap-4 px-6 py-12">
                                <div class="size-20 rounded-full bg-gradient-to-br from-[#135bec] to-blue-600 flex items-center justify-center text-white shadow-xl shadow-blue-500/30">
                                    <span class="material-symbols-outlined text-4xl" x-show="!isDragging">cloud_upload</span>
                                    <span class="material-symbols-outlined text-4xl animate-bounce" x-show="isDragging" style="display: none;">download</span>
                                </div>
                                
                                <div class="text-center">
                                    <p class="text-lg font-bold text-[#0d121b] dark:text-white mb-1">
                                        <span x-show="files.length === 0">Glissez vos fichiers ici</span>
                                        <span x-show="files.length > 0" x-text="`${files.length} fichier(s) sélectionné(s)`" style="display: none;"></span>
                                    </p>
                                    <p class="text-sm text-[#4c669a] dark:text-gray-400">
                                        ou cliquez pour parcourir
                                    </p>
                                </div>

                                <div class="flex flex-wrap justify-center gap-2 mt-2">
                                    <span class="px-3 py-1 bg-white dark:bg-gray-800 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-xs text-[#4c669a] dark:text-gray-400 font-medium">PDF</span>
                                    <span class="px-3 py-1 bg-white dark:bg-gray-800 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-xs text-[#4c669a] dark:text-gray-400 font-medium">JPG</span>
                                    <span class="px-3 py-1 bg-white dark:bg-gray-800 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-xs text-[#4c669a] dark:text-gray-400 font-medium">PNG</span>
                                </div>

                                <p class="text-xs text-[#4c669a] dark:text-gray-500 mt-4">
                                    Taille maximale : 10 MB par fichier • Jusqu'à 50 fichiers
                                </p>
                            </div>
                        </div>

                        {{-- File List --}}
                        <div x-show="files.length > 0" class="mt-4 space-y-2" style="display: none;">
                            <p class="text-sm font-semibold text-[#0d121b] dark:text-white">Fichiers sélectionnés :</p>
                            <template x-for="(file, index) in files" :key="index">
                                <div class="flex items-center justify-between p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800 border border-[#e7ebf3] dark:border-gray-700">
                                    <div class="flex items-center gap-3 flex-1 min-w-0">
                                        <span class="material-symbols-outlined text-[#135bec]">description</span>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-[#0d121b] dark:text-white truncate" x-text="file.name"></p>
                                            <p class="text-xs text-[#4c669a] dark:text-gray-400" x-text="(file.size / 1024 / 1024).toFixed(2) + ' MB'"></p>
                                        </div>
                                    </div>
                                    <button 
                                        type="button"
                                        @click="files.splice(index, 1)"
                                        class="p-1.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 text-red-500 transition"
                                    >
                                        <span class="material-symbols-outlined text-[20px]">close</span>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Quick Info --}}
                    <div class="bg-blue-50 dark:bg-blue-900/10 rounded-lg p-4 border border-blue-100 dark:border-blue-900/20">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-blue-600 text-[20px] mt-0.5">info</span>
                            <div>
                                <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-1">Conseils pour un meilleur résultat OCR :</p>
                                <ul class="text-xs text-blue-700 dark:text-blue-400 space-y-1 list-disc list-inside">
                                    <li>Utilisez une résolution minimum de 300 DPI</li>
                                    <li>Assurez-vous que le texte est net et lisible</li>
                                    <li>Évitez les reflets et ombres sur le document</li>
                                    <li>Scannez en noir & blanc pour les textes simples</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between pt-4 border-t border-[#e7ebf3] dark:border-gray-800">
                        <button type="button" class="text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                            Annuler
                        </button>
                        <x-button type="submit" variant="primary" size="lg" icon="arrow_forward" iconPosition="right">
                            Continuer vers la catégorisation
                        </x-button>
                    </div>
                </div>
            </x-card>
        </form>
    </div>

    {{-- Right Column :  Info & Stats (1/3) --}}
    <div class="space-y-6">
        {{-- Quick Stats --}}
        <x-card title="Statistiques">
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800">
                    <div class="flex items-center gap-3">
                        <div class="size-10 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-600 flex items-center justify-center">
                            <span class="material-symbols-outlined">check_circle</span>
                        </div>
                        <div>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">Aujourd'hui</p>
                            <p class="text-lg font-bold text-[#0d121b] dark:text-white">24</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800">
                    <div class="flex items-center gap-3">
                        <div class="size-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-[#135bec] flex items-center justify-center">
                            <span class="material-symbols-outlined">pending_actions</span>
                        </div>
                        <div>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">En traitement</p>
                            <p class="text-lg font-bold text-[#0d121b] dark:text-white">3</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800">
                    <div class="flex items-center gap-3">
                        <div class="size-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-600 flex items-center justify-center">
                            <span class="material-symbols-outlined">history</span>
                        </div>
                        <div>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">Ce mois</p>
                            <p class="text-lg font-bold text-[#0d121b] dark:text-white">189</p>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>

        {{-- Recent Imports --}}
        <x-card title="Importations Récentes">
            <div class="space-y-3">
                @foreach([
                    ['module' => 'Algorithmique', 'time' => 'Il y a 2h', 'status' => 'success'],
                    ['module' => 'Bases de Données', 'time' => 'Il y a 5h', 'status' => 'success'],
                    ['module' => 'Réseaux', 'time' => 'Hier', 'status' => 'warning'],
                ] as $import)
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition cursor-pointer">
                        <div class="size-8 rounded bg-{{ $import['status'] === 'success' ? 'green' : 'orange' }}-100 dark:bg-{{ $import['status'] === 'success' ? 'green' :  'orange' }}-900/30 text-{{ $import['status'] === 'success' ?  'green' : 'orange' }}-600 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-[18px]">{{ $import['status'] === 'success' ? 'check' : 'pending' }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-[#0d121b] dark:text-white truncate">{{ $import['module'] }}</p>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $import['time'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-card>

        {{-- Help Card --}}
        <div class="rounded-xl bg-gradient-to-br from-[#135bec] to-blue-600 p-6 text-white">
            <div class="flex items-start gap-3 mb-4">
                <span class="material-symbols-outlined text-3xl">help</span>
                <div>
                    <h4 class="font-bold text-lg mb-1">Besoin d'aide ?</h4>
                    <p class="text-sm text-blue-100">Consultez notre guide d'utilisation</p>
                </div>
            </div>
            <button class="w-full py-2 bg-white/20 hover:bg-white/30 rounded-lg text-sm font-medium transition">
                Ouvrir le guide
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    console.log('Importation page loaded');
</script>
@endpush