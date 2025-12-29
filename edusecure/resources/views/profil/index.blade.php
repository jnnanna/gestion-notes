@extends('layouts.app')

@section('title', 'Mon Profil')
@section('page-title', 'Mon Profil')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Mon Profil', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-3">
        <div class="size-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/20">
            <span class="material-symbols-outlined text-2xl icon-filled">account_circle</span>
        </div>
        <div>
            <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                Mon Profil
            </h1>
            <p class="text-[#4c669a] dark:text-gray-400 mt-1">
                Gérez vos informations personnelles et préférences
            </p>
        </div>
    </div>
</div>

{{-- Tabs --}}
<div x-data="{ currentTab: 'informations' }" class="mb-6 border-b border-[#e7ebf3] dark:border-gray-800">
    <div class="flex gap-8">
        <button 
            @click="currentTab = 'informations'"
            :class="currentTab === 'informations' ? 'text-[#135bec] border-b-2 border-[#135bec]' : 'text-[#4c669a] dark:text-gray-400'"
            class="relative flex items-center gap-2 pb-4 text-sm font-bold transition"
        >
            <span class="material-symbols-outlined">person</span>
            Informations
        </button>
        <button 
            @click="currentTab = 'securite'"
            :class="currentTab === 'securite' ? 'text-[#135bec] border-b-2 border-[#135bec]' : 'text-[#4c669a] dark:text-gray-400'"
            class="relative flex items-center gap-2 pb-4 text-sm font-bold transition"
        >
            <span class="material-symbols-outlined">lock</span>
            Sécurité
        </button>
        <button 
            @click="currentTab = 'preferences'"
            :class="currentTab === 'preferences' ? 'text-[#135bec] border-b-2 border-[#135bec]' : 'text-[#4c669a] dark:text-gray-400'"
            class="relative flex items-center gap-2 pb-4 text-sm font-bold transition"
        >
            <span class="material-symbols-outlined">settings</span>
            Préférences
        </button>
        <button 
            @click="currentTab = 'activites'"
            :class="currentTab === 'activites' ? 'text-[#135bec] border-b-2 border-[#135bec]' : 'text-[#4c669a] dark:text-gray-400'"
            class="relative flex items-center gap-2 pb-4 text-sm font-bold transition"
        >
            <span class="material-symbols-outlined">history</span>
            Activités
        </button>
    </div>
</div>

<div>
    {{-- Tab 1: Informations Personnelles --}}
    <div x-show="currentTab === 'informations'" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left:  Form (2/3) --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Photo & Basic Info --}}
            <x-card title="Photo de Profil" icon="photo_camera">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <div class="size-32 rounded-xl bg-cover bg-center border-4 border-white dark:border-gray-800 shadow-xl" style="background-image: url('{{ auth()->user()->avatar_url }}');"></div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">
                            Photo recommandée : format carré, 500x500px minimum, JPG ou PNG
                        </p>
                        <div class="flex gap-3">
                            <label class="cursor-pointer">
                                <input type="file" accept="image/*" class="hidden">
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-[#135bec] text-white text-sm font-medium rounded-lg hover:bg-[#0f4bc4] transition">
                                    <span class="material-symbols-outlined text-[18px]">upload</span>
                                    Changer la photo
                                </span>
                            </label>
                            <button class="px-4 py-2 border border-[#e7ebf3] dark:border-gray-700 text-red-600 text-sm font-medium rounded-lg hover:bg-red-50 dark:hover:bg-red-900/10 transition">
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </x-card>

            {{-- Personal Info --}}
            <form action="{{ route('profil.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <x-card title="Informations Personnelles" icon="badge">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-input 
                                name="name"
                                label="Nom complet"
                                value="{{ auth()->user()->name }}"
                                icon="person"
                                required
                            />
                            
                            <x-input 
                                name="email"
                                type="email"
                                label="Email"
                                value="{{ auth()->user()->email }}"
                                icon="email"
                                required
                            />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-input 
                                name="telephone"
                                type="tel"
                                label="Téléphone"
                                value="{{ auth()->user()->telephone }}"
                                icon="phone"
                            />
                            
                            <x-select 
                                name="departement_id"
                                label="Département"
                                :options="[
                                    1 => 'Informatique',
                                    2 => 'Mathématiques',
                                    3 => 'Physique',
                                ]"
                                value="{{ auth()->user()->departement_id }}"
                            />
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#e7ebf3] dark:border-gray-800">
                            <button type="reset" class="text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                                Annuler
                            </button>
                            <x-button type="submit" variant="primary" size="md" icon="save">
                                Enregistrer
                            </x-button>
                        </div>
                    </div>
                </x-card>
            </form>
        </div>

        {{-- Right: Info Cards (1/3) --}}
        <div class="space-y-6">
            {{-- Account Info --}}
            <x-card title="Informations du Compte" icon="info">
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-[#4c669a] dark:text-gray-400">Rôle</span>
                        <x-badge variant="info">{{ auth()->user()->roles->first()->name ?? 'Utilisateur' }}</x-badge>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#4c669a] dark:text-gray-400">Membre depuis</span>
                        <span class="font-medium text-[#0d121b] dark:text-white">{{ auth()->user()->created_at?->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#4c669a] dark:text-gray-400">Dernière connexion</span>
                        <span class="font-medium text-[#0d121b] dark:text-white">{{ auth()->user()->last_login_at?->diffForHumans() ?? 'Jamais' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#4c669a] dark:text-gray-400">Email vérifié</span>
                        @if(auth()->user()->email_verified_at)
                            <span class="flex items-center gap-1 text-green-600">
                                <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                Vérifié
                            </span>
                        @else
                            <span class="flex items-center gap-1 text-orange-600">
                                <span class="material-symbols-outlined text-[16px]">warning</span>
                                Non vérifié
                            </span>
                        @endif
                    </div>
                </div>
            </x-card>

            {{-- Quick Actions --}}
            <x-card title="Actions Rapides" icon="flash_on">
                <div class="space-y-2">
                    <a href="{{ route('profil.securite') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition">
                        <div class="size-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[#135bec]">lock</span>
                        </div>
                        <div>
                            <p class="font-medium text-[#0d121b] dark:text-white text-sm">Changer le mot de passe</p>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">Sécurisez votre compte</p>
                        </div>
                    </a>

                    <button class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition text-left">
                        <div class="size-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <span class="material-symbols-outlined text-green-600">download</span>
                        </div>
                        <div>
                            <p class="font-medium text-[#0d121b] dark:text-white text-sm">Exporter mes données</p>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">RGPD</p>
                        </div>
                    </button>
                </div>
            </x-card>
        </div>
    </div>

    {{-- Tab 2: Sécurité --}}
    <div x-show="currentTab === 'securite'" style="display: none;" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            {{-- Change Password --}}
            <form action="{{ route('profil.update-password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <x-card title="Changer le Mot de Passe" icon="lock">
                    <div class="space-y-4">
                        <x-input 
                            name="current_password"
                            type="password"
                            label="Mot de passe actuel"
                            icon="lock"
                            required
                        />

                        <x-input 
                            name="password"
                            type="password"
                            label="Nouveau mot de passe"
                            icon="lock"
                            required
                        />

                        <x-input 
                            name="password_confirmation"
                            type="password"
                            label="Confirmer le mot de passe"
                            icon="lock"
                            required
                        />

                        <div class="bg-blue-50 dark:bg-blue-900/10 rounded-lg p-4 border border-blue-100 dark:border-blue-900/20">
                            <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">Recommandations :</p>
                            <ul class="text-xs text-blue-700 dark:text-blue-400 space-y-1 list-disc list-inside">
                                <li>Au moins 8 caractères</li>
                                <li>Mélange de lettres majuscules et minuscules</li>
                                <li>Au moins un chiffre</li>
                                <li>Au moins un caractère spécial</li>
                            </ul>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#e7ebf3] dark:border-gray-800">
                            <button type="reset" class="text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                                Annuler
                            </button>
                            <x-button type="submit" variant="primary" size="md" icon="save">
                                Mettre à jour
                            </x-button>
                        </div>
                    </div>
                </x-card>
            </form>

            {{-- Two-Factor Authentication --}}
            <x-card title="Authentification à Deux Facteurs (2FA)" icon="security">
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="size-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-purple-600 text-2xl">shield</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-[#0d121b] dark:text-white mb-2">Sécurité renforcée</h4>
                            <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">
                                Ajoutez une couche de sécurité supplémentaire en activant l'authentification à deux facteurs. 
                            </p>
                            
                            @if(auth()->user()->two_factor_enabled)
                                <div class="flex items-center gap-3">
                                    <x-badge variant="success" dot>Activé</x-badge>
                                    <form action="{{ route('profil.desactiver-2fa') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">
                                            Désactiver
                                        </button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('profil.activer-2fa') }}" method="POST" class="inline">
                                    @csrf
                                    <x-button type="submit" variant="success" size="sm" icon="check_circle">
                                        Activer la 2FA
                                    </x-button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </x-card>

            {{-- Active Sessions --}}
            <x-card title="Sessions Actives" icon="devices">
                <div class="space-y-3">
                    <div class="flex items-start gap-4 p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                        <div class="size-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-green-600">computer</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-medium text-[#0d121b] dark:text-white">Windows - Chrome</p>
                                <x-badge variant="success" size="sm">Actuelle</x-badge>
                            </div>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">
                                192.168.1.100 • {{ auth()->user()->last_login_at?->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                        <div class="size-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-[#135bec]">phone_iphone</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-medium text-[#0d121b] dark:text-white">iPhone - Safari</p>
                                <button class="text-xs font-medium text-red-600 hover:text-red-700">Déconnecter</button>
                            </div>
                            <p class="text-xs text-[#4c669a] dark:text-gray-400">
                                192.168.1.101 • Il y a 2 heures
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('profil.deconnecter-sessions') }}" method="POST" class="pt-4 border-t border-[#e7ebf3] dark:border-gray-800">
                        @csrf
                        <button type="submit" class="w-full py-2 text-sm font-medium text-red-600 hover:text-red-700 border border-red-200 dark:border-red-900 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/10 transition">
                            Déconnecter toutes les autres sessions
                        </button>
                    </form>
                </div>
            </x-card>
        </div>

        {{-- Right Sidebar --}}
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white">
                <span class="material-symbols-outlined text-4xl mb-3">verified_user</span>
                <h4 class="font-bold text-lg mb-2">Sécurité du Compte</h4>
                <p class="text-sm text-purple-100 mb-4">
                    Votre compte est {{ auth()->user()->two_factor_enabled ? 'sécurisé' : 'partiellement protégé' }}
                </p>
                <div class="space-y-2 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">{{ auth()->user()->email_verified_at ? 'check_circle' : 'cancel' }}</span>
                        Email vérifié
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">{{ auth()->user()->two_factor_enabled ? 'check_circle' : 'cancel' }}</span>
                        2FA activée
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        Mot de passe fort
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tab 3: Préférences --}}
    <div x-show="currentTab === 'preferences'" style="display: none;">
        <x-card title="Préférences de Notification" icon="notifications">
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                    <div>
                        <p class="font-medium text-[#0d121b] dark:text-white mb-1">Notifications Email</p>
                        <p class="text-sm text-[#4c669a] dark:text-gray-400">Recevoir des notifications par email</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                    <div>
                        <p class="font-medium text-[#0d121b] dark:text-white mb-1">Notifications Push</p>
                        <p class="text-sm text-[#4c669a] dark:text-gray-400">Recevoir des notifications push</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                    <div>
                        <p class="font-medium text-[#0d121b] dark:text-white mb-1">Résumé Hebdomadaire</p>
                        <p class="text-sm text-[#4c669a] dark:text-gray-400">Recevoir un résumé chaque semaine</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </x-card>
    </div>

    {{-- Tab 4: Activités --}}
    <div x-show="currentTab === 'activites'" style="display: none;">
        <x-card title="Activités Récentes" icon="history">
            <div class="space-y-4">
                @foreach([
                    ['action' => 'Connexion', 'time' => 'Il y a 5 minutes', 'icon' => 'login', 'color' => 'blue'],
                    ['action' => 'Modification du profil', 'time' => 'Il y a 2 heures', 'icon' => 'edit', 'color' => 'green'],
                    ['action' => 'Export de données', 'time' => 'Hier', 'icon' => 'download', 'color' => 'purple'],
                    ['action' => 'Changement de mot de passe', 'time' => 'Il y a 3 jours', 'icon' => 'lock', 'color' => 'orange'],
                ] as $activity)
                    <div class="flex items-center gap-4 p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                        <div class="size-10 rounded-lg bg-{{ $activity['color'] }}-100 dark:bg-{{ $activity['color'] }}-900/30 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-{{ $activity['color'] }}-600">{{ $activity['icon'] }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-[#0d121b] dark:text-white">{{ $activity['action'] }}</p>
                            <p class="text-sm text-[#4c669a] dark:text-gray-400">{{ $activity['time'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-card>
    </div>
</div>
@endsection