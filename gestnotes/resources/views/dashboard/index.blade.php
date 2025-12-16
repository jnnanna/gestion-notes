{{-- gestnotes/resources/views/dashboard/index.blade.php --}}
@extends('layouts.app')

@section('title', 'EduSecure - Tableau de Bord')

@section('content')
<div class="flex h-screen w-full">
    <!-- Sidebar -->
    @include('partials.sidebar')
    
    <!-- Main Content -->
    <main class="flex flex-col flex-1 h-full overflow-hidden relative">
        <!-- Header -->
        @include('partials.header')
        
        <!-- Scrollable Body -->
        <div class="flex-1 overflow-y-auto p-4 md:p-8 space-y-8">
            <!-- Welcome Section -->
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-[#0d121b] dark:text-white tracking-tight">
                    Bonjour, {{ Auth::user()->full_name }}
                </h1>
                <p class="text-[#4c669a] dark:text-gray-400 mt-1">Voici ce qui se passe dans votre département aujourd'hui.</p>
            </div>
            
            <!-- Stats/KPI Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Card 1 -->
                <div class="flex flex-col gap-4 rounded-xl p-5 bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-primary">
                            <span class="material-symbols-outlined icon-filled">description</span>
                        </div>
                        <span class="text-xs font-medium px-2 py-1 bg-green-50 text-green-700 rounded-full flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">trending_up</span> +5%
                        </span>
                    </div>
                    <div>
                        <p class="text-[#4c669a] dark:text-gray-400 text-sm font-medium">Feuilles Scannées</p>
                        <p class="text-[#0d121b] dark:text-white text-2xl font-bold mt-1">{{ number_format($stats['scanned_documents']) }}</p>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="flex flex-col gap-4 rounded-xl p-5 bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="p-2 bg-purple-50 dark:bg-purple-900/20 rounded-lg text-purple-600">
                            <span class="material-symbols-outlined icon-filled">view_module</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-[#4c669a] dark:text-gray-400 text-sm font-medium">Modules Actifs</p>
                        <p class="text-[#0d121b] dark:text-white text-2xl font-bold mt-1">{{ $stats['active_modules'] }}</p>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="flex flex-col gap-4 rounded-xl p-5 bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="p-2 bg-orange-50 dark:bg-orange-900/20 rounded-lg text-orange-600">
                            <span class="material-symbols-outlined icon-filled">pending_actions</span>
                        </div>
                        <span class="text-xs font-medium px-2 py-1 bg-orange-50 text-orange-700 rounded-full flex items-center gap-1">
                            {{ $stats['pending_validations'] }} en attente
                        </span>
                    </div>
                    <div>
                        <p class="text-[#4c669a] dark:text-gray-400 text-sm font-medium">Validations Requises</p>
                        <p class="text-[#0d121b] dark:text-white text-2xl font-bold mt-1">{{ $stats['pending_validations'] }}</p>
                    </div>
                </div>
                
                <!-- Card 4 -->
                <div class="flex flex-col gap-4 rounded-xl p-5 bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="p-2 bg-red-50 dark:bg-red-900/20 rounded-lg text-red-600">
                            <span class="material-symbols-outlined icon-filled">warning</span>
                        </div>
                        <span class="size-2 rounded-full bg-red-500 animate-pulse"></span>
                    </div>
                    <div>
                        <p class="text-[#4c669a] dark:text-gray-400 text-sm font-medium">Alertes Système</p>
                        <p class="text-[#0d121b] dark:text-white text-2xl font-bold mt-1">{{ $stats['system_alerts'] }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Main Grid: Activity & Chart -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Left Column (Activity & Lists) -->
                <div class="xl:col-span-2 space-y-8">
                    <!-- Recent Activity Table -->
                    @include('dashboard.partials.recent-activity', ['activities' => $recentActivities])
                    
                    <!-- Analytics Chart -->
                    @include('dashboard.partials.grade-chart', ['distribution' => $gradeDistribution])
                </div>
                
                <!-- Right Column (Quick Actions & Alerts) -->
                <div class="space-y-8">
                    @include('dashboard.partials.quick-actions')
                    @include('dashboard.partials.alerts')
                </div>
            </div>
        </div>
    </main>
</div>
@endsection