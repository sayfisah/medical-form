@props([
    'label' => '',
    'model' => '',
    'options' => [],
    'disabled' => false,
])

@php
    $id = \Illuminate\Support\Str::slug($model);
@endphp

<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>

    <div class="overflow-auto rounded-xl border border-gray-200">
        <table class="min-w-full text-sm text-center table-auto border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="w-1/2 text-left px-4 py-2">Pilihan Jawapan (Answer Options)</th>
                    @foreach($options as $value => $text)
                        <th class="px-2 py-2 whitespace-nowrap">{{ $text }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-left px-4 py-2 font-medium text-gray-600">Jawapan</td>
                    @foreach($options as $value => $text)
                        <td class="px-2 py-2">
                            <input
                                type="radio"
                                wire:model="{{ $model }}"
                                value="{{ $value }}"
                                id="{{ $id }}-{{ \Illuminate\Support\Str::slug($value) }}"
                                @if($disabled) disabled @endif
                                class="form-radio text-blue-600 focus:ring-blue-500"
                            />
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

    @error($model)
        <div class="text-sm text-red-600 mt-2">{{ $message }}</div>
    @enderror
</div>
