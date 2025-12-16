{{-- gestnotes/resources/views/partials/header.blade.php --}}
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-[#e7ebf3] dark:border-gray-800 bg-white dark:bg-[#1a2234] px-6 py-4 z-10">
    <div class="flex items-center gap-4">
        <!-- Mobile Menu Button -->
        <button class="md:hidden p-2 text-gray-600">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <h2 class="text-[#0d121b] dark:text-white text-xl font-bold leading-tight tracking-tight hidden sm:block">Aperçu Général</h2>
    </div>
    <div class="flex items-center gap-4 sm:gap-8">
        <!-- Search -->
        <label class="hidden md:flex flex-col min-w-40 !h-10 max-w-64">
            <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                <div class="text-[#4c669a] flex border-none bg-[#f8f9fc] dark:bg-gray-800 items-center justify-center pl-4 rounded-l-lg border-r-0">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </div>
                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] dark:text-white focus:outline-0 focus:ring-0 border-none bg-[#f8f9fc] dark:bg-gray-800 focus:border-none h-full placeholder:text-[#4c669a] px-4 rounded-l-none border-l-0 pl-2 text-sm font-normal leading-normal" placeholder="Rechercher un étudiant, module..." value=""/>
            </div>
        </label>
        <div class="flex items-center gap-3">
            <button class="relative flex size-10 cursor-pointer items-center justify-center overflow-hidden rounded-full hover:bg-[#f8f9fc] dark:hover:bg-gray-800 text-[#0d121b] dark:text-white transition">
                <span class="material-symbols-outlined text-[24px]">notifications</span>
                <span class="absolute top-2 right-2 size-2 bg-red-500 rounded-full border-2 border-white dark:border-[#1a2234]"></span>
            </button>
            <div class="h-8 w-px bg-[#e7ebf3] dark:bg-gray-700 mx-1"></div>
            <div class="flex items-center gap-3 pl-1">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-9 border-2 border-white shadow-sm" style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->full_name) }}&background=135bec&color=fff');"></div>
                <div class="hidden lg:flex flex-col">
                    <p class="text-sm font-bold text-[#0d121b] dark:text-white leading-none">{{ Auth::user()->full_name }}</p>
                    <p class="text-xs text-[#4c669a] mt-1 leading-none">{{ Auth::user()->role->name ?? 'Utilisateur' }}</p>
                </div>
            </div>
        </div>
    </div>
</header>