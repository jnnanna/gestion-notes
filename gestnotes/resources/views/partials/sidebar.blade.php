{{-- gestnotes/resources/views/partials/sidebar.blade.php --}}
<aside class="hidden md:flex flex-col w-64 h-full bg-white dark:bg-[#1a2234] border-r border-[#e7ebf3] dark:border-gray-800 p-4 justify-between transition-colors duration-200">
    <div class="flex flex-col gap-6">
        <!-- Logo -->
        <div class="flex items-center gap-3 px-2">
            <div class="flex items-center justify-center size-10 rounded-xl bg-primary text-white">
                <span class="material-symbols-outlined icon-filled">security</span>
            </div>
            <div class="flex flex-col">
                <h1 class="text-lg font-bold leading-none tracking-tight">EduSecure</h1>
                <p class="text-[#4c669a] dark:text-gray-400 text-xs font-normal mt-1">Admin Panel</p>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="flex flex-col gap-2">
            <a class="flex items-center gap-3 px-3 py-3 rounded-lg bg-primary/10 text-primary dark:text-primary-400 group transition-colors" href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined icon-filled text-[24px]">dashboard</span>
                <p class="text-sm font-medium leading-normal">Tableau de Bord</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-[#4c669a] dark:text-gray-400 hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition-colors" href="#">
                <span class="material-symbols-outlined text-[24px]">document_scanner</span>
                <p class="text-sm font-medium leading-normal">Scanner / Upload</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-[#4c669a] dark:text-gray-400 hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition-colors" href="#">
                <span class="material-symbols-outlined text-[24px]">description</span>
                <p class="text-sm font-medium leading-normal">Feuilles de Notes</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-[#4c669a] dark:text-gray-400 hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition-colors" href="#">
                <span class="material-symbols-outlined text-[24px]">inventory_2</span>
                <p class="text-sm font-medium leading-normal">Archives</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-[#4c669a] dark:text-gray-400 hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition-colors" href="#">
                <span class="material-symbols-outlined text-[24px]">settings</span>
                <p class="text-sm font-medium leading-normal">Paramètres</p>
            </a>
        </nav>
    </div>
    
    <!-- Bottom Action -->
    <div class="flex flex-col gap-2">
        <div class="p-4 rounded-xl bg-gradient-to-br from-primary to-blue-600 text-white shadow-lg">
            <div class="flex items-start justify-between mb-2">
                <span class="material-symbols-outlined">cloud_upload</span>
                <button class="size-6 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
            <p class="text-sm font-semibold mb-1">Stockage Sécurisé</p>
            <div class="w-full bg-white/20 rounded-full h-1.5 mb-2">
                <div class="bg-white h-1.5 rounded-full w-[75%]"></div>
            </div>
            <p class="text-xs text-white/80">7.5 GB / 10 GB utilisés</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-3 rounded-lg text-[#e73908] hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors">
                <span class="material-symbols-outlined text-[24px]">logout</span>
                <p class="text-sm font-medium leading-normal">Déconnexion</p>
            </button>
        </form>
    </div>
</aside>