@extends('layouts.app')

@section('title', 'Gestion des Utilisateurs')
@section('page-title', 'Gestion des Utilisateurs')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Utilisateurs', 'url' => route('utilisateurs.index')],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="size-12 rounded-xl bg-gradient-to-br from-pink-500 to-pink-600 flex items-center justify-center text-white shadow-lg shadow-pink-500/20">
                    <span class="material-symbols-outlined text-2xl icon-filled">group</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                        Gestion des Utilisateurs
                    </h1>
                </div>
            </div>
            <p class="text-[#4c669a] dark:text-gray-400 text-lg leading-relaxed">
                Gérez les comptes et les permissions des utilisateurs
            </p>
        </div>
        <div class="flex gap-3">
            <x-button variant="secondary" icon="upload" size="md">
                Importer
            </x-button>
            <a href="{{ route('utilisateurs.create') }}">
                <x-button variant="primary" icon="add" size="md">
                    Nouvel Utilisateur
                </x-button>
            </a>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-stat-card 
        title="Total Utilisateurs" 
        value="{{ $stats['total'] ?? 48 }}" 
        icon="people" 
        iconBg="pink"
        subtitle="Tous rôles"
    />
    
    <x-stat-card 
        title="Actifs" 
        value="{{ $stats['actifs'] ?? 42 }}" 
        icon="check_circle" 
        iconBg="green"
        trend="up"
        trendValue="87%"
        subtitle="Compte actif"
    />
    
    <x-stat-card 
        title="Enseignants" 
        value="{{ $stats['enseignants'] ?? 28 }}" 
        icon="school" 
        iconBg="blue"
        subtitle="Personnel académique"
    />
    
    <x-stat-card 
        title="Administrateurs" 
        value="{{ $stats['admins'] ?? 5 }}" 
        icon="admin_panel_settings" 
        iconBg="purple"
        subtitle="Super admins"
    />
</div>

{{-- Filters Bar --}}
<div class="bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl p-5 shadow-sm mb-6">
    <form method="GET" action="{{ route('utilisateurs.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <x-input 
                type="search"
                name="search"
                placeholder="Rechercher (nom, email...)"
                icon="search"
                value="{{ request('search') }}"
            />
            
            <x-select 
                name="role" 
                label="Rôle"
                :options="[
                    '' => 'Tous les rôles',
                    'super-admin' => 'Super Admin',
                    'admin' => 'Administrateur',
                    'enseignant' => 'Enseignant',
                    'secretaire' => 'Secrétaire',
                    'consultant' => 'Consultant',
                ]"
                value="{{ request('role') }}"
            />
            
            <x-select 
                name="statut" 
                label="Statut"
                :options="[
                    '' => 'Tous',
                    'actif' => 'Actif',
                    'inactif' => 'Inactif',
                ]"
                value="{{ request('statut') }}"
            />
            
            <div class="flex items-end gap-2">
                <x-button type="submit" variant="secondary" size="md" icon="search" class="flex-1">
                    Rechercher
                </x-button>
                <a href="{{ route('utilisateurs.index') }}" class="px-3 py-2 text-sm text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                    <span class="material-symbols-outlined">refresh</span>
                </a>
            </div>
        </div>
    </form>
</div>

{{-- Users Table --}}
<x-card :padding="false">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-[#f8f9fc] dark:bg-gray-800/50 border-b border-[#e7ebf3] dark:border-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left w-12">
                        <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                    </th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Photo</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Nom</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Email</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Rôle</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Département</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Statut</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#4c669a] dark:text-gray-400">Dernière connexion</th>
                    <th class="px-4 py-3 text-right font-semibold text-[#4c669a] dark:text-gray-400">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                @forelse($utilisateurs ?? [] as $user)
                    <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition">
                        <td class="px-4 py-3">
                            <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                        </td>
                        <td class="px-4 py-3">
                            <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=135bec&color=fff' }}');"></div>
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-[#0d121b] dark:text-white">{{ $user->name }}</p>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $user->telephone ?? '-' }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-[#4c669a] dark:text-gray-400">{{ $user->email }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <x-badge :variant="$user->roles->first()->name === 'super-admin' ? 'danger' : ($user->roles->first()->name === 'admin' ? 'warning' : 'info')">
                                {{ $user->roles->first()->name ?? 'Aucun' }}
                            </x-badge>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-[#4c669a] dark:text-gray-400">{{ $user->departement->nom ?? '-' }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <x-badge :variant="$user->actif ? 'success' : 'danger'" dot>
                                {{ $user->actif ? 'Actif' : 'Inactif' }}
                            </x-badge>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-xs text-[#4c669a] dark:text-gray-400">{{ $user->last_login_at?->diffForHumans() ?? 'Jamais' }}</span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('utilisateurs.edit', $user) }}" class="p-1.5 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 text-[#135bec] transition" title="Modifier">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <a href="{{ route('utilisateurs.roles', $user) }}" class="p-1.5 rounded hover:bg-purple-50 dark:hover:bg-purple-900/20 text-purple-600 transition" title="Rôles">
                                    <span class="material-symbols-outlined text-[18px]">admin_panel_settings</span>
                                </a>
                                @if($user->actif)
                                    <button class="p-1.5 rounded hover:bg-orange-50 dark:hover:bg-orange-900/20 text-orange-600 transition" title="Désactiver">
                                        <span class="material-symbols-outlined text-[18px]">block</span>
                                    </button>
                                @else
                                    <button class="p-1.5 rounded hover:bg-green-50 dark:hover:bg-green-900/20 text-green-600 transition" title="Activer">
                                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                    </button>
                                @endif
                                <button class="p-1.5 rounded hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 transition" title="Supprimer">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    {{-- Sample Data --}}
                    @foreach([
                        ['name' => 'Admin Système', 'email' => 'admin@edusecure.ma', 'role' => 'super-admin', 'dept' => 'IT', 'actif' => true, 'login' => 'il y a 5 min'],
                        ['name' => 'Dr. Sarah Martin', 'email' => 'sarah.martin@univ.ma', 'role' => 'enseignant', 'dept' => 'Informatique', 'actif' => true, 'login' => 'il y a 2h'],
                        ['name' => 'Pr. Ahmed Benali', 'email' => 'ahmed.benali@univ.ma', 'role' => 'enseignant', 'dept' => 'Informatique', 'actif' => true, 'login' => 'hier'],
                        ['name' => 'Fatima Zahra', 'email' => 'f.zahra@univ.ma', 'role' => 'secretaire', 'dept' => 'Scolarité', 'actif' => true, 'login' => 'il y a 1 jour'],
                        ['name' => 'Mohamed Idrissi', 'email' => 'm.idrissi@univ.ma', 'role' => 'admin', 'dept' => 'IT', 'actif' => false, 'login' => 'jamais'],
                    ] as $sample)
                        <tr class="hover:bg-[#f8f9fc] dark:hover:bg-gray-800/50 transition">
                            <td class="px-4 py-3">
                                <input type="checkbox" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                            </td>
                            <td class="px-4 py-3">
                                <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://ui-avatars.com/api/?name={{urlencode($sample['name'])}}&background=135bec&color=fff');"></div>
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-medium text-[#0d121b] dark:text-white">{{ $sample['name'] }}</p>
                                <p class="text-xs text-[#4c669a] dark:text-gray-400">+212 6 XX XX XX XX</p>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-[#4c669a] dark:text-gray-400">{{ $sample['email'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <x-badge :variant="$sample['role'] === 'super-admin' ? 'danger' : ($sample['role'] === 'admin' ? 'warning' : 'info')">
                                    {{ $sample['role'] }}
                                </x-badge>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-[#4c669a] dark:text-gray-400">{{ $sample['dept'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <x-badge :variant="$sample['actif'] ? 'success' : 'danger'" dot>
                                    {{ $sample['actif'] ? 'Actif' : 'Inactif' }}
                                </x-badge>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-xs text-[#4c669a] dark:text-gray-400">{{ $sample['login'] }}</span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('utilisateurs.edit', 1) }}" class="p-1.5 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 text-[#135bec] transition" title="Modifier">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    <a href="{{ route('utilisateurs.roles', 1) }}" class="p-1.5 rounded hover:bg-purple-50 dark:hover:bg-purple-900/20 text-purple-600 transition" title="Rôles">
                                        <span class="material-symbols-outlined text-[18px]">admin_panel_settings</span>
                                    </a>
                                    @if($sample['actif'])
                                        <button class="p-1.5 rounded hover:bg-orange-50 dark:hover:bg-orange-900/20 text-orange-600 transition" title="Désactiver">
                                            <span class="material-symbols-outlined text-[18px]">block</span>
                                        </button>
                                    @else
                                        <button class="p-1.5 rounded hover:bg-green-50 dark:hover:bg-green-900/20 text-green-600 transition" title="Activer">
                                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                        </button>
                                    @endif
                                    <button class="p-1.5 rounded hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 transition" title="Supprimer">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
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
            <span class="text-sm text-[#4c669a] dark:text-gray-400">
                Affichage de 1 à 5 sur {{ $stats['total'] ?? 48 }} résultats
            </span>
            <div class="flex items-center gap-2">
                {{-- Pagination here --}}
            </div>
        </div>
    </div>
</x-card>
@endsection