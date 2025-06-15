{{-- Action Button Component --}}
@props(['href' => null, 'color' => 'indigo', 'icon' => 'plus', 'type' => 'link', 'onclick' => null])

@php
$colors = [
    'indigo' => 'bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500',
    'green' => 'bg-green-600 hover:bg-green-700 focus:ring-green-500',
    'yellow' => 'bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-500',
    'gray' => 'bg-gray-100 text-gray-700 hover:bg-gray-200 focus:ring-gray-500',
];

$icons = [
    'plus' => 'M12 6v6m0 0v6m0-6h6m-6 0H6',
    'clipboard' => 'M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M9 5a2 2 0 002 2h2a2 2 0 002-2V3a2 2 0 00-2-2h-4a2 2 0 00-2 2v2z',
    'credit-card' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z',
    'refresh' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
];

$colorClass = $colors[$color] ?? $colors['indigo'];
$iconPath = $icons[$icon] ?? $icons['plus'];
$textColor = $color === 'gray' ? '' : 'text-white';
@endphp

@if($type === 'button')
    <button 
        @if($onclick) onclick="{{ $onclick }}" @endif
        class="inline-flex items-center px-4 py-2 {{ $colorClass }} {{ $textColor }} text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors"
    >
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"></path>
        </svg>
        {{ $slot }}
    </button>
@else
    <a 
        href="{{ $href }}"
        class="inline-flex items-center px-4 py-2 {{ $colorClass }} {{ $textColor }} text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors"
    >
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"></path>
        </svg>
        {{ $slot }}
    </a>
@endif
