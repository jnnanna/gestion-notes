@props([
    'variant' => 'default', // default, success, warning, danger, info
    'dot' => false,
])
@php
    $variantClasses = [
        'default' => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300 border-gray-200 dark:border-gray-700',
        'success' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 border-green-200 dark:border-green-800/50',
        'warning' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400 border-orange-200 dark:border-orange-800/50',
        'danger' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 border-red-200 dark:border-red-800/50',
        'info' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 border-blue-200 dark:border-blue-800/50',
    ];

    $dotColors = [
        'default' => 'bg-gray-500',
        'success' => 'bg-green-500',
        'warning' => 'bg-orange-500',
        'danger' => 'bg-red-500',
        'info' => 'bg-blue-500',
    ];
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium border ' . ($variantClasses[$variant] ?? $variantClasses['default'])]) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColors[$variant] ?? $dotColors['default'] }}"></span>
    @endif
    {{ $slot }}
</span>