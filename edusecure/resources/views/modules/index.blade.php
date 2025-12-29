@extends('layouts.app')

@section('title', 'Gestion des Modules')
@section('page-title', 'Gestion des Modules')

@section('content')
    @php
        $breadcrumbs = [
            ['label' => 'Accueil', 'url' => route('dashboard')],
            ['label' => 'Modules', 'url' => route('modules.index')],
        ];
    @endphp

    {{-- Page Heading & Actions --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div class="max-w-2xl">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-[#0d121b] dark:text-white mb-2">
                Configuration Académique
            </h1>
            <p class="text-[#4c669a] dark:text-gray-400 text-lg leading-relaxed">
                Créez et organisez les structures académiques, gérez les programmes et assignez les équipes pédagogiques.
            </p>
        </div>
        <div class="flex gap-3">
            <x-button variant="secondary" icon="upload_file" size="md">
                Importer CSV
            </x-button>
            <x-button variant="primary" icon="add" size="md"
                onclick="Livewire.dispatch('openModal', { component: 'modals.create-module' })">
                Nouveau Module
            </x-button>
        </div>
    </div>

    {{-- Tabs Navigation --}}
    <div class="mb-6 border-b border-[#e7ebf3] dark:border-gray-800">
        <div class="flex gap-8">
            <a href="{{ route('modules.index') }}"
                class="relative flex items-center gap-2 pb-4 text-sm font-bold text-[#135bec]">
                <span class="material-symbols-outlined">view_module</span>
                Modules
                <span class="absolute bottom-0 left-0 h-0.5 w-full bg-[#135bec]"></span>
            </a>
            <a href="{{ route('filieres.index') }}"
                class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
                <span class="material-symbols-outlined group-hover:text-[#135bec]">schema</span>
                Filières
            </a>
            <a href="{{ route('departements.index') }}"
                class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
                <span class="material-symbols-outlined group-hover:text-[#135bec]">corporate_fare</span>
                Départements
            </a>
            <a href="{{ route('semestres.index') }}"
                class="group flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
                <span class="material-symbols-outlined group-hover:text-[#135bec]">calendar_month</span>
                Semestres
            </a>
        </div>
    </div>

    {{-- Dashboard Split View --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        {{-- Left Column: Data Table (8 cols) --}}
        <div class="lg:col-span-8 flex flex-col gap-4">
            {{-- Toolbar --}}
            <div class="flex flex-wrap items-center justify-between gap-4 p-1 rounded-xl">
                <label class="relative flex-1 min-w-[280px]">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-[#4c669a] dark:text-gray-400">
                        <span class="material-symbols-outlined">search</span>
                    </span>
                    <input type="text"
                        class="w-full rounded-lg border-none bg-white dark:bg-[#1a2234] py-2.5 pl-10 pr-4 text-sm font-medium text-[#0d121b] dark:text-white placeholder-[#4c669a] dark:placeholder-gray-400 shadow-sm ring-1 ring-[#e7ebf3] dark:ring-gray-800 focus:ring-2 focus:ring-[#135bec]"
                        placeholder="Rechercher par code, nom ou responsable..." />
                </label>
                <div class="flex items-center gap-2">
                    <button
                        class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-[#4c669a] dark:text-gray-400 bg-white dark:bg-[#1a2234] rounded-lg ring-1 ring-[#e7ebf3] dark:ring-gray-800 hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                        <span class="material-symbols-outlined text-[18px]">filter_list</span>
                        Filtres
                    </button>
                    <button
                        class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-[#4c669a] dark:text-gray-400 bg-white dark:bg-[#1a2234] rounded-lg ring-1 ring-[#e7ebf3] dark:ring-gray-800 hover:bg-[#f8f9fc] dark:hover:bg-gray-800">
                        <span class="material-symbols-outlined text-[18px]">sort</span>
                        Trier
                    </button>
                </div>
            </div>

            {{-- Table Card --}}
            <div
                class="overflow-hidden rounded-xl border border-[#e7ebf3] dark:border-gray-800 bg-white dark:bg-[#1a2234] shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-[#e7ebf3] dark:border-gray-800 bg-[#f8f9fc] dark:bg-gray-800/50">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-[#4c669a] dark:text-gray-400 w-[80px]">Code</th>
                                <th class="px-6 py-4 font-semibold text-[#4c669a] dark:text-gray-400">Module</th>
                                <th class="px-6 py-4 font-semibold text-[#4c669a] dark:text-gray-400">Responsable</th>
                                <th class="px-6 py-4 font-semibold text-[#4c669a] dark:text-gray-400">Semestre</th>
                                <th class="px-6 py-4 font-semibold text-[#4c669a] dark:text-gray-400">Statut</th>
                                <th class="px-6 py-4 font-semibold text-[#4c669a] dark:text-gray-400 text-right">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                            @forelse($modules ?? [] as $module)
                                <tr
                                    class="group hover:bg-[#135bec]/5 transition-colors cursor-pointer border-l-4 {{ $loop->first ? 'border-l-[#135bec] bg-[#135bec]/5' : 'border-l-transparent' }} hover:border-l-[#135bec]">
                                    <td class="px-6 py-4 font-mono font-medium text-[#4c669a] dark:text-gray-400">
                                        {{ $module->code ?? 'INF-101' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-[#0d121b] dark:text-white">
                                                {{ $module->nom ?? 'Algorithmique I' }}
                                            </span>
                                            <span class="text-xs text-[#4c669a] dark:text-gray-400">
                                                {{ $module->filiere->nom ?? 'Génie Informatique' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="size-6 rounded-full bg-cover bg-center"
                                                style="background-image: url('https://ui-avatars.com/api/? name={{ urlencode($module->responsable->name ?? 'Pr.  Benali') }}&background=135bec&color=fff');">
                                            </div>
                                            <span class="font-medium text-[#0d121b] dark:text-white">
                                                {{ $module->responsable->name ?? 'Pr. Benali' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-badge variant="default">
                                            {{ $module->semestre->code ?? 'S1' }}
                                        </x-badge>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if(($module->actif ?? true))
                                            <x-badge variant="success" dot>Actif</x-badge>
                                        @else
                                            <x-badge variant="default" dot>Archivé</x-badge>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="text-[#4c669a] dark: text-gray-400 hover: text-[#135bec] transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">more_vert</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                {{-- Sample Data --}}
                                <tr
                                    class="group hover:bg-[#135bec]/5 transition-colors cursor-pointer border-l-4 border-l-transparent hover:border-l-[#135bec]">
                                    <td class="px-6 py-4 font-mono font-medium text-[#4c669a] dark:text-gray-400">INF-101</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-[#0d121b] dark: text-white">Algorithmique I</span>
                                            <span class="text-xs text-[#4c669a] dark:text-gray-400">Génie Informatique</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="size-6 rounded-full bg-cover bg-center"
                                                style="background-image:  url('https://ui-avatars.com/api/?name=Pr+Benali&background=135bec&color=fff');">
                                            </div>
                                            <span class="font-medium text-[#0d121b] dark:text-white">Pr. Benali</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-badge variant="default">S1</x-badge>
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-badge variant="success" dot>Actif</x-badge>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">more_vert</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr
                                    class="group hover:bg-[#135bec]/5 transition-colors cursor-pointer border-l-4 border-l-[#135bec] bg-[#135bec]/5">
                                    <td class="px-6 py-4 font-mono font-medium text-[#4c669a] dark:text-gray-400">INF-204</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-[#0d121b] dark:text-white">Bases de Données</span>
                                            <span class="text-xs text-[#4c669a] dark:text-gray-400">Génie Logiciel</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="size-6 rounded-full bg-cover bg-center"
                                                style="background-image: url('https://ui-avatars.com/api/?name=Pr+Mansouri&background=135bec&color=fff');">
                                            </div>
                                            <span class="font-medium text-[#0d121b] dark:text-white">Pr. Mansouri</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-badge variant="default">S3</x-badge>
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-badge variant="success" dot>Actif</x-badge>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">more_vert</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr
                                    class="group hover:bg-[#135bec]/5 transition-colors cursor-pointer border-l-4 border-l-transparent hover:border-l-[#135bec]">
                                    <td class="px-6 py-4 font-mono font-medium text-[#4c669a] dark:text-gray-400">MGT-301</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-[#0d121b] dark:text-white">Management de Projet</span>
                                            <span class="text-xs text-[#4c669a] dark:text-gray-400">Management</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="flex size-6 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 text-xs font-bold">
                                                ? </div>
                                            <span class="font-medium text-[#4c669a] dark:text-gray-400 italic">Non
                                                assigné</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-badge variant="default">S5</x-badge>
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-badge variant="warning" dot>En attente</x-badge>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">more_vert</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr
                                    class="group hover:bg-[#135bec]/5 transition-colors cursor-pointer border-l-4 border-l-transparent hover:border-l-[#135bec] opacity-60">
                                    <td class="px-6 py-4 font-mono font-medium text-[#4c669a] dark:text-gray-400">ANGL-101</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-[#0d121b] dark:text-white">Anglais Technique</span>
                                            <span class="text-xs text-[#4c669a] dark:text-gray-400">Tronc Commun</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="size-6 rounded-full bg-cover bg-center"
                                                style="background-image: url('https://ui-avatars.com/api/?name=Mme+Dubois&background=135bec&color=fff');">
                                            </div>
                                            <span class="font-medium text-[#0d121b] dark:text-white">Mme. Dubois</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-badge variant="default">S1</x-badge>
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-badge variant="default">Archivé</x-badge>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">more_vert</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div
                    class="flex items-center justify-between border-t border-[#e7ebf3] dark:border-gray-800 bg-[#f8f9fc] dark:bg-gray-800/50 px-6 py-3">
                    <p class="text-xs text-[#4c669a] dark:text-gray-400">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">4</span> sur <span
                            class="font-medium">24</span> résultats
                    </p>
                    <div class="flex gap-1">
                        <button
                            class="rounded px-2 py-1 text-sm font-medium text-[#4c669a] hover:bg-white hover:text-[#135bec] dark:hover:bg-gray-700 disabled:opacity-50">Préc.
                        </button>
                        <button
                            class="rounded px-2 py-1 text-sm font-medium text-[#4c669a] hover:bg-white hover:text-[#135bec] dark:hover:bg-gray-700 disabled:opacity-50">Suiv.</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Edit/Create Form (4 cols) --}}
        <div class="lg:col-span-4">
            <div
                class="sticky top-24 rounded-xl border border-[#e7ebf3] dark:border-gray-800 bg-white dark:bg-[#1a2234] shadow-lg">
                {{-- Form Header --}}
                <div class="flex items-center justify-between border-b border-[#e7ebf3] dark:border-gray-800 px-6 py-4">
                    <div>
                        <h3 class="font-bold text-[#0d121b] dark:text-white">Détails du Module</h3>
                        <p class="text-xs text-[#4c669a] dark:text-gray-400">Modification de INF-204</p>
                    </div>
                    <div class="flex gap-1">
                        <button
                            class="rounded-md p-1.5 text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 hover:text-red-500 transition-colors"
                            title="Supprimer">
                            <span class="material-symbols-outlined text-[20px]">delete</span>
                        </button>
                        <button
                            class="rounded-md p-1.5 text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition-colors"
                            title="Fermer">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </button>
                    </div>
                </div>

                {{-- Form Body --}}
                <form method="POST" action="#" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4">
                        <x-input name="code" label="Code" value="INF-204" required />

                        <x-select name="semestre_id" label="Semestre" :options="[
                                1 => 'Semestre 1',
                                2 => 'Semestre 2',
                                3 => 'Semestre 3',
                                4 => 'Semestre 4',
                            ]" :selected="3" required />
                    </div>

                    <x-input name="nom" label="Intitulé du Module" value="Bases de Données Relationnelles" required />

                    <x-select name="filiere_id" label="Filière de rattachement" :options="[
            1 => 'Génie Logiciel',
            2 => 'Réseaux & Télécoms',
            3 => 'Data Science',
        ]" :selected="1" required />

                    {{-- Responsable --}}
                    <div class="space-y-1.5">
                        <label
                            class="text-xs font-bold text-[#4c669a] dark:text-gray-400 uppercase tracking-wide">Responsable</label>
                        <div
                            class="flex items-center gap-2 rounded-lg border border-[#e7ebf3] dark:border-gray-700 bg-[#f8f9fc] dark:bg-gray-800 p-2">
                            <div class="size-8 rounded-full bg-cover bg-center"
                                style="background-image: url('https://ui-avatars.com/api/?name=Pr+Mansouri&background=135bec&color=fff');">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="truncate text-sm font-bold text-[#0d121b] dark:text-white">Pr. Mansouri Ahmed</p>
                                <p class="truncate text-xs text-[#4c669a]">Dépt. Informatique</p>
                            </div>
                            <button type="button"
                                class="text-[#135bec] hover:text-[#0f4bc4] text-sm font-medium px-2">Changer</button>
                        </div>
                    </div>

                    {{-- Active Toggle --}}
                    <label
                        class="flex items-center gap-3 p-3 rounded-lg border border-[#e7ebf3] dark:border-gray-700 hover:bg-[#f8f9fc] dark:hover:bg-gray-800 cursor-pointer transition-colors">
                        <input type="checkbox" name="actif" checked
                            class="size-4 rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" />
                        <div class="flex-1">
                            <span class="block text-sm font-bold text-[#0d121b] dark:text-white">Module Actif</span>
                            <span class="block text-xs text-[#4c669a]">Visible pour les étudiants et professeurs</span>
                        </div>
                    </label>

                    {{-- Form Footer --}}
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#e7ebf3] dark:border-gray-800">
                        <button type="button"
                            class="px-4 py-2 text-sm font-bold text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition-colors">
                            Annuler
                        </button>
                        <x-button type="submit" variant="primary" size="md">
                            Enregistrer
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection