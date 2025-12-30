@props([
    'title' => null,
    'subtitle' => null,
    'icon' => null,
    'padding' => true,
    'footer' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm overflow-hidden']) }}>
    @if($title || $icon)
        <div class="flex items-center justify-between px-6 py-4 border-b border-[#e7ebf3] dark:border-gray-800">
            <div class="flex items-center gap-3">
                @if($icon)
                    <div class="bg-[#135bec]/10 p-2 rounded-lg text-[#135bec]">
                        <span class="material-symbols-outlined">{{ $icon }}</span>
                    </div>
                @endif
                @if($title)
                    <div>
                        <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">{{ $title }}</h3>
                        @if($subtitle)
                            <p class="text-xs text-[#4c669a] dark:text-gray-400 mt-0.5">{{ $subtitle }}</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="{{ $padding ? 'p-6' : '' }}">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="px-6 py-4 bg-[#f8f9fc] dark:bg-gray-800/50 border-t border-[#e7ebf3] dark:border-gray-800">
            {{ $footer }}
        </div>
    @endif
</div>