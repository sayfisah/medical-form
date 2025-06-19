@push('form-css')
    <link rel="stylesheet" href="{{ asset('css/forms/f1.css') }}">
@endpush
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
<h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">CKD Nursing Report</h2>

    @if (session()->has('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4 no-print">
        {{ session('success') }}
    </div>
    @endif

  <form wire:submit.prevent="submit" class="space-y-8">


<!-- Section container -->


  <!-- Date Field (single row, left-aligned) -->
  <div class="max-w-sm">
    <x-form-input
      label="Date"
      model="date"
      type="date"
      :disabled="$isSubmitted"
    />
  </div>

  <!-- Name, IC No, Weight -->
  <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

    <!-- Name (wider) -->
    <div class="md:col-span-6">
      <x-form-input
        label="Name"
        model="name"
        :disabled="$isSubmitted"
      />
    </div>

    <!-- IC No -->
    <div class="md:col-span-4">
      <x-form-input
        label="IC No"
        model="ic_no"
        :disabled="$isSubmitted"
      />
    </div>

    <!-- Weight -->
    <div class="md:col-span-2">
      <x-form-input
        label="Weight (kg)"
        model="weight"
        type="number"
        :disabled="$isSubmitted"
      />
    </div>
 

</div>





    <!-- Blood Pressure -->
    <section>
      <h3 class="text-xl font-semibold mb-4 border-b border-gray-300 pb-1">Blood Pressure</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-form-input
          label="Pre-Breakfast"
          model="bp_pre_breakfast"
          type="number"
          :disabled="$isSubmitted"
        />
        <x-form-input
          label="Pre-Bed"
          model="bp_pre_bed"
          type="number"
          :disabled="$isSubmitted"
        />
      </div>
    </section>

    <!-- Sugar Level -->
    <section>
      <h3 class="text-xl font-semibold mb-4 border-b border-gray-300 pb-1">Sugar Level</h3>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-form-input
          label="Pre-Breakfast"
          model="sugar_pre_breakfast"
          type="number"
          :disabled="$isSubmitted"
        />
        <x-form-input
          label="Pre-Lunch"
          model="sugar_pre_lunch"
          type="number"
          :disabled="$isSubmitted"
        />
        <x-form-input
          label="Pre-Dinner"
          model="sugar_pre_dinner"
          type="number"
          :disabled="$isSubmitted"
        />
        <x-form-input
          label="Pre-Bed"
          model="sugar_pre_bed"
          type="number"
          :disabled="$isSubmitted"
        />
      </div>
    </section>

    <!-- Medication -->
    <section>
      <x-form-checkbox 
        name="medication"
        :options="[
            'Actrapid' => 'Actrapid',
            'Insulatard' => 'Insulatard',
            'Vildagliptin' => 'Vildagliptin',
            'Amlodipine 10mg dly' => 'Amlodipine 10mg dly',
            'Losartan 100mgm dly' => 'Losartan 100mgm dly',
            'Frusemide 40mg dly' => 'Frusemide 40mg dly',
            'other' => 'Other',
        ]"
        otherName="other_medication"
        otherValue="{{ old('other_medication', $other_medication ?? '') }}"
        title="Medication"
      />
    </section>

    <!-- Diet -->
    <section class="space-y-6 max-w-3xl">
      <x-form-input
        label="Breakfast"
        model="diet_breakfast"
        type="textarea"
        :disabled="$isSubmitted"
      />
      <x-form-input
        label="Lunch"
        model="diet_lunch"
        type="textarea"
        :disabled="$isSubmitted"
      />
      <x-form-input
        label="Dinner"
        model="diet_dinner"
        type="textarea"
        :disabled="$isSubmitted"
      />
    </section>

    <!-- Buttons -->
    <div class="flex justify-center gap-4 mt-8 no-print">
      @if (!$isSubmitted)
        <button
          type="button"
          onclick="if(confirm('Cancel?')) { window.location.href = '/' }"
          class="px-6 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white transition no-print"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="px-6 py-2 rounded-md bg-green-600 hover:bg-green-700 text-white transition no-print"
        >
          Submit
        </button>
      @else
        <button
          type="button"
          onclick="window.location.href='/'"
          class="px-6 py-2 rounded-md bg-gray-600 hover:bg-gray-700 text-white transition no-print"
        >
          Back to Home
        </button>
        <button
          type="button"
          onclick="window.print()"
          class="px-6 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white transition no-print"
        >
          Print / Export to PDF
        </button>
      @endif
    </div>

  </form>
</div>
