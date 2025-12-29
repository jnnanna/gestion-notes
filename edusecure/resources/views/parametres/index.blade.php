@extends('layouts.app')

@section('title', 'Paramètres Système')
@section('page-title', 'Paramètres Système')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Paramètres', 'url' => ''],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-3">
        <div class="size-12 rounded-xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center text-white shadow-lg shadow-red-500/20">
            <span class="material-symbols-outlined text-2xl icon-filled">settings</span>
        </div>
        <div>
            <h1 class="text-3xl font-black tracking-tight text-[#0d121b] dark:text-white">
                Paramètres Système
            </h1>
            <p class="text-[#4c669a] dark:text-gray-400 mt-1">
                Configuration globale de l'application (Administrateur)
            </p>
        </div>
    </div>
</div>

{{-- Warning Banner --}}
<div class="bg-red-50 dark:bg-red-900/10 border-l-4 border-red-500 p-4 mb-8 rounded-lg">
    <div class="flex items-start gap-3">
        <span class="material-symbols-outlined text-red-600 text-xl">warning</span>
        <div>
            <p class="font-semibold text-red-900 dark:text-red-300 mb-1">Zone Administrateur</p>
            <p class="text-sm text-red-700 dark:text-red-400">
                Attention : Les modifications effectuées ici affectent tous les utilisateurs. Procédez avec prudence.
            </p>
        </div>
    </div>
</div>

{{-- Tabs --}}
<div class="mb-6 border-b border-[#e7ebf3] dark:border-gray-800">
    <div class="flex gap-8 overflow-x-auto">
        <button 
            @click="currentTab = 'general'"
            :class="currentTab === 'general' ? 'text-[#135bec] border-b-2 border-[#135bec]' : 'text-[#4c669a] dark:text-gray-400'"
            class="relative flex items-center gap-2 pb-4 text-sm font-bold transition whitespace-nowrap"
            x-data="{ currentTab: 'general' }"
        >
            <span class="material-symbols-outlined">tune</span>
            Général
        </button>
        <button 
            @click="currentTab = 'academique'"
            :class="currentTab === 'academique' ? 'text-[#135bec] border-b-2 border-[#135bec]' : 'text-[#4c669a] dark:text-gray-400'"
            class="relative flex items-center gap-2 pb-4 text-sm font-bold transition whitespace-nowrap"
        >
            <span class="material-symbols-outlined">school</span>
            Académique
        </button>
        <button 
            @click="currentTab = 'notifications'"
            :class="currentTab === 'notifications' ? 'text-[#135bec] border-b-2 border-[#135bec]' : 'text-[#4c669a] dark:text-gray-400'"
            class="relative flex items-center gap-2 pb-4 text-sm font-bold transition whitespace-nowrap"
        >
            <span class="material-symbols-outlined">notifications</span>
            Notifications
        </button>
        <button 
            @click="currentTab = 'securite'"
            :class="currentTab === 'securite' ? 'text-[#135bec] border-b-2 border-[#135bec]' : 'text-[#4c669a] dark:text-gray-400'"
            class="relative flex items-center gap-2 pb-4 text-sm font-bold transition whitespace-nowrap"
        >
            <span class="material-symbols-outlined">security</span>
            Sécurité
        </button>
        <button 
            @click="currentTab = 'maintenance'"
            :class="currentTab === 'maintenance' ? 'text-[#135bec] border-b-2 border-[#135bec]' : 'text-[#4c669a] dark:text-gray-400'"
            class="relative flex items-center gap-2 pb-4 text-sm font-bold transition whitespace-nowrap"
        >
            <span class="material-symbols-outlined">build</span>
            Maintenance
        </button>
    </div>
</div>

<div x-data="{ currentTab: 'general' }">
    {{-- Tab 1: Général --}}
    <div x-show="currentTab === 'general'" class="space-y-6">
        <form action="{{ route('parametres.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- Application Info --}}
            <x-card title="Informations de l'Application" icon="info">
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input 
                            name="app_name"
                            label="Nom de l'application"
                            value="EduSecure"
                            icon="badge"
                            required
                        />
                        
                        <x-input 
                            name="app_description"
                            label="Description"
                            value="Système de gestion des notes"
                            icon="description"
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input 
                            name="institution_name"
                            label="Nom de l'établissement"
                            value="Université Mohammed V"
                            icon="domain"
                            required
                        />
                        
                        <x-input 
                            name="institution_email"
                            type="email"
                            label="Email de l'établissement"
                            value="contact@univ.ma"
                            icon="email"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[#0d121b] dark:text-white mb-2">Logo de l'établissement</label>
                        <div class="flex items-center gap-4">
                            <div class="size-20 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center border border-[#e7ebf3] dark:border-gray-700">
                                <img src="https://placehold.co/80x80/135bec/ffffff?text=LOGO" alt="Logo" class="size-16 object-contain">
                            </div>
                            <div>
                                <label class="cursor-pointer">
                                    <input type="file" accept="image/*" class="hidden" name="logo">
                                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-[#135bec] text-white text-sm font-medium rounded-lg hover:bg-[#0f4bc4] transition">
                                        <span class="material-symbols-outlined text-[18px]">upload</span>
                                        Changer le logo
                                    </span>
                                </label>
                                <p class="text-xs text-[#4c669a] dark:text-gray-400 mt-2">PNG ou SVG recommandé (max 2MB)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>

            {{-- Contact Info --}}
            <x-card title="Informations de Contact" icon="contact_mail">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input 
                        name="contact_phone"
                        type="tel"
                        label="Téléphone"
                        value="+212 5 37 XX XX XX"
                        icon="phone"
                    />
                    
                    <x-input 
                        name="contact_fax"
                        type="tel"
                        label="Fax"
                        value="+212 5 37 XX XX XX"
                        icon="print"
                    />
                    
                    <div class="md:col-span-2">
                        <x-input 
                            name="contact_address"
                            label="Adresse"
                            value="Avenue des Nations Unies, Rabat"
                            icon="location_on"
                        />
                    </div>
                </div>
            </x-card>

            {{-- Save Button --}}
            <div class="flex items-center justify-end gap-3">
                <button type="reset" class="px-4 py-2 text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                    Réinitialiser
                </button>
                <x-button type="submit" variant="primary" size="md" icon="save">
                    Enregistrer les modifications
                </x-button>
            </div>
        </form>
    </div>

    {{-- Tab 2: Académique --}}
    <div x-show="currentTab === 'academique'" style="display: none;" class="space-y-6">
        <form action="{{ route('parametres.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Notation --}}
            <x-card title="Système de Notation" icon="grade">
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-select 
                            name="notation_scale"
                            label="Échelle de notation"
                            :options="[
                                '20' => 'Sur 20',
                                '100' => 'Sur 100',
                                'letter' => 'Lettres (A-F)',
                            ]"
                            value="20"
                        />
                        
                        <x-input 
                            name="notation_min"
                            type="number"
                            step="0.25"
                            label="Note minimale"
                            value="0"
                            icon="trending_down"
                        />
                        
                        <x-input 
                            name="notation_max"
                            type="number"
                            step="0.25"
                            label="Note maximale"
                            value="20"
                            icon="trending_up"
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input 
                            name="note_passage"
                            type="number"
                            step="0.25"
                            label="Note de passage"
                            value="10"
                            icon="check_circle"
                        />
                        
                        <x-input 
                            name="precision_note"
                            type="number"
                            step="0.25"
                            label="Précision (arrondi)"
                            value="0.25"
                            icon="decimal_increase"
                        />
                    </div>

                    <div class="bg-blue-50 dark:bg-blue-900/10 rounded-lg p-4 border border-blue-100 dark:border-blue-900/20">
                        <div class="flex items-center gap-3 mb-3">
                            <input type="checkbox" name="allow_negative" id="allow_negative" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                            <label for="allow_negative" class="text-sm font-medium text-blue-900 dark:text-blue-300">
                                Autoriser les notes négatives
                            </label>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="allow_bonus" id="allow_bonus" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" checked>
                            <label for="allow_bonus" class="text-sm font-medium text-blue-900 dark:text-blue-300">
                                Autoriser les notes bonus (> 20)
                            </label>
                        </div>
                    </div>
                </div>
            </x-card>

            {{-- Mentions --}}
            <x-card title="Barème des Mentions" icon="military_tech">
                <div class="space-y-3">
                    @foreach([
                        ['label' => 'Très Bien', 'min' => 16, 'color' => 'green'],
                        ['label' => 'Bien', 'min' => 14, 'color' => 'blue'],
                        ['label' => 'Assez Bien', 'min' => 12, 'color' => 'purple'],
                        ['label' => 'Passable', 'min' => 10, 'color' => 'orange'],
                    ] as $mention)
                        <div class="flex items-center gap-4 p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                            <div class="size-10 rounded-lg bg-{{ $mention['color'] }}-100 dark:bg-{{ $mention['color'] }}-900/30 flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-{{ $mention['color'] }}-600">workspace_premium</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-[#0d121b] dark:text-white">{{ $mention['label'] }}</p>
                            </div>
                            <x-input 
                                :name="'mention_' . strtolower(str_replace(' ', '_', $mention['label']))"
                                type="number"
                                step="0.25"
                                :value="$mention['min']"
                                size="sm"
                                class="w-24"
                            />
                            <span class="text-sm text-[#4c669a]">/ 20</span>
                        </div>
                    @endforeach
                </div>
            </x-card>

            {{-- Crédits ECTS --}}
            <x-card title="Système de Crédits ECTS" icon="workspace_premium">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input 
                        name="credits_par_semestre"
                        type="number"
                        label="Crédits par semestre"
                        value="30"
                        icon="pin"
                    />
                    
                    <x-input 
                        name="credits_par_annee"
                        type="number"
                        label="Crédits par année"
                        value="60"
                        icon="calendar_month"
                    />
                </div>
            </x-card>

            {{-- Save --}}
            <div class="flex items-center justify-end gap-3">
                <button type="reset" class="px-4 py-2 text-sm font-medium text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition">
                    Réinitialiser
                </button>
                <x-button type="submit" variant="primary" size="md" icon="save">
                    Enregistrer les modifications
                </x-button>
            </div>
        </form>
    </div>

    {{-- Tab 3: Notifications --}}
    <div x-show="currentTab === 'notifications'" style="display: none;" class="space-y-6">
        <x-card title="Configuration Email" icon="email">
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input 
                        name="mail_from_address"
                        type="email"
                        label="Email expéditeur"
                        value="noreply@edusecure.ma"
                        icon="send"
                    />
                    
                    <x-input 
                        name="mail_from_name"
                        label="Nom expéditeur"
                        value="EduSecure"
                        icon="badge"
                    />
                </div>

                <div class="flex items-center gap-3 p-4 bg-blue-50 dark:bg-blue-900/10 rounded-lg">
                    <input type="checkbox" id="mail_queue" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" checked>
                    <label for="mail_queue" class="flex-1">
                        <span class="font-medium text-blue-900 dark:text-blue-300 block">Utiliser une file d'attente</span>
                        <span class="text-sm text-blue-700 dark:text-blue-400">Améliore les performances lors de l'envoi en masse</span>
                    </label>
                </div>
            </div>
        </x-card>

        <x-card title="Types de Notifications" icon="notifications_active">
            <div class="space-y-3">
                @foreach([
                    ['label' => 'Nouvelle importation de notes', 'checked' => true],
                    ['label' => 'Validation de feuille de notes', 'checked' => true],
                    ['label' => 'Rejet de feuille de notes', 'checked' => true],
                    ['label' => 'Export généré', 'checked' => false],
                    ['label' => 'Nouveau compte utilisateur', 'checked' => true],
                    ['label' => 'Résumé hebdomadaire', 'checked' => false],
                ] as $notif)
                    <div class="flex items-center gap-3 p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                        <input type="checkbox" id="notif_{{ $loop->index }}" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" {{ $notif['checked'] ? 'checked' : '' }}>
                        <label for="notif_{{ $loop->index }}" class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                            {{ $notif['label'] }}
                        </label>
                    </div>
                @endforeach
            </div>
        </x-card>
    </div>

    {{-- Tab 4: Sécurité --}}
    <div x-show="currentTab === 'securite'" style="display: none;" class="space-y-6">
        <x-card title="Politique de Mot de Passe" icon="password">
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input 
                        name="password_min_length"
                        type="number"
                        label="Longueur minimale"
                        value="8"
                        icon="pin"
                    />
                    
                    <x-input 
                        name="password_expiration"
                        type="number"
                        label="Expiration (jours)"
                        value="90"
                        icon="schedule"
                    />
                </div>

                <div class="space-y-3">
                    <div class="flex items-center gap-3 p-3 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                        <input type="checkbox" id="password_uppercase" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" checked>
                        <label for="password_uppercase" class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                            Exiger au moins une majuscule
                        </label>
                    </div>

                    <div class="flex items-center gap-3 p-3 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                        <input type="checkbox" id="password_number" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" checked>
                        <label for="password_number" class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                            Exiger au moins un chiffre
                        </label>
                    </div>

                    <div class="flex items-center gap-3 p-3 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                        <input type="checkbox" id="password_special" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]" checked>
                        <label for="password_special" class="flex-1 text-sm font-medium text-[#0d121b] dark:text-white cursor-pointer">
                            Exiger au moins un caractère spécial
                        </label>
                    </div>
                </div>
            </div>
        </x-card>

        <x-card title="Sessions & Connexions" icon="login">
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input 
                        name="session_lifetime"
                        type="number"
                        label="Durée de session (minutes)"
                        value="120"
                        icon="schedule"
                    />
                    
                    <x-input 
                        name="max_login_attempts"
                        type="number"
                        label="Tentatives max de connexion"
                        value="5"
                        icon="block"
                    />
                </div>

                <div class="flex items-center gap-3 p-4 bg-blue-50 dark:bg-blue-900/10 rounded-lg">
                    <input type="checkbox" id="force_2fa" class="rounded border-gray-300 text-[#135bec] focus:ring-[#135bec]">
                    <label for="force_2fa" class="flex-1">
                        <span class="font-medium text-blue-900 dark:text-blue-300 block">Forcer la 2FA pour tous</span>
                        <span class="text-sm text-blue-700 dark:text-blue-400">Tous les utilisateurs devront activer l'authentification à deux facteurs</span>
                    </label>
                </div>
            </div>
        </x-card>
    </div>

    {{-- Tab 5: Maintenance --}}
    <div x-show="currentTab === 'maintenance'" style="display: none;" class="space-y-6">
        {{-- System Info --}}
        <x-card title="Informations Système" icon="computer">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                    <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Version Laravel</p>
                    <p class="text-lg font-bold text-[#0d121b] dark:text-white">{{ app()->version() }}</p>
                </div>
                <div class="p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                    <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Version PHP</p>
                    <p class="text-lg font-bold text-[#0d121b] dark:text-white">{{ PHP_VERSION }}</p>
                </div>
                <div class="p-4 bg-[#f8f9fc] dark:bg-gray-800 rounded-lg">
                    <p class="text-xs text-[#4c669a] dark:text-gray-400 mb-1">Base de données</p>
                    <p class="text-lg font-bold text-[#0d121b] dark:text-white">MySQL 8.0</p>
                </div>
            </div>
        </x-card>

        {{-- Cache Management --}}
        <x-card title="Gestion du Cache" icon="cached">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <form action="{{ route('parametres.clear-cache') }}" method="POST">
                    @csrf
                    <div class="p-6 border-2 border-dashed border-blue-300 dark:border-blue-800 rounded-lg text-center">
                        <span class="material-symbols-outlined text-4xl text-blue-600 mb-3">cleaning_services</span>
                        <h4 class="font-bold text-[#0d121b] dark:text-white mb-2">Vider le Cache</h4>
                        <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">
                            Supprime tous les fichiers de cache
                        </p>
                        <x-button type="submit" variant="secondary" size="sm" icon="delete_sweep">
                            Vider le cache
                        </x-button>
                    </div>
                </form>

                <form action="{{ route('parametres.clear-logs') }}" method="POST">
                    @csrf
                    <div class="p-6 border-2 border-dashed border-orange-300 dark:border-orange-800 rounded-lg text-center">
                        <span class="material-symbols-outlined text-4xl text-orange-600 mb-3">description</span>
                        <h4 class="font-bold text-[#0d121b] dark:text-white mb-2">Nettoyer les Logs</h4>
                        <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">
                            Supprime les anciens fichiers de logs
                        </p>
                        <x-button type="submit" variant="secondary" size="sm" icon="delete">
                            Nettoyer les logs
                        </x-button>
                    </div>
                </form>
            </div>
        </x-card>

        {{-- Backup --}}
        <x-card title="Sauvegarde" icon="backup">
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-green-50 dark:bg-green-900/10 rounded-lg border border-green-100 dark:border-green-900/20">
                    <div>
                        <p class="font-medium text-green-900 dark:text-green-300 mb-1">Dernière sauvegarde</p>
                        <p class="text-sm text-green-700 dark:text-green-400">Il y a 2 heures • 245 MB</p>
                    </div>
                    <a href="#" class="text-sm font-medium text-green-600 hover:text-green-700">Télécharger</a>
                </div>

                <form action="{{ route('parametres.create-backup') }}" method="POST" class="p-6 border-2 border-dashed border-green-300 dark:border-green-800 rounded-lg text-center">
                    @csrf
                    <span class="material-symbols-outlined text-5xl text-green-600 mb-3">cloud_download</span>
                    <h4 class="font-bold text-[#0d121b] dark:text-white mb-2">Créer une Sauvegarde</h4>
                    <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-4">
                        Sauvegarde complète : Base de données + Fichiers
                    </p>
                    <x-button type="submit" variant="success" size="md" icon="backup">
                        Créer une sauvegarde
                    </x-button>
                </form>
            </div>
        </x-card>

        {{-- Danger Zone --}}
        <div class="bg-red-50 dark:bg-red-900/10 border-2 border-red-200 dark:border-red-900 rounded-xl p-6">
            <div class="flex items-start gap-4 mb-4">
                <span class="material-symbols-outlined text-red-600 text-3xl">warning</span>
                <div>
                    <h3 class="font-bold text-red-900 dark:text-red-300 text-lg mb-1">Zone Dangereuse</h3>
                    <p class="text-sm text-red-700 dark:text-red-400">
                        Ces actions sont irréversibles. Utilisez-les avec une extrême prudence.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <button class="w-full py-3 text-sm font-medium text-red-600 border-2 border-red-300 dark:border-red-800 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/20 transition">
                    Réinitialiser la base de données
                </button>
                <button class="w-full py-3 text-sm font-medium text-red-600 border-2 border-red-300 dark:border-red-800 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/20 transition">
                    Supprimer tous les fichiers uploadés
                </button>
            </div>
        </div>
    </div>
</div>
@endsection