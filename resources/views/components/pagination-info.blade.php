@props(['paginator'])

@if($paginator->total() > 0)
<div {{ $attributes->merge(['class' => 'flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6']) }}>
    <div class="flex flex-1 justify-between sm:hidden">
        <span class="text-sm text-gray-700">
            Showing <span class="font-medium">{{ $paginator->firstItem() }}</span> to <span class="font-medium">{{ $paginator->lastItem() }}</span> of <span class="font-medium">{{ $paginator->total() }}</span> results
        </span>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium">{{ $paginator->total() }}</span>
                results
            </p>
        </div>
        <div>
            {{ $paginator->links() }}
        </div>
    </div>
</div>
@endif
