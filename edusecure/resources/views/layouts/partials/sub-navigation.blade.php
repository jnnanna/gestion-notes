<nav
    class="sticky top-0 z-20 w-full bg-white dark:bg-[#1a2234] border-b border-[#e7ebf3] dark:border-gray-800 px-6 overflow-x-auto shadow-sm">
    <ul class="flex items-center gap-6 md:gap-8 h-12 min-w-max">
        <!-- Tableau de Bord -->
        <li>
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2 h-12 text-sm {{ request()->routeIs('dashboard') ? 'font-bold text-[#135bec] border-b-2 border-[#135bec]' : 'font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#0d121b] dark:hover:text-white border-b-2 border-transparent hover:border-gray-200' }} transition-colors">
                <span
                    class="material-symbols-outlined text-[20px] {{ request()->routeIs('dashboard') ? 'icon-filled' : '' }}">dashboard</span>
                Tableau de Bord
            </a>
        </li>

        <!-- Gestion Modules & Filières -->
        <li>
            <a href="{{ route('modules.index') }}"
                class="flex items-center gap-2 h-12 text-sm {{ request()->routeIs('modules.*') || request()->routeIs('filieres.*') || request()->routeIs('departements.*') ? 'font-bold text-[#135bec] border-b-2 border-[#135bec]' : 'font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#0d121b] dark:hover:text-white border-b-2 border-transparent hover:border-gray-200' }} transition-colors">
                <span
                    class="material-symbols-outlined text-[20px] {{ request()->routeIs('modules.*') || request()->routeIs('filieres.*') || request()->routeIs('departements.*') ? 'icon-filled' : '' }}">view_module</span>
                Gestion Modules & Filières
            </a>
        </li>

        <!-- Importation & Numérisation -->
        <li>
            <a href="{{ route('importation.index') }}"
                class="flex items-center gap-2 h-12 text-sm {{ request()->routeIs('importation.*') ? 'font-bold text-[#135bec] border-b-2 border-[#135bec]' : 'font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#0d121b] dark: hover:text-white border-b-2 border-transparent hover: border-gray-200' }} transition-colors">
                <span
                    class="material-symbols-outlined text-[20px] {{ request()->routeIs('importation.*') ? 'icon-filled' : '' }}">document_scanner</span>
                Importation & Numérisation
            </a>
        </li>

        <!-- Validation des Notes -->
        <li>
            <a href="{{ route('validation.index') }}"
                class="flex items-center gap-2 h-12 text-sm {{ request()->routeIs('validation.*') ? 'font-bold text-[#135bec] border-b-2 border-[#135bec]' : 'font-medium text-[#4c669a] dark: text-gray-400 hover: text-[#0d121b] dark:hover:text-white border-b-2 border-transparent hover:border-gray-200' }} transition-colors">
                <span
                    class="material-symbols-outlined text-[20px] {{ request()->routeIs('validation.*') ? 'icon-filled' : '' }}">fact_check</span>
                Validation des Notes
            </a>
        </li>

        <!-- Exportation -->
        <li>
            <a href="{{ route('exportation.index') }}"
                class="flex items-center gap-2 h-12 text-sm {{ request()->routeIs('exportation.*') ? 'font-bold text-[#135bec] border-b-2 border-[#135bec]' : 'font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#0d121b] dark:hover: text-white border-b-2 border-transparent hover:border-gray-200' }} transition-colors">
                <span
                    class="material-symbols-outlined text-[20px] {{ request()->routeIs('exportation.*') ? 'icon-filled' : '' }}">file_download</span>
                Exportation
            </a>
        </li>
    </ul>
</nav>