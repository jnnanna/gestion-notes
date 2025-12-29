@props([
    'title' => '',
    'value' => 0,
    'icon' => null,
    'iconBg' => 'blue', // blue, green, orange, red, purple
    'subtitle' => null,
    'trend' => null, // up, down, neutral
    'trendValue' => null,
])

@php
    $iconBgClasses = [
        'blue' => 'bg-blue-50 dark:bg-blue-900/20 text-[#135bec]',
        'green' => 'bg-green-50 dark:bg-green-900/20 text-green-600',
        'orange' => 'bg-orange-50 dark:bg-orange-900/20 text-orange-600',
        'red' => 'bg-red-50 dark:bg-red-900/20 text-red-600',
        'purple' => 'bg-purple-50 dark:bg-purple-900/20 text-purple-600',
    ];
    
    $trendClasses = [
        'up' => 'text-green-600 dark:text-green-400',
        'down' => 'text-red-600 dark:text-red-400',
        'neutral' => 'text-[#4c669a] dark:text-gray-400',
    ];
@endphp

<div class="p-6 rounded-xl bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
    <div class="flex items-center justify-between mb-4">
        <span class="text-sm font-semibold text-[#4c669a] dark:text-gray-400 uppercase tracking-wider">{{ $title }}</span>
        @if($icon)
            <span class="p-2 rounded-lg {{ $iconBgClasses[$iconBg] }}">
                <span class="material-symbols-outlined text-[20px] icon-filled">{{ $icon }}</span>
            </span>
        @endif
    </div>
    
    <div class="space-y-2">
        <span class="text-3xl font-bold text-[#0d121b] dark:text-white">{{ $value }}</span>
        
        @if($subtitle)
            <p class="text-xs text-[#4c669a] dark:text-gray-400">{{ $subtitle }}</p>
        @endif
        
        @if($trend && $trendValue)
            <div class="flex items-center gap-1 {{ $trendClasses[$trend] }} text-xs font-medium">
                <span class="material-symbols-outlined text-[14px]">
                    @if($trend === 'up') trending_up
                    @elseif($trend === 'down') trending_down
                    @else remove
                    @endif
                </span>
                {{ $trendValue }}
            </div>
        @endif
    </div>
</div>