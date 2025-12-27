@props(['href' => '#', 'icon' => null])

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => 'flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150']) }}>

    @if($icon)
    <i class="{{ $icon }} w-5 text-gray-500 mr-3"></i>
    @endif

    <span>{{ $slot }}</span>
</a>
