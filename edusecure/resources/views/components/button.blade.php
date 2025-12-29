@props([
    'type' => 'button',
    'variant' => 'primary', // primary, secondary, danger, success
    'size' => 'md', // sm, md, lg
    'icon' => null,
    'iconPosition' => 'left', // left, right
    'disabled' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-offset-2';

    $variantClasses = [
        'primary' => 'bg-[#135bec] text-white hover:bg-[#0f4bc4] focus:ring-[#135bec] shadow-md shadow-[#135bec]/20',
        'secondary' => 'bg-white dark:bg-[#1a2234] text-[#0d121b] dark:text-white border border-[#e7ebf3] dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 focus:ring-gray-300',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500 shadow-md shadow-red-500/20',
        'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500 shadow-md shadow-green-500/20',
    ];

    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-xs gap-1.5',
        'md' => 'px-4 py-2.5 text-sm gap-2',
        'lg' => 'px-6 py-3 text-base gap-2. 5',
    ];

    $disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '';

    $classes = $baseClasses . ' ' . $variantClasses[$variant] . ' ' . $sizeClasses[$size] . ' ' . $disabledClasses;
@endphp
<button 
type="{{ $type }}" 
    {{ $attributes->merge(['class' => $classes]) }}
@if($disabled) disabled @endif
>
@if($icon && $iconPosition === 'left')
    <span class="material-symbols-outlined text-[20px]">{{ $icon }}</span>
@endif
    
    {{ $slot }}
    
    @if($icon && $iconPosition === 'right')
        <span class="material-symbols-outlined text-[20px]">{{ $icon }}</span>
    @endif
</button>