@props([
    'label' => '',
    'model' => '',
    'options' => [],
    'error' => null,
    'disabled' => false,
])

@php
    use Illuminate\Support\Str;
    $error = $error ?? $model; // ✅ fallback if 'error' isn't explicitly passed
    $inputId = Str::slug($model ?? 'select') . '-' . uniqid();
@endphp

<div class="mb-4">
    @if ($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <select
        id="{{ $inputId }}"
        wire:model.defer="{{ $model }}"
        @disabled($disabled)
        {{ $attributes->merge(['class' => 'w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500']) }}
    >
        <option value="">-- Select --</option>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>

    @error($error)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
