@push('form-css')
  <link rel="stylesheet" href="{{ asset('css/forms/f1.css') }}">
@endpush

<div class="max-w-4xl mx-auto px-6 py-10 bg-white rounded-2xl shadow-md">
  <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Record CPD Activity</h2>

  @if (session()->has('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-8 text-center no-print shadow-sm">
      {{ session('success') }}
    </div>
  @endif

  <form wire:submit.prevent="submit" class="space-y-8">

    {{-- Row 1 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <x-form-input label="Name" model="name" :disabled="$isSubmitted" />
      <x-form-input label="Designation" model="designation" :disabled="$isSubmitted" />
    </div>

    {{-- Row 2 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <x-form-input label="I.C. Number" model="ic_number" :disabled="$isSubmitted" />
      <x-form-input label="Supervisor Name" model="supervisor_name" :disabled="$isSubmitted" />
    </div>

    {{-- Row 3 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <x-form-input label="Date of Activity" model="date_of_activity" type="date" :disabled="$isSubmitted" />

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">CPD Category</label>
        <select
          class="w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
          x-model="cpd_category"
          wire:model="cpd_category"
          :disabled="$isSubmitted"
        >
          <option value="" disabled>Select a category</option>
          @foreach (['A1','A2','A3','A4','A5','A6','A7','A8','A9','A10','A11','B1','B2'] as $cat)
            <option value="{{ $cat }}">{{ $cat }}</option>
          @endforeach
        </select>
        @error('cpd_category')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
    </div>

    {{-- Row 4 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <x-form-input label="Activity Description" model="activity_description" type="textarea" :disabled="$isSubmitted" />
      <x-form-input label="Course Organiser" model="course_organiser" :disabled="$isSubmitted" />
    </div>

    {{-- Row 5 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <x-form-input label="Credit Points" model="credit_points" type="number" :disabled="$isSubmitted" />
      <x-form-input label="Method of Verification" model="method_of_verification" :disabled="$isSubmitted" />
    </div>

    {{-- Buttons --}}
    <div class="flex flex-wrap justify-center gap-4 mt-12 no-print">
      @if (!$isSubmitted)
        <button
          type="button"
          onclick="if(confirm('Cancel?')) { window.location.href = '/' }"
          class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200"
        >
          Submit
        </button>
      @else
        <button
          type="button"
          onclick="window.location.href='/'"
          class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200"
        >
          Back to Home
        </button>
        <button
          type="button"
          onclick="window.print()"
          class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200"
        >
          Print / Export to PDF
        </button>
      @endif
    </div>

  </form>
</div>
