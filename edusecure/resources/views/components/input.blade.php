@props([
    'type' => 'text',
    'name' => '',
    'label' => null,
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'icon' => null,
    'error' => null,
    'helper' => null,
])

<div class="space-y-1. 5">
    @if($label)
        <label for="{{ $name }}" class="text-sm font-semibold text-[#0d121b] dark:text-white">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <div class="relative">
        @if($icon)
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#4c669a] text-[20px]">{{ $icon }}</span>
        @endif
        
        <input 
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            @if($required) required @endif
            {{ $attributes->merge([
                'class' => 'w-full rounded-lg border bg-[#f8f9fc] dark:bg-gray-800 text-sm text-[#0d121b] dark:text-white focus:ring-[#135bec] focus:border-[#135bec] placeholder: text-[#4c669a] ' . 
                ($icon ? 'pl-10 pr-4' : 'px-4') . ' py-2.5 ' . 
                ($error ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-[#e7ebf3] dark:border-gray-700')
            ]) }}
        />
    </div>
    
    @if($helper)
        <p class="text-xs text-[#4c669a] dark:text-gray-400 ml-1">{{ $helper }}</p>
    @endif
    
    @if($error)
        <p class="text-xs text-red-500 ml-1 flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">error</span>
            {{ $error }}
        </p>
    @endif
    
    @error($name)
        <p class="text-xs text-red-500 ml-1 flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">error</span>
            {{ $message }}
        </p>
    @enderror
</div>