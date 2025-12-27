@props([
    'src' => null,
    'alt' => '',
    'class' => '',
    'lazy' => true,
    'width' => null,
    'height' => null,
    'useThumbnail' => false,
])

@php
    // Initialize file upload service to get image variants
    $fileService = app(\App\Services\FileUploadService::class);
    $sources = $fileService->getResponsiveSources($src);

    // Determine which image to use
    $imageSrc = $useThumbnail && $sources['thumbnail'] ? $sources['thumbnail'] : $sources['original'];
    $webpSrc = $sources['webp'];
@endphp

@if($webpSrc && $src)
    {{-- Use picture element with WebP for better compression --}}
    <picture>
        <source srcset="{{ $webpSrc }}" type="image/webp" @if($lazy) loading="lazy" @endif>
        <img
            src="{{ $imageSrc }}"
            alt="{{ $alt }}"
            class="{{ $class }}"
            @if($width) width="{{ $width }}" @endif
            @if($height) height="{{ $height }}" @endif
            @if($lazy) loading="lazy" @endif
            {{ $attributes }}>
    </picture>
@else
    {{-- Fallback to regular img tag --}}
    <img
        src="{{ $imageSrc }}"
        alt="{{ $alt }}"
        class="{{ $class }}"
        @if($width) width="{{ $width }}" @endif
        @if($height) height="{{ $height }}" @endif
        @if($lazy) loading="lazy" @endif
        {{ $attributes }}>
@endif
