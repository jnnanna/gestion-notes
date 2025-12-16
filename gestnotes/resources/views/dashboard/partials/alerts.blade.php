{{-- gestnotes/resources/views/dashboard/partials/alerts.blade.php --}}
<div class="bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm p-5">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-base font-bold text-[#0d121b] dark:text-white flex items-center gap-2">
            <span class="material-symbols-outlined text-orange-500">notifications_active</span>
            Alertes Récentes
        </h3>
        <span class="text-xs bg-orange-100 text-orange-700 px-2 py-0.5 rounded-full font-bold">2</span>
    </div>
    <div class="space-y-3">
        <div class="flex gap-3 items-start p-3 rounded-lg bg-orange-50 dark:bg-orange-900/10 border border-orange-100 dark:border-orange-900/20">
            <span class="material-symbols-outlined text-orange-600 text-[20px] mt-0.5">warning</span>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-[#0d121b] dark:text-white">Validation en attente</p>
                <p class="text-xs text-[#4c669a] dark:text-gray-400 mt-0.5">3 notes nécessitent votre validation</p>
                <p class="text-xs text-orange-600 font-medium mt-1">Il y a 2 heures</p>
            </div>
        </div>
        <div class="flex gap-3 items-start p-3 rounded-lg bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/20">
            <span class="material-symbols-outlined text-red-600 text-[20px] mt-0.5">error</span>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-[#0d121b] dark:text-white">Erreur de traitement</p>
                <p class="text-xs text-[#4c669a] dark:text-gray-400 mt-0.5">Le scan "Physique_S1.pdf" n'a pas pu être traité</p>
                <p class="text-xs text-red-600 font-medium mt-1">Il y a 5 heures</p>
            </div>
        </div>
    </div>
</div>