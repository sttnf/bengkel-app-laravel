{{-- Summary Item Component --}}
@props(['label', 'value', 'color' => 'text-gray-900', 'bold' => false, 'semibold' => false])

@php
$weightClass = $bold ? 'font-bold' : ($semibold ? 'font-semibold' : 'font-medium');
@endphp

<div class="flex justify-between items-center">
    <span class="text-sm text-gray-600">{{ $label }}</span>
    <span class="text-lg {{ $weightClass }} {{ $color }}">{{ $value }}</span>
</div>
