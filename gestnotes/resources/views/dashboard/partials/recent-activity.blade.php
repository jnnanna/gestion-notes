{{-- gestnotes/resources/views/dashboard/partials/recent-activity.blade.php --}}
<div class="flex flex-col gap-4 bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between p-5 border-b border-[#e7ebf3] dark:border-gray-800">
        <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">Activités Récentes</h3>
        <button class="text-sm font-medium text-primary hover:text-blue-700 transition">Tout voir</button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#f8f9fc] dark:bg-gray-800/50 text-[#4c669a] dark:text-gray-400 text-xs uppercase tracking-wider">
                    <th class="px-6 py-4 font-medium">Module</th>
                    <th class="px-6 py-4 font-medium">Professeur</th>
                    <th class="px-6 py-4 font-medium">Date</th>
                    <th class="px-6 py-4 font-medium">Statut</th>
                    <th class="px-6 py-4 font-medium text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#e7ebf3] dark:divide-gray-800">
                @forelse($activities as $activity)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="size-8 rounded bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary font-bold text-xs">
                                {{ strtoupper(substr($activity->module->code, 0, 2)) }}
                            </div>
                            <span class="text-sm font-medium text-[#0d121b] dark:text-white">{{ $activity->module->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-[#4c669a] dark:text-gray-400">
                        {{ $activity->module->responsible->full_name ?? 'Non assigné' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-[#4c669a] dark:text-gray-400">
                        {{ $activity->updated_at->format('d M, H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($activity->status === 'validated')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                <span class="size-1.5 rounded-full bg-green-600"></span> Sécurisé
                            </span>
                        @elseif($activity->status === 'pending')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                                <span class="size-1.5 rounded-full bg-yellow-600"></span> Traitement
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                <span class="size-1.5 rounded-full bg-red-600"></span> Erreur
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-gray-400 hover:text-primary transition">
                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-sm text-[#4c669a]">
                        Aucune activité récente
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>