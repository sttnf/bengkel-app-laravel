{{-- Summary Card Component --}}
@props(['title'])

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $title }}</h3>
    <div class="space-y-4">
        {{ $slot }}
    </div>
</div>
