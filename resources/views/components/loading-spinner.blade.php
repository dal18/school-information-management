@props(['size' => 'md', 'color' => 'primary'])

@php
$sizeClasses = [
    'sm' => 'w-4 h-4',
    'md' => 'w-8 h-8',
    'lg' => 'w-12 h-12',
    'xl' => 'w-16 h-16',
];

$colorClasses = [
    'primary' => 'border-primary-600',
    'secondary' => 'border-secondary-600',
    'accent' => 'border-accent-600',
    'white' => 'border-white',
];
@endphp

<div class="inline-block {{ $sizeClasses[$size] }} animate-spin rounded-full border-4 border-gray-200 {{ $colorClasses[$color] }} border-t-transparent" role="status">
    <span class="sr-only">Loading...</span>
</div>
