@extends('layouts.app')

@section('title', 'Exportation & Rapports')
@section('page-title', 'Exportation & Rapports')

@section('content')
    @php
        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => route('dashboard')],
            ['label' => 'Exportation', 'url' => route('exportation. index')],
        ];
    @endphp

    {{-- Page Header --}}
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="max-w-2xl">
                <div class="flex items-center gap-3 mb-3">
                    <div
                        class="size-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-purple-500/20">
                        <span class="material-symbols-outlined text-2xl icon-filled">file_download</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark: text-white">
                            Exportation & Rapports
                        </h1>
                    </div>
                </div>
                <p class="text-[#4c669a] dark: text-gray-400 text-lg leading-relaxed">
                    Générez et téléchargez vos documents : relevés de notes, PV, bulletins, listes...
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('exportation.historique') }}"
                    class="px-4 py-2 rounded-lg border border-[#e7ebf3] dark:border-gray-700 text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">history</span>
                    Historique
                </a>
            </div>
        </div>
    </div>

    {{-- Quick Templates --}}
    <div class="mb-8">
        <h2 class="text-lg font-bold text-[#0d121b] dark:text-white mb-4">Modèles Rapides</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Template 1: Relevé de Notes --}}
            <div
                class="group relative overflow-hidden rounded-xl border-2 border-dashed border-[#135bec] bg-gradient-to-br from-blue-50 to-white dark:from-blue-900/10 dark:to-[#1a2234] p-6 hover:border-[#0f4bc4] hover:shadow-xl transition-all cursor-pointer">
                <div class="absolute top-3 right-3 opacity-10 group-hover:opacity-20 transition">
                    <span class="material-symbols-outlined text-[#135bec] text-5xl">description</span>
                </div>
                <div class="relative z-10">
                    <div
                        class="size-12 rounded-xl bg-[#135bec] text-white flex items-center justify-center mb-4 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">description</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white mb-2">Relevé de Notes</h3>
                    <p class="text-sm text-[#4c669a] dark: text-gray-400 mb-4">
                        Document officiel avec notes et moyennes
                    </p>
                    <button onclick="loadTemplate('releve')"
                        class="text-sm font-medium text-[#135bec] hover:text-[#0f4bc4] flex items-center gap-1">
                        Utiliser ce modèle
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>
            </div>

            {{-- Template 2: PV --}}
            <div
                class="group relative overflow-hidden rounded-xl border-2 border-dashed border-green-500 bg-gradient-to-br from-green-50 to-white dark:from-green-900/10 dark:to-[#1a2234] p-6 hover:border-green-600 hover:shadow-xl transition-all cursor-pointer">
                <div class="absolute top-3 right-3 opacity-10 group-hover:opacity-20 transition">
                    <span class="material-symbols-outlined text-green-500 text-5xl">gavel</span>
                </div>
                <div class="relative z-10">
                    <div
                        class="size-12 rounded-xl bg-green-500 text-white flex items-center justify-center mb-4 shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">gavel</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#0d121b] dark: text-white mb-2">Procès-Verbal</h3>
                    <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">
                        PV de délibération officiel
                    </p>
                    <button onclick="loadTemplate('pv')"
                        class="text-sm font-medium text-green-600 hover:text-green-700 flex items-center gap-1">
                        Utiliser ce modèle
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>
            </div>

            {{-- Template 3: Bulletin --}}
            <div
                class="group relative overflow-hidden rounded-xl border-2 border-dashed border-purple-500 bg-gradient-to-br from-purple-50 to-white dark:from-purple-900/10 dark:to-[#1a2234] p-6 hover:border-purple-600 hover:shadow-xl transition-all cursor-pointer">
                <div class="absolute top-3 right-3 opacity-10 group-hover:opacity-20 transition">
                    <span class="material-symbols-outlined text-purple-500 text-5xl">article</span>
                </div>
                <div class="relative z-10">
                    <div
                        class="size-12 rounded-xl bg-purple-500 text-white flex items-center justify-center mb-4 shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">article</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white mb-2">Bulletin</h3>
                    <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">
                        Bulletin individuel étudiant
                    </p>
                    <button onclick="loadTemplate('bulletin')"
                        class="text-sm font-medium text-purple-600 hover:text-purple-700 flex items-center gap-1">
                        Utiliser ce modèle
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>
            </div>

            {{-- Template 4: Liste --}}
            <div
                class="group relative overflow-hidden rounded-xl border-2 border-dashed border-orange-500 bg-gradient-to-br from-orange-50 to-white dark:from-orange-900/10 dark:to-[#1a2234] p-6 hover:border-orange-600 hover:shadow-xl transition-all cursor-pointer">
                <div class="absolute top-3 right-3 opacity-10 group-hover:opacity-20 transition">
                    <span class="material-symbols-outlined text-orange-500 text-5xl">format_list_bulleted</span>
                </div>
                <div class="relative z-10">
                    <div
                        class="size-12 rounded-xl bg-orange-500 text-white flex items-center justify-center mb-4 shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">format_list_bulleted</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white mb-2">Liste Étudiants</h3>
                    <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">
                        Liste de classe avec notes
                    </p>
                    <button onclick="loadTemplate('liste')"
                        class="text-sm font-medium text-orange-600 hover:text-orange-700 flex items-center gap-1">
                        Utiliser ce modèle
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Form --}}
    <form action="{{ route('exportation.generer') }}" method="POST" x-data="exportForm()">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column: Configuration Form (2/3) --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Document Type --}}
                <x-card title="Type de Document" icon="description">
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative">
                            <input type="radio" name="type_document" value="releve" x-model="form.type_document"
                                class="peer sr-only">
                            <div
                                class="p-4 rounded-lg border-2 border-[#e7ebf3] dark:border-gray-700 cursor-pointer transition peer-checked:border-[#135bec] peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/10 hover:border-[#135bec]/50">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-[#135bec]">description</span>
                                    <span class="font-bold text-[#0d121b] dark:text-white">Relevé de Notes</span>
                                </div>
                                <p class="text-xs text-[#4c669a] dark:text-gray-400">Document officiel avec cachet</p>
                            </div>
                        </label>

                        <label class="relative">
                            <input type="radio" name="type_document" value="pv" x-model="form.type_document"
                                class="peer sr-only">
                            <div
                                class="p-4 rounded-lg border-2 border-[#e7ebf3] dark:border-gray-700 cursor-pointer transition peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/10 hover:border-green-500/50">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-green-600">gavel</span>
                                    <span class="font-bold text-[#0d121b] dark: text-white">Procès-Verbal</span>
                                </div>
                                <p class="text-xs text-[#4c669a] dark: text-gray-400">PV de délibération</p>
                            </div>
                        </label>

                        <label class="relative">
                            <input type="radio" name="type_document" value="bulletin" x-model="form. type_document"
                                class="peer sr-only">
                            <div
                                class="p-4 rounded-lg border-2 border-[#e7ebf3] dark:border-gray-700 cursor-pointer transition peer-checked:border-purple-500 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-900/10 hover:border-purple-500/50">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-purple-600">article</span>
                                    <span class="font-bold text-[#0d121b] dark:text-white">Bulletin</span>
                                </div>
                                <p class="text-xs text-[#4c669a] dark:text-gray-400">Bulletin individuel</p>
                            </div>
                        </label>

                        <label class="relative">
                            <input type="radio" name="type_document" value="liste" x-model="form. type_document"
                                class="peer sr-only">
                            <div
                                class="p-4 rounded-lg border-2 border-[#e7ebf3] dark:border-gray-700 cursor-pointer transition peer-checked:border-orange-500 peer-checked:bg-orange-50 dark:peer-checked:bg-orange-900/10 hover:border-orange-500/50">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-orange-600">format_list_bulleted</span>
                                    <span class="font-bold text-[#0d121b] dark:text-white">Liste Étudiants</span>
                                </div>
                                <p class="text-xs text-[#4c669a] dark:text-gray-400">Liste de classe</p>
                            </div>
                        </label>

                        <label class="relative">
                            <input type="radio" name="type_document" value="donnees_brutes" x-model="form. type_document"
                                class="peer sr-only">
                            <div
                                class="p-4 rounded-lg border-2 border-[#e7ebf3] dark:border-gray-700 cursor-pointer transition peer-checked:border-[#135bec] peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/10 hover:border-[#135bec]/50">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-[#135bec]">table_chart</span>
                                    <span class="font-bold text-[#0d121b] dark: text-white">Données Brutes</span>
                                </div>
                                <p class="text-xs text-[#4c669a] dark:text-gray-400">Export Excel/CSV</p>
                            </div>
                        </label>
                    </div>
                </x-card>

                {{-- Filters --}}
                <x-card title="Critères de Sélection" icon="filter_list">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-select name="annee_academique_id" label="Année Académique" required : options="[
                                    1 => '2023-2024',
                                    2 => '2024-2025',
                                ]" x-model="form.annee_academique_id" />

                            <x-select name="semestre_id" label="Semestre" : options="[
                                    '' => 'Tous les semestres',
                                    1 => 'S1',
                                    2 => 'S2',
                                    3 => 'S3',
                                    4 => 'S4',
                                    5 => 'S5',
                                    6 => 'S6',
                                ]" x-model="form.semestre_id" />
                        </div>

                        <div class="grid grid-cols-1 md: grid-cols-2 gap-4">
                            <x-select name="filiere_id" label="Filière" : options="[
                                    '' => 'Toutes les filières',
                                    1 => 'Génie Logiciel',
                                    2 => 'Big Data & IA',
                                    3 => 'Réseaux & Télécoms',
                                ]" x-model="form.filiere_id" />

                            <x-select name="module_id" label="Module" x-show="form.type_document !== 'bulletin'" :options="[
            '' => 'Tous les modules',
            1 => 'Algorithmique',
            2 => 'Bases de Données',
            3 => 'Développement Web',
        ]" x-model="form.module_id" />
                        </div>

                        {{-- Student Selection (for Bulletin) --}}
                        <div x-show="form.type_document === 'bulletin'" style="display: none;">
                            <x-select name="etudiant_id" label="Étudiant" : options="[
                                    '' => 'Sélectionner un étudiant.. .',
                                    1 => 'ALAMI Ahmed (2023-0001)',
                                    2 => 'BENALI Fatima (2023-0002)',
                                    3 => 'CHAKIR Mohamed (2023-0003)',
                                ]" />
                        </div>

                        {{-- Date Range --}}
                        <div class="grid grid-cols-2 gap-4">
                            <x-input type="date" name="date_debut" label="Date début" icon="calendar_today" />

                            <x-input type="date" name="date_fin" label="Date fin" icon="calendar_today" />
                        </div>
                    </div>
                </x-card>

                {{-- Format & Options --}}
                <x-card title="Format & Options" icon="settings">
                    <div class="space-y-4">
                        {{-- Format --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#0d121b] dark:text-white mb-3">Format
                                d'export</label>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="relative">
                                    <input type="radio" name="format" value="pdf" x-model="form.format" class="peer sr-only"
                                        checked>
                                    <div
                                        class="p-3 rounded-lg border-2 border-[#e7ebf3] dark:border-gray-700 cursor-pointer transition peer-checked:border-red-500 peer-checked:bg-red-50 dark:peer-checked:bg-red-900/10 hover:border-red-500/50">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-red-600">picture_as_pdf</span>
                                            <span class="font-bold text-[#0d121b] dark:text-white">PDF</span>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative">
                                    <input type="radio" name="format" value="excel" x-model="form.format"
                                        class="peer sr-only">
                                    <div
                                        class="p-3 rounded-lg border-2 border-[#e7ebf3] dark:border-gray-700 cursor-pointer transition peer-checked:border-green-600 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/10 hover:border-green-600/50">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-green-600">table_chart</span>
                                            <span class="font-bold text-[#0d121b] dark:text-white">Excel</span>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative">
                                    <input type="radio" name="format" value="csv" x-model="form.format"
                                        class="peer sr-only">
                                    <div
                                        class="p-3 rounded-lg border-2 border-[#e7ebf3] dark:border-gray-700 cursor-pointer transition peer-checked:border-blue-500 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/10 hover:border-blue-500/50">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-[#135bec]">text_snippet</span>
                                            <span class="font-bold text-[#0d121b] dark:text-white">CSV</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- PDF Options --}}
                        <div x-show="form.format === 'pdf'" class="space-y-3">
                            <div class="flex items-center gap-3 p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800">
                                <input type="checkbox" name="options[avec_logo]" id="avec_logo"
                                    class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" checked>
                                <label for="avec_logo"
                                    class="flex-1 text-sm font-medium text-[#0d121b] dark: text-white cursor-pointer">
                                    Inclure le logo de l'établissement
                                </label>
                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800">
                                <input type="checkbox" name="options[avec_cachet]" id="avec_cachet"
                                    class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" checked>
                                <label for="avec_cachet"
                                    class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                                    Ajouter cachet et signature
                                </label>
                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800">
                                <input type="checkbox" name="options[avec_statistiques]" id="avec_statistiques"
                                    class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                                <label for="avec_statistiques"
                                    class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                                    Inclure les statistiques
                                </label>
                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800">
                                <input type="checkbox" name="options[avec_graphiques]" id="avec_graphiques"
                                    class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                                <label for="avec_graphiques"
                                    class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                                    Ajouter des graphiques
                                </label>
                            </div>
                        </div>

                        {{-- Excel Options --}}
                        <div x-show="form.format === 'excel'" style="display: none;" class="space-y-3">
                            <div class="flex items-center gap-3 p-3 rounded-lg bg-[#f8f9fc] dark:bg-gray-800">
                                <input type="checkbox" name="options[avec_formules]" id="avec_formules"
                                    class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" checked>
                                <label for="avec_formules"
                                    class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                                    Inclure les formules de calcul
                                </label>
                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-lg bg-[#f8f9fc] dark: bg-gray-800">
                                <input type="checkbox" name="options[avec_mise_en_forme]" id="avec_mise_en_forme"
                                    class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" checked>
                                <label for="avec_mise_en_forme"
                                    class="flex-1 text-sm font-medium text-[#0d121b] dark: text-white cursor-pointer">
                                    Appliquer la mise en forme
                                </label>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>

            {{-- Right Column: Preview & Actions (1/3) --}}
            <div class="space-y-6">
                {{-- Preview --}}
                <x-card title="Aperçu" icon="visibility">
                    <div class="space-y-4">
                        <div
                            class="aspect-[210/297] bg-gray-100 dark:bg-gray-900 rounded-lg border border-[#e7ebf3] dark:border-gray-700 overflow-hidden">
                            <div class="flex items-center justify-center h-full">
                                <div class="text-center p-6">
                                    <span
                                        class="material-symbols-outlined text-6xl text-[#4c669a] dark:text-gray-600 mb-4">description</span>
                                    <p class="text-sm text-[#4c669a] dark:text-gray-400">
                                        Sélectionnez un type de document
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button type="button" onclick="window.open('{{ route('exportation.apercu') }}', '_blank')"
                            class="w-full py-2 text-sm font-medium text-[#135bec] hover:text-[#0f4bc4] border border-[#135bec] rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/10 transition flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                            Aperçu plein écran
                        </button>
                    </div>
                </x-card>

                {{-- Summary --}}
                <x-card title="Résumé" icon="summarize">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-[#4c669a] dark:text-gray-400">Type de document</span>
                            <span class="font-bold text-[#0d121b] dark:text-white" x-text="getDocumentTypeLabel()">-</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-[#4c669a] dark:text-gray-400">Format</span>
                            <span class="font-bold text-[#0d121b] dark: text-white uppercase"
                                x-text="form.format || '-'">-</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-[#4c669a] dark: text-gray-400">Année</span>
                            <span class="font-bold text-[#0d121b] dark: text-white">2023-2024</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-[#4c669a] dark:text-gray-400">Taille estimée</span>
                            <span class="font-bold text-[#0d121b] dark:text-white">~2.3 MB</span>
                        </div>
                    </div>
                </x-card>

                {{-- Actions --}}
                <div class="space-y-3">
                    <x-button type="submit" variant="primary" size="lg" icon="file_download" class="w-full">
                        Générer & Télécharger
                    </x-button>

                    <button type="button"
                        class="w-full py-2.5 text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Enregistrer la configuration
                    </button>
                </div>

                {{-- Help --}}
                <div class="bg-blue-50 dark:bg-blue-900/10 rounded-xl p-4 border border-blue-100 dark:border-blue-900/20">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-blue-600 text-[20px] mt-0.5">info</span>
                        <div>
                            <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">Bon à savoir :</p>
                            <ul class="text-xs text-blue-700 dark:text-blue-400 space-y-1 list-disc list-inside">
                                <li>Les PDF sont signés numériquement</li>
                                <li>Les exports sont conservés 30 jours</li>
                                <li>Téléchargements illimités</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function exportForm() {
            return {
                form: {
                    type_document: '',
                    format: 'pdf',
                    annee_academique_id: '',
                    semestre_id: '',
                    filiere_id: '',
                    module_id: ''
                },

                getDocumentTypeLabel() {
                    const labels = {
                        'releve': 'Relevé de Notes',
                        'pv': 'Procès-Verbal',
                        'bulletin': 'Bulletin',
                        'liste': 'Liste Étudiants',
                        'donnees_brutes': 'Données Brutes'
                    };
                    return labels[this.form.type_document] || '-';
                }
            }
        }

        function loadTemplate(type) {
            // Charger les paramètres prédéfinis du template
            console.log('Loading template:', type);
            Alpine.store('form').type_document = type;
        }
    </script>
@endpush