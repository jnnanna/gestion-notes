@props([
    'name' => '',
    'label' => null,
    'checked' => false,
    'value' => '1',
])

<div class="flex items-center gap-3">
    <div class="relative flex items-center">
        <input 
            type="checkbox"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $value }}"
            @checked(old($name, $checked))
            {{ $attributes->merge([
                'class' => 'peer size-5 cursor-pointer appearance-none rounded border border-[#e7ebf3] dark:border-gray-600 bg-white dark:bg-gray-800 checked:bg-[#135bec] checked:border-[#135bec] transition-all focus:ring-2 focus:ring-[#135bec] focus:ring-offset-2'
            ]) }}
        />
        <span class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100">
            <span class="material-symbols-outlined text-[16px]">check</span>
        </span>
    </div>

    @if($label)
        <label for="{{ $name }}" class="text-sm text-[#0d121b] dark:text-white cursor-pointer select-none">
            {{ $label }}
        </label>
    @endif

    {{ $slot }}
</div>