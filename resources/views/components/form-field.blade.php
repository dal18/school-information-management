@props([
    'label' => null,
    'name' => '',
    'type' => 'text',
    'value' => null,
    'required' => false,
    'placeholder' => '',
    'helpText' => null,
    'options' => [], // For select fields
    'rows' => 4, // For textarea
])

@php
    $id = $name . '_field';
    $classes = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent';
    $errorClasses = '@error("' . $name . '") border-red-500 @enderror';
@endphp

<div {{ $attributes->merge(['class' => 'mb-6']) }}>
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-2">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    @if($type === 'textarea')
        <textarea
            name="{{ $name }}"
            id="{{ $id }}"
            rows="{{ $rows }}"
            {{ $required ? 'required' : '' }}
            placeholder="{{ $placeholder }}"
            class="{{ $classes }} {{ $errorClasses }}"
        >{{ old($name, $value) }}</textarea>

    @elseif($type === 'select')
        <select
            name="{{ $name }}"
            id="{{ $id }}"
            {{ $required ? 'required' : '' }}
            class="{{ $classes }} {{ $errorClasses }}"
        >
            @if($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            @foreach($options as $optValue => $optLabel)
                <option value="{{ $optValue }}" {{ old($name, $value) == $optValue ? 'selected' : '' }}>
                    {{ $optLabel }}
                </option>
            @endforeach
        </select>

    @elseif($type === 'checkbox')
        <div class="flex items-center">
            <input
                type="checkbox"
                name="{{ $name }}"
                id="{{ $id }}"
                value="1"
                {{ old($name, $value) ? 'checked' : '' }}
                {{ $required ? 'required' : '' }}
                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
            @if($helpText)
                <label for="{{ $id }}" class="ml-2 block text-sm text-gray-700">
                    {{ $helpText }}
                </label>
            @endif
        </div>

    @elseif($type === 'radio')
        <div class="space-y-2">
            @foreach($options as $optValue => $optLabel)
                <div class="flex items-center">
                    <input
                        type="radio"
                        name="{{ $name }}"
                        id="{{ $id }}_{{ $optValue }}"
                        value="{{ $optValue }}"
                        {{ old($name, $value) == $optValue ? 'checked' : '' }}
                        {{ $required ? 'required' : '' }}
                        class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300">
                    <label for="{{ $id }}_{{ $optValue }}" class="ml-2 block text-sm text-gray-700">
                        {{ $optLabel }}
                    </label>
                </div>
            @endforeach
        </div>

    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}
            placeholder="{{ $placeholder }}"
            class="{{ $classes }} {{ $errorClasses }}"
        >
    @endif

    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror

    @if($helpText && !in_array($type, ['checkbox']))
        <p class="mt-1 text-xs text-gray-500">{{ $helpText }}</p>
    @endif
</div>
