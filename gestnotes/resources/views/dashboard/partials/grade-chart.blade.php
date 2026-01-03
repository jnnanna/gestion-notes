{{-- gestnotes/resources/views/dashboard/partials/grade-chart.blade.php --}}
<div class="flex flex-col gap-4 bg-white dark:bg-[#1a2234] rounded-xl border border-[#e7ebf3] dark:border-gray-800 shadow-sm p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-bold text-[#0d121b] dark:text-white">Répartition des Moyennes</h3>
        <select class="bg-[#f8f9fc] dark:bg-gray-800 border-none rounded-lg text-xs font-medium px-3 py-1.5 focus:ring-0">
            <option>Ce Semestre</option>
            <option>Année Dernière</option>
        </select>
    </div>
    <!-- Chart Visual -->
    <div class="relative w-full h-48 flex items-end justify-between gap-2 px-2">
        <!-- Background Lines -->
        <div class="absolute inset-0 flex flex-col justify-between z-0">
            <div class="w-full h-px bg-gray-100 dark:bg-gray-800"></div>
            <div class="w-full h-px bg-gray-100 dark:bg-gray-800"></div>
            <div class="w-full h-px bg-gray-100 dark:bg-gray-800"></div>
            <div class="w-full h-px bg-gray-100 dark:bg-gray-800"></div>
            <div class="w-full h-px bg-gray-100 dark:bg-gray-800"></div>
        </div>
        <!-- Bars -->
        @php
            $max = max(array_values($distribution));
            $ranges = ['10-12', '12-14', '14-16', '16-18', '18-20'];
        @endphp
        @foreach($ranges as $range)
            @php
                $count = $distribution[$range] ?? 0;
                $height = $max > 0 ? ($count / $max * 100) : 0;
                $opacity = $range === '14-16' ? '100' : ($range === '12-14' || $range === '16-18' ? '60' : '20');
            @endphp
            <div class="relative z-10 w-full bg-primary/{{ $opacity }} rounded-t-sm hover:bg-primary/{{ min($opacity + 10, 100) }} transition-all cursor-pointer group" style="height: {{ $height }}%;">
                <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                    {{ $count }}
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex justify-between px-2 text-xs text-[#4c669a] font-medium mt-2">
        @foreach($ranges as $range)
            <span>{{ $range }}</span>
        @endforeach
    </div>
</div>