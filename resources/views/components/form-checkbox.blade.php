@props([
    'name',
    'options' => [],
    'otherName' => null,
    'otherValue' => '',
    'title' => null, // Optional large title
])

@php
    $selected = old($name, $attributes->get($name) ?? []);
@endphp

<div 
    x-data="{ 
        selected: @js($selected),
        showOther: @js(in_array('other', $selected)),
        isSubmitted: @entangle('isSubmitted'),
    }"
    class="space-y-4"
>
    {{-- Optional Section Title --}}
    @if ($title)
        <h3 class="text-2xl font-bold text-center mb-8">
            {{ $title }}
        </h3>
    @endif

    <fieldset class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <legend class="sr-only">{{ ucwords(str_replace('_', ' ', $name)) }}</legend>

        @foreach ($options as $value => $label)
            <label 
                class="flex items-start gap-3 rounded-lg border border-gray-200 p-4 shadow-sm hover:bg-gray-50 transition cursor-pointer"
                :class="{ 'bg-blue-50': selected.includes('{{ $value }}') }"
            >
                <input 
                    type="checkbox" 
                    name="{{ $name }}[]"
                    wire:model.defer="{{ $name }}"
                    value="{{ $value }}"
                    class="mt-1 form-checkbox text-blue-600"
                    x-bind:disabled="isSubmitted"
                    @change="showOther = selected.includes('other')"
                    x-model="selected"
                />
                <div class="text-sm text-gray-800 leading-snug">
                    <strong>{{ $label }}</strong>
                    @if ($value === 'other')
                        <div class="text-xs text-gray-500">Please specify if none of the above.</div>
                    @endif
                </div>
            </label>
        @endforeach

        @error($name)
            <div class="col-span-full text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </fieldset>

    {{-- Conditionally Show "Other" Input --}}
    @if ($otherName)
        <div x-show="showOther" x-transition class="mt-2">
            <label for="{{ $otherName }}" class="block text-sm font-medium text-gray-900">Others / Remarks:</label>
            <textarea
                id="{{ $otherName }}"
                wire:model="{{ $otherName }}"
                rows="3"
                class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                x-bind:readonly="isSubmitted"
            >{{ $otherValue }}</textarea>

            @error($otherName)
                <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
            @enderror
        </div>
    @endif
</div>
