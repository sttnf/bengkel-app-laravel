{{-- Today's Stat Item Component --}}
@props(['value', 'label'])

<div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
    <div class="text-3xl font-bold">{{ $value }}</div>
    <div class="text-sm text-indigo-100">{{ $label }}</div>
</div>
