<nav class="flex text-sm font-medium text-[#4c669a] dark:text-gray-400">
    @foreach($breadcrumbs as $index => $breadcrumb)
        @if($loop->last)
            <span class="text-[#0d121b] dark:text-white">{{ $breadcrumb['label'] }}</span>
        @else
            <a href="{{ $breadcrumb['url'] }}" class="hover:text-[#135bec] transition-colors">
                {{ $breadcrumb['label'] }}
            </a>
            <span class="mx-2">/</span>
        @endif
    @endforeach
</nav>