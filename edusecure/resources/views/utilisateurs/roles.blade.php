@extends('layouts.app')

@section('title', 'Gérer les Rôles - ' . $utilisateur->name)
@section('page-title', 'Gestion des Rôles')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Utilisateurs', 'url' => route('utilisateurs.index')],
        ['label' => $utilisateur->name, 'url' => route('utilisateurs.edit', $utilisateur)],
        ['label' => 'Rôles', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('utilisateurs.index') }}" class="size-10 rounded-lg border border-[#e7ebf3] dark:border-gray-700 flex items-center justify-center text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="text-2xl font-black text-[#0d121b] dark:text-white">
                    Gestion des Rôles
                </h1>
                <p class="text-[#4c669a] dark:text-gray-400 mt-1">
                    {{ $utilisateur->name }} ({{ $utilisateur->email }})
                </p>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('utilisateurs.assign-roles', $utilisateur) }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left:  Roles Selection (2/3) --}}
        <div class="lg:col-span-2">
            <x-card title="Rôles Disponibles" icon="admin_panel_settings">
                <div class="space-y-4">
                    @foreach([
                        ['name' => 'super-admin', 'label' => 'Super Administrateur', 'desc' => 'Accès complet au système, gestion des paramètres et utilisateurs', 'permissions' => ['Tout'], 'color' => 'red'],
                        ['name' => 'admin', 'label' => 'Administrateur', 'desc' => 'Gestion des utilisateurs, modules, filières et importations', 'permissions' => ['Gestion utilisateurs', 'Gestion académique', 'Validation notes'], 'color' => 'orange'],
                        ['name' => 'enseignant', 'label' => 'Enseignant', 'desc' => 'Saisie et modification des notes de ses modules', 'permissions' => ['Saisie notes', 'Modification notes', 'Consultation'], 'color' => 'blue'],
                        ['name' => 'secretaire', 'label' => 'Secrétaire', 'desc' => 'Consultation, exportation et gestion des étudiants', 'permissions' => ['Consultation', 'Export', 'Gestion étudiants'], 'color' => 'green'],
                        ['name' => 'consultant', 'label' => 'Consultant', 'desc' => 'Consultation en lecture seule des données', 'permissions' => ['Consultation uniquement'], 'color' => 'purple'],
                    ] as $role)
                        <div class="border-2 {{ $utilisateur->hasRole($role['name']) ? 'border-'.$role['color'].'-500 bg-'.$role['color'].'-50 dark:bg-'.$role['color'].'-900/10' : 'border-[#e7ebf3] dark:border-gray-700' }} rounded-xl p-6 hover:border-{{ $role['color'] }}-500 transition cursor-pointer">
                            <div class="flex items-start gap-4">
                                <input 
                                    type="checkbox" 
                                    name="roles[]" 
                                    value="{{ $role['name'] }}" 
                                    id="role_{{ $role['name'] }}" 
                                    class="mt-1 size-5 rounded border-gray-300 text-{{ $role['color'] }}-600 focus:ring-{{ $role['color'] }}-500"
                                    {{ $utilisateur->hasRole($role['name']) ? 'checked' : '' }}
                                >
                                <div class="flex-1">
                                    <label for="role_{{ $role['name'] }}" class="cursor-pointer">
                                        <div class="flex items-center gap-3 mb-2">
                                            <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">{{ $role['label'] }}</h3>
                                            <x-badge :variant="$role['color'] === 'red' ?  'danger' : ($role['color'] === 'orange' ?  'warning' : ($role['color'] === 'blue' ? 'info' : ($role['color'] === 'green' ? 'success' : 'default')))">
                                                {{ $role['name'] }}
                                            </x-badge>
                                        </div>
                                        <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-3">{{ $role['desc'] }}</p>
                                    </label>
                                    
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($role['permissions'] as $permission)
                                            <span class="px-2 py-1 bg-white dark:bg-gray-800 rounded text-xs text-[#4c669a] dark:text-gray-400 border border-[#e7ebf3] dark:border-gray-700">
                                                <span class="material-symbols-outlined text-[12px] align-middle">check</span>
                                                {{ $permission }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>

        {{-- Right: Summary (1/3) --}}
        <div class="space-y-6">
            {{-- Current Roles --}}
            <x-card title="Rôles Actuels" icon="verified_user">
                <div class="space-y-2">
                    @forelse($utilisateur->roles as $role)
                        <div class="flex items-center justify-between p-3 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                            <span class="font-medium text-[#0d121b] dark:text-white">{{ $role->name }}</span>
                            <x-badge variant="success" size="sm">Actif</x-badge>
                        </div>
                    @empty
                        <p class="text-sm text-[#4c669a] dark:text-gray-400 text-center py-4">
                            Aucun rôle assigné
                        </p>
                    @endforelse
                </div>
            </x-card>

            {{-- Warning --}}
            <div class="bg-orange-50 dark:bg-orange-900/10 rounded-xl p-4 border border-orange-100 dark:border-orange-900/20">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-orange-600 text-[20px] mt-0.5">warning</span>
                    <div>
                        <p class="text-sm font-semibold text-orange-900 dark:text-orange-300 mb-1">Attention</p>
                        <p class="text-xs text-orange-700 dark:text-orange-400">
                            Assurez-vous de n'assigner que les rôles nécessaires. Un utilisateur peut avoir plusieurs rôles.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="space-y-3">
                <x-button type="submit" variant="primary" size="lg" icon="save" class="w-full">
                    Enregistrer les Rôles
                </x-button>
                
                <a href="{{ route('utilisateurs.index') }}" class="block w-full py-2.5 text-center text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                    Annuler
                </a>
            </div>
        </div>
    </div>
</form>
@endsection