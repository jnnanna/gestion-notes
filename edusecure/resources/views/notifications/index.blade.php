@extends('layouts.app')

@section('title', 'Notifications')
@section('page-title', 'Notifications')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('dashboard')],
        ['label' => 'Notifications', 'url' => route('notifications.index')],
    ];
@endphp

{{-- Page Header --}}
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-[#0d121b] dark:text-white mb-2">
                Notifications
            </h1>
            <p class="text-[#4c669a] dark:text-gray-400">
                {{ $stats['non_lues'] ?? 3 }} notification(s) non lue(s)
            </p>
        </div>
        
        <div class="flex gap-3">
            <form action="{{ route('notifications.lire-toutes') }}" method="POST">
                @csrf
                <x-button type="submit" variant="secondary" icon="done_all" size="md">
                    Tout marquer comme lu
                </x-button>
            </form>
        </div>
    </div>
</div>

{{-- Tabs --}}
<div class="mb-6 border-b border-[#e7ebf3] dark:border-gray-800">
    <div class="flex gap-8">
        <a href="{{ route('notifications.index') }}" class="relative flex items-center gap-2 pb-4 text-sm font-bold text-[#135bec]">
            Toutes
            <x-badge variant="default">{{ $stats['total'] ?? 12 }}</x-badge>
            <span class="absolute bottom-0 left-0 h-0.5 w-full bg-[#135bec]"></span>
        </a>
        <a href="{{ route('notifications.non-lues') }}" class="flex items-center gap-2 pb-4 text-sm font-medium text-[#4c669a] hover:text-[#135bec]">
            Non lues
            <x-badge variant="warning">{{ $stats['non_lues'] ?? 3 }}</x-badge>
        </a>
    </div>
</div>

{{-- Notifications List --}}
<div class="space-y-3">
    @foreach([
        ['titre' => 'Nouvelle feuille de notes à valider', 'message' => 'Dr. Sarah Martin a soumis une feuille de notes pour Algorithmique - L3', 'time' => 'Il y a 5 min', 'icon' => 'task_alt', 'color' => 'blue', 'lu' => false],
        ['titre' => 'Import terminé avec succès', 'message' => 'L\'importation de 35 notes a été complétée sans erreur', 'time' => 'Il y a 2h', 'icon' => 'check_circle', 'color' => 'green', 'lu' => false],
        ['titre' => 'Feuille de notes rejetée', 'message' => 'La feuille FN-2024-015 a été rejetée. Raison: Incohérences détectées', 'time' => 'Hier', 'icon' => 'error', 'color' => 'red', 'lu' => false],
        ['titre' => 'Export prêt à télécharger', 'message' => 'Votre export "Relevés_S5_2024" est disponible', 'time' => 'Il y a 2 jours', 'icon' => 'download', 'color' => 'purple', 'lu' => true],
    ] as $notif)
        <div class="bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 p-4 hover:shadow-md transition {{ ! $notif['lu'] ? 'bg-blue-50/30 dark:bg-blue-900/5' : '' }}">
            <div class="flex gap-4">
                <div class="size-12 rounded-xl bg-{{ $notif['color'] }}-100 dark:bg-{{ $notif['color'] }}-900/30 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-{{ $notif['color'] }}-600">{{ $notif['icon'] }}</span>
                </div>
                
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4 mb-1">
                        <h3 class="font-bold text-[#0d121b] dark:text-white">{{ $notif['titre'] }}</h3>
                        @if(! $notif['lu'])
                            <span class="size-2 rounded-full bg-blue-600 flex-shrink-0 mt-2"></span>
                        @endif
                    </div>
                    <p class="text-sm text-[#4c669a] dark:text-gray-400 mb-2">{{ $notif['message'] }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-[#4c669a] dark:text-gray-500">{{ $notif['time'] }}</span>
                        <div class="flex gap-2">
                            @if(! $notif['lu'])
                                <form action="{{ route('notifications.lire', 1) }}" method="POST">
                                    @csrf
                                    <button class="text-xs font-medium text-[#135bec] hover:underline">Marquer comme lu</button>
                                </form>
                            @endif
                            <form action="{{ route('notifications.destroy', 1) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs font-medium text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection