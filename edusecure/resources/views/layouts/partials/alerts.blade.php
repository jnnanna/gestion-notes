@if(session('success'))
    <div
        class="flex items-start gap-3 p-4 rounded-lg bg-green-50 dark:bg-green-900/10 border border-green-100 dark:border-green-900/20 mb-6">
        <span class="material-symbols-outlined text-green-600 text-[20px] mt-0.5">check_circle</span>
        <div class="flex-1">
            <p class="text-sm font-semibold text-[#0d121b] dark: text-white">Succès</p>
            <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-1">{{ session('success') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-700">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div
        class="flex items-start gap-3 p-4 rounded-lg bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/20 mb-6">
        <span class="material-symbols-outlined text-red-600 text-[20px] mt-0.5">error</span>
        <div class="flex-1">
            <p class="text-sm font-semibold text-[#0d121b] dark:text-white">Erreur</p>
            <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-1">{{ session('error') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-700">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>
@endif

@if(session('warning'))
    <div
        class="flex items-start gap-3 p-4 rounded-lg bg-orange-50 dark:bg-orange-900/10 border border-orange-100 dark:border-orange-900/20 mb-6">
        <span class="material-symbols-outlined text-orange-600 text-[20px] mt-0.5">warning</span>
        <div class="flex-1">
            <p class="text-sm font-semibold text-[#0d121b] dark:text-white">Attention</p>
            <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-1">{{ session('warning') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-orange-600 hover:text-orange-700">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>
@endif

@if(session('info'))
    <div
        class="flex items-start gap-3 p-4 rounded-lg bg-blue-50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/20 mb-6">
        <span class="material-symbols-outlined text-blue-600 text-[20px] mt-0.5">info</span>
        <div class="flex-1">
            <p class="text-sm font-semibold text-[#0d121b] dark:text-white">Information</p>
            <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-1">{{ session('info') }}</p>
        </div>
        <button onclick="this. parentElement.remove()" class="text-blue-600 hover: text-blue-700">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>
@endif

@if($errors->any())
    <div
        class="flex items-start gap-3 p-4 rounded-lg bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/20 mb-6">
        <span class="material-symbols-outlined text-red-600 text-[20px] mt-0.5">error</span>
        <div class="flex-1">
            <p class="text-sm font-semibold text-[#0d121b] dark:text-white">Erreurs de validation</p>
            <ul class="mt-2 text-sm text-[#4c669a] dark: text-gray-400 list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-700">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>
@endif