@push('form-css')
<link rel="stylesheet" href="{{ asset('css/forms/f1.css') }}">
@endpush

<div x-data>
    @if(session()->has('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 no-print">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6 p-4 bg-white shadow rounded">
        <h2 class="text-center text-2xl font-bold">Emergency Trolley Daily Checklist</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form-input label="Centre" model="form.centre" />
            <x-form-input label="Checked by" model="form.checked_by" />
        </div>

        <hr class="my-4">

        <h3 class="text-lg font-semibold">4th Drawer – Expiry Dates</h3>
        <p class="text-gray-600 text-sm italic">Please enter expired date</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach([
                'bvm_exp_date' => 'Bag Valve Mask (BVM)',
                'oxygen_exp_date' => 'Oxygen tubing + Connector',
                'humidifier_exp_date' => 'Humidifier bottle',
                'nasal_exp_date' => 'Nasal Prong',
                'facemask_exp_date' => 'Face Mask (adult)',
                'flowmask_exp_date' => 'High Flow Mask (10‑15L)',
                'urinebag_exp_date' => 'Urine bag',
                'fc14_exp_date' => 'Foley Catheter 14fr',
                'fc16_exp_date' => 'Foley Catheter 16fr',
                'dextrose_exp_date' => 'Dextrose Saline 5%',
                'normal_saline_exp_date' => 'Normal Saline 0.9%',
            ] as $field => $label)
                <x-form-input label="{{ $label }}" model="form.{{ $field }}" type="date" />
            @endforeach
        </div>

        <hr class="my-4">

        <h3 class="text-lg font-semibold">Side – Expiry Dates</h3>
        <p class="text-gray-600 text-sm italic">Please enter expired date</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form-input label="Cardiac Board" model="form.cardiac_board_exp_date" type="date" />
            <x-form-input label="Oxygen tank + Flowmeter + Humidifier Bottle" model="form.oxygen_tank_exp_date" type="date" />
        </div>

        <div class="flex justify-center gap-4 mt-6 no-print">
            @if(!$isSubmitted)
                <button type="button" @click="window.location.reload()" class="bg-red-600 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Submit</button>
            @else
                            <button type="button" onclick="window.location.href='/'"
                    class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                    Back to Home
                </button>
                <button type="button" onclick="window.print()"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Print / Export to PDF
                </button>            @endif
        </div>
    </form>
</div>
