@props(['active' => false, 'href' => '#', 'icon' => null])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-white/10 rounded-lg transition-all duration-200'
            : 'inline-flex items-center px-3 py-2 text-sm font-medium text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
</a>
