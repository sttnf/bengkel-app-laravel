@props([
    'title',
    'items' => [],
    'showAll' => null,
    'emptyMessage' => 'No items found.'
])

<div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
    <div class="px-6 py-4 border-b border-gray-100">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
            @if($showAll)
                <a href="{{ $showAll }}" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">
                    View all
                    <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            @endif
        </div>
    </div>
    
    <div class="px-6 py-4">
        @if(count($items) > 0)
            <div class="space-y-4">
                {{ $slot }}
            </div>
        @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="mt-2 text-sm text-gray-500">{{ $emptyMessage }}</p>
            </div>
        @endif
    </div>
</div>
