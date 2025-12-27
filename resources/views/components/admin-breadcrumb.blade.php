@props(['items' => []])

<nav class="bg-white border-b border-gray-200 py-3 shadow-sm mb-6" aria-label="Breadcrumb">
    <div class="container mx-auto px-6">
        <ol class="flex items-center flex-wrap space-x-2 text-sm">
            <!-- Dashboard Home -->
            <li class="flex items-center">
                @if(auth()->user()->access_rights === 'Admin' || auth()->user()->access_rights === 'Teacher')
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-primary-600 transition-all duration-200 flex items-center group">
                        <i class="fas fa-home mr-1.5 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('student.dashboard') }}" class="text-gray-600 hover:text-primary-600 transition-all duration-200 flex items-center group">
                        <i class="fas fa-home mr-1.5 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                @endif
            </li>

            @foreach($items as $index => $item)
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>

                    @if(isset($item['url']) && !$loop->last)
                        <a href="{{ $item['url'] }}" class="text-gray-600 hover:text-primary-600 transition-all duration-200 hover:underline flex items-center">
                            @if(isset($item['icon']))
                                <i class="{{ $item['icon'] }} mr-1.5"></i>
                            @endif
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="text-gray-900 font-semibold flex items-center">
                            @if(isset($item['icon']))
                                <i class="{{ $item['icon'] }} mr-1.5 text-primary-600"></i>
                            @endif
                            {{ $item['label'] }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</nav>
