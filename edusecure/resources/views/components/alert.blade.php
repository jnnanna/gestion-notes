@props([
    'type' => 'info', // success, error, warning, info
    'dismissible' => true,
    'icon' => null,
])
@php
    $types = [
        'success' => [
            'bg' => 'bg-green-50 dark:bg-green-900/10',
            'border' => 'border-green-100 dark:border-green-900/20',
            'text' => 'text-green-600',
            'icon' => 'check_circle',
        ],
        'error' => [
            'bg' => 'bg-red-50 dark:bg-red-900/10',
            'border' => 'border-red-100 dark:border-red-900/20',
            'text' => 'text-red-600',
            'icon' => 'error',
        ],
        'warning' => [
            'bg' => 'bg-orange-50 dark:bg-orange-900/10',
            'border' => 'border-orange-100 dark:border-orange-900/20',
            'text' => 'text-orange-600',
            'icon' => 'warning',
        ],
        'info' => [
            'bg' => 'bg-blue-50 dark:bg-blue-900/10',
            'border' => 'border-blue-100 dark:border-blue-900/20',
            'text' => 'text-blue-600',
            'icon' => 'info',
        ],
    ];

    $config = $types[$type] ?? $types['info'];
    $displayIcon = $icon ?? $config['icon'];
@endphp

<div {{ $attributes->merge(['class' => 'flex items-start gap-3 p-4 rounded-lg border ' . $config['bg'] . ' ' . $config['border']]) }} @if($dismissible) x-data="{ show: true }" x-show="show" @endif>
    <span class="material-symbols-outlined {{ $config['text'] }} text-[20px] mt-0.5">{{ $displayIcon }}</span>

    <div class="flex-1">
        {{ $slot }}
    </div>

    @if($dismissible)
        <button x-on:click="show = false" class="{{ $config['text'] }} hover:opacity-70 transition-opacity">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    @endif
</div>