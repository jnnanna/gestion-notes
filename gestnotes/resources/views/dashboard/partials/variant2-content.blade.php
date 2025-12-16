{{-- gestnotes/resources/views/dashboard/partials/variant2-content.blade.php --}}
<div>
  <div>
    <h1 class="text-2xl md:text-3xl font-bold text-[#0d121b] dark:text-white tracking-tight">
      Bonjour, {{ Auth::user()->full_name }}
    </h1>
    <p class="text-[#4c669a] dark:text-gray-400 mt-1">Vue alternative du tableau de bord.</p>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
    <div class="lg:col-span-2 space-y-6">
      <div class="grid grid-cols-3 gap-4">
        <div class="p-4 bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm">
          <h4 class="text-sm text-gray-500">Documents numérisés</h4>
          <div class="text-2xl font-bold mt-2">{{ number_format($stats['scanned_documents'] ?? 0) }}</div>
        </div>
        <div class="p-4 bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm">
          <h4 class="text-sm text-gray-500">Modules actifs</h4>
          <div class="text-2xl font-bold mt-2">{{ $stats['active_modules'] ?? 0 }}</div>
        </div>
        <div class="p-4 bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm">
          <h4 class="text-sm text-gray-500">En attente</h4>
          <div class="text-2xl font-bold mt-2">{{ $stats['pending_validations'] ?? 0 }}</div>
        </div>
      </div>

      <div class="bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm p-4">
        <h3 class="font-semibold mb-3">Répartition des notes</h3>
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 text-center">
          @foreach($gradeDistribution as $label => $count)
            <div class="p-3 bg-gray-50 dark:bg-transparent rounded">
              <div class="text-sm text-gray-500">{{ $label }}</div>
              <div class="text-lg font-bold mt-1">{{ $count }}</div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm p-4">
        <h3 class="font-semibold mb-3">Dernières notes saisies</h3>
        <div class="divide-y">
          @forelse($recentActivities as $grade)
            <div class="py-3 flex justify-between items-center">
              <div>
                <div class="font-medium">
                  {{ $grade->student->first_name ?? 'Étudiant' }} {{ $grade->student->last_name ?? '' }}
                </div>
                <div class="text-sm text-gray-500">{{ $grade->module->name ?? 'Module' }}</div>
              </div>
              <div class="text-right">
                <div class="text-xl font-semibold">{{ number_format($grade->final_grade ?? $grade->value ?? 0, 2) }}</div>
                <div class="text-sm text-gray-400">{{ optional($grade->created_at)->format('d/m/Y') }}</div>
              </div>
            </div>
          @empty
            <div class="py-3 text-sm text-gray-500">Aucune note récente.</div>
          @endforelse
        </div>
      </div>
    </div>

    <aside class="space-y-6">
      @include('dashboard.partials.quick-actions')
      @include('dashboard.partials.alerts')

      <div class="bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm p-4 text-center">
        <h4 class="font-semibold mb-1">Statistiques globales</h4>
        <div class="text-3xl font-bold">{{ $stats['total_students'] ?? 0 }}</div>
        <div class="text-sm text-gray-500 mt-1">étudiants inscrits</div>
      </div>
    </aside>
  </div>
</div>