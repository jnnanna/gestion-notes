@extends('layouts.app')

@section('title', 'Importer des Étudiants')
@section('page-title', 'Import d\'Étudiants')

@section('content')
    @php
        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => route('dashboard')],
            ['label' => 'Étudiants', 'url' => route('etudiants.index')],
            ['label' => 'Import', 'url' => ''],
        ];
    @endphp

    {{-- Page Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('etudiants.index') }}"
                class="size-10 rounded-lg border border-[#e7ebf3] dark:border-gray-700 flex items-center justify-center text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                    Importer des Étudiants
                </h1>
                <p class="text-[#4c669a] dark:text-gray-400 mt-1">
                    Importez plusieurs étudiants via fichier CSV ou Excel
                </p>
            </div>
        </div>
    </div>

    {{-- Stepper --}}
    <div class="mb-8">
        <div class="flex items-center justify-between max-w-3xl mx-auto">
            <div class="flex items-center gap-3 flex-1">
                <div
                    class="size-10 rounded-full bg-[#135bec] text-white flex items-center justify-center font-bold shadow-lg shadow-blue-500/30">
                    1
                </div>
                <div class="hidden sm:block">
                    <p class="text-sm font-bold text-[#135bec]">Upload</p>
                    <p class="text-xs text-[#4c669a] dark:text-gray-400">Fichier</p>
                </div>
            </div>
            <div class="h-0.5 flex-1 bg-gray-200 dark:bg-gray-700 mx-2"></div>

            <div class="flex items-center gap-3 flex-1">
                <div
                    class="size-10 rounded-full bg-gray-200 dark:bg-gray-700 text-[#4c669a] flex items-center justify-center font-bold">
                    2
                </div>
                <div class="hidden sm:block">
                    <p class="text-sm font-medium text-[#4c669a] dark:text-gray-400">Vérification</p>
                    <p class="text-xs text-[#4c669a] dark:text-gray-500">Données</p>
                </div>
            </div>
            <div class="h-0.5 flex-1 bg-gray-200 dark:bg-gray-700 mx-2"></div>

            <div class="flex items-center gap-3 flex-1">
                <div
                    class="size-10 rounded-full bg-gray-200 dark:bg-gray-700 text-[#4c669a] flex items-center justify-center font-bold">
                    3
                </div>
                <div class="hidden sm:block">
                    <p class="text-sm font-medium text-[#4c669a] dark:text-gray-400">Confirmation</p>
                    <p class="text-xs text-[#4c669a] dark:text-gray-500">Import</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left: Upload Form (2/3) --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Template Download --}}
            <x-card title="1. Téléchargez le Modèle" icon="download">
                <div class="grid grid-cols-2 gap-4">
                    <a href="/templates/import-etudiants.xlsx"
                        class="group p-6 rounded-xl border-2 border-dashed border-green-500 hover:border-green-600 hover:bg-green-50 dark:hover:bg-green-900/10 transition cursor-pointer">
                        <div class="flex flex-col items-center text-center">
                            <div
                                class="size-16 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-green-600 text-3xl">table_chart</span>
                            </div>
                            <h3 class="font-bold text-[#0d121b] dark:text-white mb-1">Modèle Excel</h3>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-3">Format .xlsx</p>
                            <span class="text-sm font-medium text-green-600 group-hover:text-green-700">Télécharger</span>
                        </div>
                    </a>

                    <a href="/templates/import-etudiants.csv"
                        class="group p-6 rounded-xl border-2 border-dashed border-blue-500 hover:border-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/10 transition cursor-pointer">
                        <div class="flex flex-col items-center text-center">
                            <div
                                class="size-16 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[#135bec] text-3xl">text_snippet</span>
                            </div>
                            <h3 class="font-bold text-[#0d121b] dark:text-white mb-1">Modèle CSV</h3>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-3">Format .csv</p>
                            <span class="text-sm font-medium text-[#135bec] group-hover:text-[#0f4bc4]">Télécharger</span>
                        </div>
                    </a>
                </div>
            </x-card>

            {{-- File Upload --}}
            <form action="{{ route('etudiants.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-card title="2. Importez votre Fichier" icon="cloud_upload">
                    <div class="space-y-6">
                        {{-- Drag & Drop --}}
                        <div x-data="{ 
                            file: null,
                            isDragging: false,
                            handleFile(fileList) {
                                this.file = fileList[0];
                            }
                        }">
                            <div @drop.prevent="isDragging = false; handleFile($event.dataTransfer.files)"
                                @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                                :class="isDragging ? 'border-[#135bec] bg-blue-50 dark:bg-blue-900/20' : 'border-[#e7ebf3] dark:border-gray-700'"
                                class="relative rounded-xl border-2 border-dashed transition-all">
                                <input type="file" name="file" accept=".csv,.xlsx,.xls"
                                    @change="handleFile($event.target.files)"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" required />

                                <div class="flex flex-col items-center justify-center gap-4 px-6 py-12">
                                    <div
                                        class="size-20 rounded-full bg-gradient-to-br from-[#135bec] to-blue-600 flex items-center justify-center text-white shadow-xl shadow-blue-500/30">
                                        <span class="material-symbols-outlined text-4xl"
                                            x-show="!isDragging">cloud_upload</span>
                                        <span class="material-symbols-outlined text-4xl animate-bounce" x-show="isDragging"
                                            style="display: none;">download</span>
                                    </div>

                                    <div class="text-center">
                                        <p class="text-lg font-bold text-[#0d121b] dark:text-white mb-1">
                                            <span x-show="!file">Glissez votre fichier ici</span>
                                            <span x-show="file" x-text="file?.name" style="display: none;"></span>
                                        </p>
                                        <p class="text-sm text-[#4c669a] dark:text-gray-400">
                                            ou cliquez pour parcourir
                                        </p>
                                    </div>

                                    <div class="flex gap-2">
                                        <span
                                            class="px-3 py-1 bg-white dark:bg-gray-800 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-xs font-medium">CSV</span>
                                        <span
                                            class="px-3 py-1 bg-white dark:bg-gray-800 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-xs font-medium">XLSX</span>
                                        <span
                                            class="px-3 py-1 bg-white dark:bg-gray-800 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-xs font-medium">XLS</span>
                                    </div>

                                    <p class="text-xs text-[#4c669a] dark:text-gray-500 mt-2">
                                        Taille max : 5 MB
                                    </p>
                                </div>
                            </div>

                            {{-- File Info --}}
                            <div x-show="file"
                                class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/10 rounded-lg border border-blue-100 dark:border-blue-900/20"
                                style="display: none;">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-blue-600">check_circle</span>
                                    <div class="flex-1">
                                        <p class="font-medium text-blue-900 dark:text-blue-300" x-text="file?.name"></p>
                                        <p class="text-xs text-blue-700 dark:text-blue-400"
                                            x-text="file ?  (file.size / 1024).toFixed(2) + ' KB' : ''"></p>
                                    </div>
                                    <button type="button" @click="file = null" class="text-blue-600 hover:text-blue-700">
                                        <span class="material-symbols-outlined">close</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Options --}}
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800">
                                <input type="checkbox" name="options[skip_first_row]" id="skip_first_row"
                                    class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" checked>
                                <label for="skip_first_row"
                                    class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                                    Ignorer la première ligne (en-têtes)
                                </label>
                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800">
                                <input type="checkbox" name="options[update_existing]" id="update_existing"
                                    class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                                <label for="update_existing"
                                    class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                                    Mettre à jour les étudiants existants
                                </label>
                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800">
                                <input type="checkbox" name="options[send_notifications]" id="send_notifications"
                                    class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                                <label for="send_notifications"
                                    class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                                    Envoyer des emails de bienvenue
                                </label>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="flex items-center justify-between pt-4 border-t border-[#e7ebf3] dark:border-gray-800">
                            <a href="{{ route('etudiants.index') }}"
                                class="text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                                Annuler
                            </a>
                            <x-button type="submit" variant="primary" size="lg" icon="upload">
                                Lancer l'Import
                            </x-button>
                        </div>
                    </div>
                </x-card>
            </form>
        </div>

        {{-- Right: Instructions (1/3) --}}
        <div class="space-y-6">
            {{-- Format Required --}}
            <x-card title="Format Requis" icon="info">
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="font-semibold text-[#0d121b] dark:text-white mb-1">Colonnes obligatoires :</p>
                        <ul class="space-y-1 text-[#4c669a] dark:text-gray-400 list-disc list-inside">
                            <li>Matricule</li>
                            <li>Nom</li>
                            <li>Prénom</li>
                            <li>Email</li>
                            <li>Filière (code ou nom)</li>
                        </ul>
                    </div>

                    <div>
                        <p class="font-semibold text-[#0d121b] dark:text-white mb-1">Colonnes optionnelles :</p>
                        <ul class="space-y-1 text-[#4c669a] dark:text-gray-400 list-disc list-inside">
                            <li>Téléphone</li>
                            <li>Niveau</li>
                            <li>Groupe</li>
                            <li>Date de naissance</li>
                        </ul>
                    </div>
                </div>
            </x-card>

            {{-- Example --}}
            <x-card title="Exemple" icon="preview">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs border border-[#e7ebf3] dark:border-gray-700">
                        <thead class="bg-[#f8f9fc] dark:bg-gray-800">
                            <tr>
                                <th class="border border-[#e7ebf3] dark:border-gray-700 px-2 py-1 text-left">Matricule</th>
                                <th class="border border-[#e7ebf3] dark:border-gray-700 px-2 py-1 text-left">Nom</th>
                                <th class="border border-[#e7ebf3] dark:border-gray-700 px-2 py-1 text-left">Prénom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-[#e7ebf3] dark:border-gray-700 px-2 py-1">2024-0001</td>
                                <td class="border border-[#e7ebf3] dark:border-gray-700 px-2 py-1">ALAMI</td>
                                <td class="border border-[#e7ebf3] dark:border-gray-700 px-2 py-1">Ahmed</td>
                            </tr>
                            <tr>
                                <td class="border border-[#e7ebf3] dark:border-gray-700 px-2 py-1">2024-0002</td>
                                <td class="border border-[#e7ebf3] dark:border-gray-700 px-2 py-1">BENALI</td>
                                <td class="border border-[#e7ebf3] dark:border-gray-700 px-2 py-1">Fatima</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </x-card>

            {{-- Tips --}}
            <div
                class="bg-orange-50 dark:bg-orange-900/10 rounded-xl p-4 border border-orange-100 dark:border-orange-900/20">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-orange-600 text-[20px] mt-0.5">tips_and_updates</span>
                    <div>
                        <p class="text-sm font-semibold text-orange-900 dark:text-orange-300 mb-2">Conseils :</p>
                        <ul class="text-xs text-orange-700 dark:text-orange-400 space-y-1 list-disc list-inside">
                            <li>Vérifiez le format avant d'importer</li>
                            <li>Les matricules doivent être uniques</li>
                            <li>Les emails doivent être valides</li>
                            <li>Utilisez le modèle fourni</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection