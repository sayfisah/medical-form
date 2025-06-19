@props([
    'label' => '',
    'model' => '',
    'min' => 0,
    'max' => 10,
    'step' => 1,
    'disabled' => false,
])

@php
    use Illuminate\Support\Str;
    $inputId = Str::slug($model) . '-' . uniqid();
@endphp

<div x-data="{ value: @entangle($model) }" class="mb-4">
    @if ($label)
        <label for="{{ $inputId }}" class="block font-semibold mb-1">{{ $label }}</label>
    @endif

    <input
        id="{{ $inputId }}"
        type="range"
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        x-model.number="value"
        @change="$wire.set('{{ $model }}', value ?? 0)"
        class="accent-green-500 w-full"
        :disabled="@js($disabled)"
    />

    <div class="flex justify-between text-xs font-medium mt-1">
        @for ($i = $min; $i <= $max; $i++)
            <span>{{ $i }}</span>
        @endfor
    </div>

    <span
        class="inline-block mt-2 px-3 py-1 rounded-full text-white text-sm"
        :class="{
            'bg-red-500': value !== null && value <= 3,
            'bg-yellow-400': value !== null && value > 3 && value <= 7,
            'bg-green-500': value !== null && value > 7
        }"
        x-text="value === null ? '-' : (value <= 3 ? 'Poor' : value <= 7 ? 'Moderate' : 'Good')"
    ></span>

    <div class="mt-1">
        <span class="text-sm font-semibold">Scale: </span>
        <span x-text="value ?? '-'"></span>
    </div>

    @error($model)
        <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
    @enderror
</div>
