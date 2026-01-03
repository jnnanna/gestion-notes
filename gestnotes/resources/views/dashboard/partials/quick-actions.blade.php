{{-- gestnotes/resources/views/dashboard/partials/quick-actions.blade.php --}}
<div class="flex flex-col gap-4">
    <h3 class="text-lg font-bold text-[#0d121b] dark:text-white px-1">Actions Rapides</h3>
    <div class="grid grid-cols-1 gap-3">
        <!-- Action 1 -->
        <button class="group flex items-center p-4 bg-primary text-white rounded-xl shadow-lg shadow-blue-200 dark:shadow-none hover:shadow-xl hover:bg-blue-700 transition-all">
            <div class="bg-white/20 p-3 rounded-lg mr-4 group-hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-[24px]">add_a_photo</span>
            </div>
            <div class="text-left">
                <p class="font-bold text-lg leading-tight">Nouveau Scan</p>
                <p class="text-blue-100 text-xs mt-0.5">Démarrer numérisation</p>
            </div>
            <span class="material-symbols-outlined ml-auto opacity-70">arrow_forward</span>
        </button>
        <!-- Action 2 -->
        <button class="group flex items-center p-4 bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl hover:border-primary/50 dark:hover:border-primary/50 transition-all text-[#0d121b] dark:text-white">
            <div class="bg-blue-50 dark:bg-blue-900/20 text-primary p-3 rounded-lg mr-4 group-hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-[24px]">upload_file</span>
            </div>
            <div class="text-left">
                <p class="font-bold text-base leading-tight">Upload PDF</p>
                <p class="text-[#4c669a] dark:text-gray-400 text-xs mt-0.5">Importer fichier existant</p>
            </div>
        </button>
        <!-- Action 3 -->
        <button class="group flex items-center p-4 bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 rounded-xl hover:border-primary/50 dark:hover:border-primary/50 transition-all text-[#0d121b] dark:text-white">
            <div class="bg-purple-50 dark:bg-purple-900/20 text-purple-600 p-3 rounded-lg mr-4 group-hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-[24px]">assessment</span>
            </div>
            <div class="text-left">
                <p class="font-bold text-base leading-tight">Générer Rapport</p>
                <p class="text-[#4c669a] dark:text-gray-400 text-xs mt-0.5">Statistiques globales</p>
            </div>
        </button>
    </div>
</div>