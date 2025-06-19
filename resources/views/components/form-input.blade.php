@props([
    'label' => '',
    'model' => '',
    'type' => 'text',
    'placeholder' => '',
    'rows' => 3,
    'options' => [],
    'error' => $model,
    'disabled' => false,
    'multiple' => false, // for file upload
    'accept' => null,    // for file upload
])

@php
    use Illuminate\Support\Str;

    $inputId = Str::slug($model) . '-' . uniqid();
    $isSelect = $type === 'select' || $type === 'nkf-centre';
    $selectOptions = $type === 'nkf-centre'
        ? config('nkf.dialysis_centres')
        : $options;
@endphp

<div class="space-y-1">
    @if ($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    {{-- Textarea --}}
    @if ($type === 'textarea')
        <textarea
            id="{{ $inputId }}"
            wire:model.defer="{{ $model }}"
            placeholder="{{ $placeholder }}"
            rows="{{ $rows }}"
            {{ $attributes->merge([
                'class' => 'w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm ' . ($disabled ? 'bg-gray-100 cursor-not-allowed' : '')
            ]) }}
            @if($disabled) disabled @endif
        ></textarea>

    {{-- Select (Regular + NKF Centre) --}}
    @elseif ($isSelect)
        <select
            id="{{ $inputId }}"
            wire:model.defer="{{ $model }}"
            {{ $attributes->merge([
                'class' => 'w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm ' . ($disabled ? 'bg-gray-100 cursor-not-allowed' : '')
            ]) }}
            @if($disabled) disabled @endif
        >
            <option value="">-- Select --</option>
            @foreach ($selectOptions as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
            @endforeach
        </select>

    {{-- Radio --}}
    @elseif ($type === 'radio')
        <div class="flex flex-wrap gap-4">
            @foreach ($options as $key => $val)
                <label class="inline-flex items-center space-x-2 text-sm text-gray-700">
                    <input
                        type="radio"
                        wire:model.defer="{{ $model }}"
                        value="{{ $key }}"
                        class="form-radio text-indigo-600 focus:ring-indigo-500"
                        @if($disabled) disabled @endif
                    >
                    <span>{{ $val }}</span>
                </label>
            @endforeach
        </div>

    {{-- File --}}

@elseif ($type === 'file')
<div
    x-data="{
        files: [],
        openFileDialog() {
            $refs.fileInput.click();
        },
        handleUpload(event) {
            const selectedFiles = Array.from(event.target.files);
            @if ($multiple)
                this.files.push(...selectedFiles);
            @else
                this.files = selectedFiles;
            @endif

            // Optional: push to global Alpine store or Livewire handler
            handleFileChange(event, '{{ $model }}');
        },
        removeFile(index) {
            this.files.splice(index, 1);
        }
    }"
    class="space-y-2"
>
    {{-- Hidden File Input --}}
    <input
        x-ref="fileInput"
        id="{{ $inputId }}"
        type="file"
        class="hidden"
        {{ $multiple ? 'multiple' : '' }}
        @if ($accept) accept="{{ $accept }}" @endif
        @change="handleUpload"
    />

    {{-- Styled Upload Button --}}
    <button
        type="button"
        @click="openFileDialog"
        class="relative flex w-full overflow-hidden rounded-lg border border-gray-300 text-sm focus:z-10 focus:ring-1 focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
    >
        <span class="h-full whitespace-nowrap bg-indigo-600 text-white rounded-s-lg px-4 py-3">
            Choose File
        </span>
        <span class="group flex h-full grow overflow-hidden px-4 py-3 text-gray-700">
            <template x-if="files.length">
                <span class="truncate" x-text="files.length + ' file(s) selected'"></span>
            </template>
            <template x-if="!files.length">
                <span>No File Chosen</span>
            </template>
        </span>
        <span class="absolute left-0 top-0 h-full w-full cursor-pointer"></span>
    </button>

    {{-- File Preview List --}}
    <div class="space-y-1" x-show="files.length > 0">
        <template x-for="(file, index) in files" :key="index">
            <div class="flex items-center justify-between bg-gray-100 px-3 py-1 rounded">
                <span x-text="file.name" class="text-sm text-gray-800 truncate w-full"></span>
                <button
                    type="button"
                    class="text-red-500 text-sm ml-2"
                    @click="removeFile(index)"
                >×</button>
            </div>
        </template>
    </div>

    {{-- Validation --}}
    @error($model)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>





    {{-- Default input --}}
    @else
        <input
            id="{{ $inputId }}"
            type="{{ $type }}"
            wire:model.defer="{{ $model }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge([
                'class' => 'w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm ' . ($disabled ? 'bg-gray-100 cursor-not-allowed' : '')
            ]) }}
            @if($disabled) disabled @endif
        />
    @endif

    {{-- Error display --}}
    @error($error)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
