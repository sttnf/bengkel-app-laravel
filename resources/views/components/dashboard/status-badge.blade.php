{{-- Status Badge Component --}}
@props(['status'])

@php
$statusConfig = [
    'completed' => 'bg-green-100 text-green-800',
    'in_progress' => 'bg-blue-100 text-blue-800',
    'pending' => 'bg-yellow-100 text-yellow-800',
    'cancelled' => 'bg-red-100 text-red-800',
];

$class = $statusConfig[$status] ?? 'bg-gray-100 text-gray-800';
$label = ucfirst(str_replace('_', ' ', $status));
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $class }}">
    {{ $label }}
</span>
