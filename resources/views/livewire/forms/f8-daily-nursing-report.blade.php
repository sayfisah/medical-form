@push('form-css')
  <link rel="stylesheet" href="{{ asset('css/forms/f1.css') }}">
@endpush


<div x-data="{}" class="max-w-4xl mx-auto py-8 px-6 bg-white shadow-lg rounded-xl">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
        Daily Nursing Report – Peritoneal Dialysis
    </h2>

  @if (session()->has('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-8 text-center no-print shadow-sm">
      {{ session('success') }}
    </div>
  @endif

    <form wire:submit.prevent="submit" class="space-y-8">

        {{-- Section: Patient Info --}}
        <div class="bg-gray-50 border rounded-lg p-5 space-y-4">
            <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 13l4 4L19 7" />
                </svg>
                Patient Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-form-input label="Name" model="form.name" />
                <x-form-input label="IC No" model="form.ic_no" />
                <x-form-input label="Date" model="form.date" type="date" />
                <x-form-input label="Weight (kg)" model="form.weight" type="number" step="0.1" />
                <x-form-input label="Blood Pressure" model="form.blood_pressure" placeholder="e.g. 120/80" />
                <x-form-input label="Pulse" model="form.pulse" />
            </div>
        </div>

        {{-- Section 1: Exit Site Dressing --}}
        <div class="bg-gray-50 border rounded-lg p-5 space-y-4">
            <h3 class="text-lg font-semibold text-gray-700">1. Exit Site Dressing</h3>
            <x-form-input label="Procedure Done By" model="form.exit_site_done_by" />
            <x-form-input 
                label="Status Exit Site – Infection" 
                model="form.exit_site_infection" 
                type="radio"
                :options="['Yes' => 'Yes', 'No' => 'No']"
            />
            <x-form-input label="Remark" model="form.exit_site_remark" />
        </div>

        {{-- Section 2: Transfer Set Change --}}
        <div class="bg-gray-50 border rounded-lg p-5 space-y-4">
            <h3 class="text-lg font-semibold text-gray-700">2. Transfer Set Change Catheter</h3>
            <x-form-input label="Procedure Done By" model="form.transfer_done_by" />
            <x-form-input 
                label="Procedure Done?" 
                model="form.transfer_done" 
                type="radio"
                :options="['Yes' => 'Yes', 'No' => 'No']"
            />
            <x-form-input label="Remark" model="form.transfer_remark" />
        </div>

        {{-- Section 3: I/P Antibiotic --}}
        <div class="bg-gray-50 border rounded-lg p-5 space-y-4">
            <h3 class="text-lg font-semibold text-gray-700">3. Complete I/P Antibiotic</h3>
            <x-form-input label="Procedure Done By" model="form.antibiotic_done_by" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-form-input label="Day Antibiotic" model="form.antibiotic_day" />
                <x-form-input label="Total Bag" model="form.antibiotic_total_bag" />
            </div>
            <x-form-input label="Remark" model="form.antibiotic_remark" />
        </div>

        {{-- Action Buttons --}}
        <div class="flex justify-center gap-4 pt-6 no-print">
            @if (!$isSubmitted)
                <button type="button"
                    onclick="if(confirm('Are you sure you want to cancel?')) window.location.href = '/'"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                    Cancel
                </button>
                <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    Submit
                </button>
            @else
                <button type="button" onclick="window.location.href='/'"
                    class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                    Back to Home
                </button>
                <button type="button" onclick="window.print()"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Print / Export to PDF
                </button>
            @endif
        </div>
    </form>
</div>
