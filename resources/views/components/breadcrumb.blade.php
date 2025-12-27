@props(['items' => []])

<nav class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100 py-4 shadow-sm" aria-label="Breadcrumb">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ol class="flex items-center flex-wrap space-x-2 text-sm">
            <li class="flex items-center">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 transition-all duration-200 flex items-center group">
                    <i class="fas fa-home mr-1.5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium hidden sm:inline">Home</span>
                </a>
            </li>

            @foreach($items as $index => $item)
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-blue-300 text-xs mx-2"></i>

                    @if(isset($item['url']) && !$loop->last)
                        <a href="{{ $item['url'] }}" class="text-blue-600 hover:text-blue-800 transition-all duration-200 hover:underline">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="text-blue-900 font-semibold flex items-center">
                            @if(isset($item['icon']))
                                <i class="{{ $item['icon'] }} mr-1.5 text-blue-700"></i>
                            @endif
                            {{ $item['label'] }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</nav>
