@props([
    'name' => 'image',
    'label' => 'Image',
    'required' => false,
    'currentImage' => null,
    'defaultImage' => 'images/default-avatar.png',
    'accept' => 'image/jpeg,image/jpg,image/png,image/gif,image/webp',
    'maxSize' => '5MB',
    'recommendedSize' => '1200x800px',
    'previewClass' => 'w-32 h-32',
    'helpText' => null,
])

@php
    $id = $name . '_input';
    $previewId = $name . '_preview';
    $defaultHelpText = "JPG, PNG, GIF or WEBP. Max size: {$maxSize}" . ($recommendedSize ? ". Recommended: {$recommendedSize}" : "");
@endphp

<div {{ $attributes->merge(['class' => 'mb-6']) }}>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <div class="flex items-center space-x-4">
        <div class="flex-shrink-0">
            <img id="{{ $previewId }}"
                src="{{ $currentImage ? asset('storage/' . $currentImage) : asset($defaultImage) }}"
                alt="Preview"
                class="{{ $previewClass }} object-cover border-2 border-gray-300 rounded-lg"
                onerror="this.src='https://via.placeholder.com/128x128?text=Image'">
        </div>

        <div class="flex-grow">
            <input type="file"
                name="{{ $name }}"
                id="{{ $id }}"
                accept="{{ $accept }}"
                {{ $required ? 'required' : '' }}
                class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-primary-50 file:text-primary-700
                    hover:file:bg-primary-100
                    cursor-pointer border border-gray-300 rounded-lg
                    focus:ring-2 focus:ring-primary-500 focus:border-transparent
                    @error($name) border-red-500 @enderror">

            @error($name)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <p class="mt-1 text-xs text-gray-500">
                {{ $helpText ?? $defaultHelpText }}
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('{{ $id }}');
        const preview = document.getElementById('{{ $previewId }}');

        if (input && preview) {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endpush
