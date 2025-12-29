@extends('layouts.app')

@section('title', (isset($utilisateur) ? 'Modifier' : 'Créer') . ' un Utilisateur')
@section('page-title', (isset($utilisateur) ? 'Modifier' : 'Créer') . ' un Utilisateur')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Utilisateurs', 'url' => route('utilisateurs.index')],
        ['label' => isset($utilisateur) ? 'Modifier' : 'Créer', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center gap-4">
        <a href="{{ route('utilisateurs.index') }}" class="size-10 rounded-lg border border-[#e7ebf3] dark:border-gray-700 flex items-center justify-center text-[#4c669a] hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                {{ isset($utilisateur) ? 'Modifier' : 'Créer' }} un Utilisateur
            </h1>
            <p class="text-[#4c669a] dark:text-gray-400 mt-1">
                {{ isset($utilisateur) ? 'Modifiez les informations de l\'utilisateur' : 'Créez un nouveau compte utilisateur' }}
            </p>
        </div>
    </div>
</div>

<form action="{{ isset($utilisateur) ? route('utilisateurs.update', $utilisateur) : route('utilisateurs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($utilisateur))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left:  Form (2/3) --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Basic Info --}}
            <x-card title="Informations Personnelles" icon="person">
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input 
                            name="name"
                            label="Nom complet"
                            : value="$utilisateur->name ??  ''"
                            icon="badge"
                            required
                        />
                        
                        <x-input 
                            name="email"
                            type="email"
                            label="Email"
                            :value="$utilisateur->email ?? ''"
                            icon="email"
                            required
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input 
                            name="telephone"
                            type="tel"
                            label="Téléphone"
                            :value="$utilisateur->telephone ?? ''"
                            icon="phone"
                        />
                        
                        <x-select 
                            name="departement_id"
                            label="Département"
                            :options="[
                                '' => 'Aucun département',
                                1 => 'Informatique',
                                2 => 'Mathématiques',
                                3 => 'Physique',
                            ]"
                            :value="$utilisateur->departement_id ?? ''"
                        />
                    </div>
                </div>
            </x-card>

            {{-- Security --}}
            <x-card title="Sécurité & Authentification" icon="lock">
                <div class="space-y-4">
                    @if(! isset($utilisateur))
                        <div class="grid grid-cols-1 md: grid-cols-2 gap-4">
                            <x-input 
                                name="password"
                                type="password"
                                label="Mot de passe"
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
                        </div>

                        <div class="bg-blue-50 dark:bg-blue-900/10 rounded-lg p-4 border border-blue-100 dark:border-blue-900/20">
                            <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">Politique de mot de passe :</p>
                            <ul class="text-xs text-blue-700 dark:text-blue-400 space-y-1 list-disc list-inside">
                                <li>Au moins 8 caractères</li>
                                <li>Mélange de lettres et chiffres recommandé</li>
                            </ul>
                        </div>
                    @else
                        <div class="bg-orange-50 dark:bg-orange-900/10 rounded-lg p-4 border border-orange-100 dark:border-orange-900/20">
                            <p class="text-sm text-orange-700 dark:text-orange-400">
                                Laissez les champs vides pour conserver le mot de passe actuel
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md: grid-cols-2 gap-4">
                            <x-input 
                                name="password"
                                type="password"
                                label="Nouveau mot de passe (optionnel)"
                                icon="lock"
                            />
                            
                            <x-input 
                                name="password_confirmation"
                                type="password"
                                label="Confirmer le nouveau mot de passe"
                                icon="lock"
                            />
                        </div>
                    @endif

                    <div class="flex items-center gap-3 p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                        <input type="checkbox" name="actif" id="actif" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" {{ (isset($utilisateur) && $utilisateur->actif) || ! isset($utilisateur) ? 'checked' : '' }}>
                        <label for="actif" class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                            Compte actif
                        </label>
                    </div>
                </div>
            </x-card>

            {{-- Roles --}}
            <x-card title="Rôles & Permissions" icon="admin_panel_settings">
                <div class="space-y-3">
                    @foreach([
                        ['name' => 'super-admin', 'label' => 'Super Administrateur', 'desc' => 'Accès complet au système', 'color' => 'red'],
                        ['name' => 'admin', 'label' => 'Administrateur', 'desc' => 'Gestion des utilisateurs et paramètres', 'color' => 'orange'],
                        ['name' => 'enseignant', 'label' => 'Enseignant', 'desc' => 'Saisie et validation des notes', 'color' => 'blue'],
                        ['name' => 'secretaire', 'label' => 'Secrétaire', 'desc' => 'Consultation et exportation', 'color' => 'green'],
                        ['name' => 'consultant', 'label' => 'Consultant', 'desc' => 'Consultation seulement', 'color' => 'purple'],
                    ] as $role)
                        <div class="flex items-start gap-4 p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg hover:bg-white dark:hover:bg-gray-700 transition">
                            <input type="checkbox" name="roles[]" value="{{ $role['name'] }}" id="role_{{ $role['name'] }}" class="mt-1 rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" {{ (isset($utilisateur) && $utilisateur->hasRole($role['name'])) ? 'checked' : '' }}>
                            <div class="flex-1">
                                <label for="role_{{ $role['name'] }}" class="flex items-center gap-2 cursor-pointer">
                                    <span class="font-medium text-[#0d121b] dark:text-white">{{ $role['label'] }}</span>
                                    <x-badge :variant="$role['color'] === 'red' ? 'danger' : ($role['color'] === 'orange' ? 'warning' : 'info')" size="xs">{{ $role['name'] }}</x-badge>
                                </label>
                                <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-1">{{ $role['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>

        {{-- Right: Info (1/3) --}}
        <div class="space-y-6">
            {{-- Avatar --}}
            <x-card title="Photo de Profil" icon="photo_camera">
                <div class="flex flex-col items-center gap-4">
                    <div class="size-32 rounded-xl bg-cover bg-center border-4 border-white dark:border-gray-800 shadow-xl" style="background-image: url('{{ isset($utilisateur) ? $utilisateur->avatar_url :  'https://ui-avatars.com/api/?name=User&background=135bec&color=fff&size=256' }}');"></div>
                    
                    <label class="cursor-pointer">
                        <input type="file" accept="image/*" name="avatar" class="hidden">
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-[#135bec] text-white text-sm font-medium rounded-lg hover:bg-[#0f4bc4] transition">
                            <span class="material-symbols-outlined text-[18px]">upload</span>
                            Changer la photo
                        </span>
                    </label>
                    
                    <p class="text-xs text-[#4c669a] dark: text-gray-400 text-center">
                        JPG ou PNG, max 2MB
                    </p>
                </div>
            </x-card>

            @if(isset($utilisateur))
                {{-- Account Info --}}
                <x-card title="Informations" icon="info">
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-[#4c669a] dark:text-gray-400">Créé le</span>
                            <span class="font-medium text-[#0d121b] dark:text-white">{{ $utilisateur->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#4c669a] dark:text-gray-400">Dernière connexion</span>
                            <span class="font-medium text-[#0d121b] dark:text-white">{{ $utilisateur->last_login_at?->diffForHumans() ?? 'Jamais' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#4c669a] dark:text-gray-400">Email vérifié</span>
                            @if($utilisateur->email_verified_at)
                                <span class="flex items-center gap-1 text-green-600">
                                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                    Oui
                                </span>
                            @else
                                <span class="flex items-center gap-1 text-orange-600">
                                    <span class="material-symbols-outlined text-[16px]">warning</span>
                                    Non
                                </span>
                            @endif
                        </div>
                    </div>
                </x-card>
            @endif

            {{-- Tips --}}
            <div class="bg-blue-50 dark:bg-blue-900/10 rounded-xl p-4 border border-blue-100 dark:border-blue-900/20">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-blue-600 text-[20px] mt-0.5">lightbulb</span>
                    <div>
                        <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">Conseils :</p>
                        <ul class="text-xs text-blue-700 dark: text-blue-400 space-y-1 list-disc list-inside">
                            <li>Assignez les rôles appropriés</li>
                            <li>Vérifiez l'email avant activation</li>
                            <li>Un utilisateur peut avoir plusieurs rôles</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="space-y-3">
                <x-button type="submit" variant="primary" size="lg" icon="save" class="w-full">
                    {{ isset($utilisateur) ? 'Mettre à jour' : 'Créer l\'utilisateur' }}
                </x-button>
                
                <a href="{{ route('utilisateurs.index') }}" class="block w-full py-2.5 text-center text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                    Annuler
                </a>
            </div>
        </div>
    </div>
</form>
@endsection