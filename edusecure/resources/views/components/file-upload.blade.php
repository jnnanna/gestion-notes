@props([
    'name' => 'file',
    'label' => null,
    'accept' => null,
    'multiple' => false,
    'required' => false,
    'helper' => null,
])

<div class="space-y-2" x-data="{ files: null }">
    @if($label)
        <label class="text-sm font-semibold text-[#0d121b] dark:text-white">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <input 
            type="file"
            name="{{ $name }}"
            id="{{ $name }}"
            @if($accept) accept="{{ $accept }}" @endif
            @if($multiple) multiple @endif
            @if($required) required @endif
            x-on:change="files = $event.target.files"
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
        />

        <div class="flex flex-col items-center justify-center gap-4 rounded-lg border-2 border-dashed border-[#e7ebf3] dark:border-gray-600 bg-[#f8f9fc] dark:bg-gray-800/50 px-6 py-10 transition-colors hover:border-[#135bec]/50 hover:bg-[#135bec]/5 cursor-pointer">
            <div class="size-16 rounded-full bg-white dark:bg-gray-700 shadow-sm flex items-center justify-center text-[#135bec]">
                <span class="material-symbols-outlined text-[32px]">cloud_upload</span>
            </div>

            <div class="flex flex-col items-center gap-1 text-center">
                <p class="text-[#0d121b] dark:text-white text-base font-bold">
                    <span x-show="! files">Glissez vos fichiers ici</span>
                    <span x-show="files" x-text="files.length + ' fichier(s) sélectionné(s)'"></span>
                </p>
                <p class="text-[#4c669a] dark:text-gray-400 text-sm">ou cliquez pour parcourir</p>
            </div>

            @if($accept)
                <div class="flex flex-wrap justify-center gap-2">
                    @foreach(explode(',', $accept) as $type)
                        <span class="px-3 py-1 bg-white dark:bg-gray-700 rounded border border-[#e7ebf3] dark:border-gray-600 text-xs text-[#4c669a] dark:text-gray-400 font-medium">
                            {{ strtoupper(trim(str_replace('.', '', $type))) }}
                        </span>
                    @endforeach
                </div>
            @endif

            @if($helper)
                <p class="text-[#4c669a] dark:text-gray-500 text-xs">{{ $helper }}</p>
            @endif
        </div>
    </div>

    @error($name)
        <p class="text-xs text-red-500 ml-1 flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">error</span>
            {{ $message }}
        </p>
    @enderror
</div>