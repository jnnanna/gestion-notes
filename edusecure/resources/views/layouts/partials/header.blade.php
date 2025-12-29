<header
    class="flex items-center justify-between whitespace-nowrap border-b border-solid border-[#e7ebf3] dark:border-gray-800 bg-white dark:bg-[#1a2234] px-6 py-4 z-10">
    <div class="flex items-center gap-4">
        <!-- Mobile Menu Button -->
        <button class="md:hidden p-2 text-gray-600 dark:text-gray-400">
            <span class="material-symbols-outlined">menu</span>
        </button>

        <!-- Page Title -->
        <h2 class="text-[#0d121b] dark:text-white text-xl font-bold leading-tight tracking-tight hidden sm:block">
            @yield('page-title', 'Tableau de Bord')
        </h2>
    </div>

    <div class="flex items-center gap-4 sm:gap-8">
        <!-- Search Bar -->
        <label class="hidden md:flex flex-col min-w-40 !h-10 max-w-64">
            <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                <div
                    class="text-[#4c669a] flex border-none bg-[#f8f9fc] dark:bg-gray-800 items-center justify-center pl-4 rounded-l-lg border-r-0">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </div>
                <input
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] dark:text-white focus:outline-0 focus:ring-0 border-none bg-[#f8f9fc] dark:bg-gray-800 focus:border-none h-full placeholder:text-[#4c669a] px-4 rounded-l-none border-l-0 pl-2 text-sm font-normal leading-normal"
                    placeholder="Rechercher..." type="text" />
            </div>
        </label>

        <div class="flex items-center gap-3">
            <!-- Notifications -->
            <a href="{{ route('notifications.index') }}"
                class="relative flex size-10 cursor-pointer items-center justify-center overflow-hidden rounded-full hover:bg-[#f8f9fc] dark:hover:bg-gray-800 text-[#0d121b] dark:text-white transition">
                <span class="material-symbols-outlined text-[24px]">notifications</span>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span
                        class="absolute top-2 right-2 size-2 bg-red-500 rounded-full border-2 border-white dark:border-[#1a2234]"></span>
                @endif
            </a>

            <div class="h-8 w-px bg-[#e7ebf3] dark:bg-gray-700 mx-1"></div>

            <!-- User Profile -->
            <a href="{{ route('profil.index') }}"
                class="flex items-center gap-3 pl-1 hover:opacity-80 transition-opacity">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-9 border-2 border-white shadow-sm"
                    style="background-image: url('{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=135bec&background=f0f0f0' }}');">
                </div>
                <div class="hidden lg:flex flex-col">
                    <p class="text-sm font-bold text-[#0d121b] dark:text-white leading-none">{{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-[#4c669a] mt-1 leading-none">
                        {{ auth()->user()->roles->first()->name ?? 'Utilisateur' }}</p>
                </div>
            </a>
        </div>
    </div>
</header>