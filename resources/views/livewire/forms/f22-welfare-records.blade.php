@push('form-css')
    <link rel="stylesheet" href="{{ asset('css/forms/f1.css') }}">
@endpush


<div x-data="{}">
        @if (session()->has('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4 no-print">
        {{ session('success') }}
    </div>
    @endif
    <form wire:submit.prevent="submit" class="space-y-6 p-4 bg-white shadow rounded">

        <h2 class="text-center text-2xl font-bold">Welfare Records</h2>

        <h3 class="text-xl font-semibold">A. Socio-demography</h3>
<div class="grid grid-cols-1 md:grid-cols-6 gap-4">

    {{-- Group: Name + IC --}}
    <div class="md:col-span-3">
        <x-form-input label="Full Name" model="form.name" />
    </div>
    <div class="md:col-span-2">
        <x-form-input label="IC Number" model="form.ic_number" />
    </div>
    <div class="md:col-span-1">
        <x-form-input label="Age" model="form.age" type="number" min="0" max="120" :readonly="true" />
    </div>

    {{-- Group: Centre + Gender + Marital --}}
    <div class="md:col-span-3">
        <x-form-input 
            label="Current Dialysis Centre"
            model="form.dialysis_centre"
            :options="$this->nkfDialysisCentres"
            type="select"
        />
    </div>
    <div class="md:col-span-1">
        <x-form-input 
            label="Gender"
            model="form.gender"
            type="select"
            :options="['male'=>'Male','female'=>'Female']"
        />
    </div>
    <div class="md:col-span-2">
        <x-form-input 
            label="Marital Status"
            model="form.marital_status"
            type="select"
            :options="['single'=>'Single','married'=>'Married','divorced'=>'Divorced','widowed'=>'Widowed','separated'=>'Separated']"
        />
    </div>

    {{-- Group: Ethnic + Education + Employment --}}
    <div class="md:col-span-2">
        <x-form-input 
            label="Ethnic Group"
            model="form.ethnic"
            type="select"
            :options="['malay'=>'Malay','chinese'=>'Chinese','indian'=>'Indian','bumiputera'=>'Bumiputera','others'=>'Others']"
        />
    </div>
    <div class="md:col-span-2">
        <x-form-input 
            label="Education Level"
            model="form.education"
            type="select"
            :options="['primary'=>'Primary','secondary'=>'Secondary','tertiary'=>'Tertiary','none'=>'No Formal']"
        />
    </div>
    <div class="md:col-span-2">
        <x-form-input 
            label="Employment Status"
            model="form.employment"
            type="select"
            :options="['work-fulltime'=>'Full-time','work-parttime'=>'Part-time','not working'=>'Not Working','retired'=>'Retired']"
        />
    </div>

    {{-- Group: Caregiver --}}
    <div class="md:col-span-3">
        <x-form-input 
            label="Caregiver"
            model="form.caregiver"
            type="select"
            :options="['spouse'=>'Spouse','children'=>'Children','parents'=>'Parents','siblings'=>'Siblings','in-laws'=>'In‑laws','formal'=>'Formal Caregiver','others'=>'Others','none'=>'None']"
        />
    </div>

    {{-- Group: House Type --}}
    <div class="md:col-span-3">
        <x-form-input 
            label="Type of House"
            model="form.house_type"
            type="select"
            :options="['terrace'=>'Terrace','apartment'=>'Apartment/Flat','bungalow'=>'Bungalow','kampung'=>'Kampung House','low_cost'=>'Low‑cost','others'=>'Others']"
        />
        <div x-show="@js($form['house_type']) === 'others'" class="mt-2">
            <label class="block text-sm font-medium text-gray-700">Other House Type</label>
            <textarea wire:model.defer="form.house_type_other"
                class="w-full border rounded-md shadow-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            @error('form.house_type_other')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Group: Payment --}}
    <div class="md:col-span-3">
        <x-form-input 
            label="Payment Category"
            model="form.payment"
            type="select"
            :options="['self'=>'Self‑Pay','moh'=>'MOH','SOCSO'=>'SOCSO','government'=>'Government','nkf-subsidy'=>'NKF Subsidy','Others'=>'Others']"
        />
        <div x-show="@js($form['payment']) === 'Others'" class="mt-2">
            <label class="block text-sm font-medium text-gray-700">Other Payment Category</label>
            <textarea wire:model.defer="form.payment_other"
                class="w-full border rounded-md shadow-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            @error('form.payment_other')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

</div>


        <hr class="my-6">

        <h3 class="text-xl font-semibold">B. Bio‑Medical</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-form-input label="HD Duration" model="form.hd_duration" />
            <x-form-input label="Date Started HD" model="form.hd_start_date" type="date" />
            <x-form-input label="Months on HD" model="form.months_on_hd" type="number" min="0" />
        </div>

        <x-form-input label="ESRD Etiology" model="form.esrd_etiology" type="radio" :options="['diabetes'=>'Diabetes','non_diabetes'=>'Non‑Diabetes']" />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form-input label="Dialysis Access" model="form.dialysis_access" type="select" :options="['fistula'=>'Fistula','prm_cath'=>'Perm‑Cath','temporary_catheter'=>'Temporary Catheter']" />
            <x-form-input label="Comorbidity (types)" model="form.comorbidity" />
        </div>

        <div class="overflow-auto">
            <table class="min-w-full text-left">
                <thead>
                    <tr><th>Comorbidity</th><th>Yes</th><th>No</th></tr>
                </thead>
                <tbody>
                    @foreach(['cardio_respiratory','muscular_skeletal','neurological','functional_comorbidity'] as $field)
                        <tr>
                            <td class="px-2">{{ ucwords(str_replace('_',' ',$field)) }}</td>
                            <td><input type="radio" wire:model.defer="form.{{ $field }}" value="yes" required></td>
                            <td><input type="radio" wire:model.defer="form.{{ $field }}" value="no"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @error('form.cardio_respiratory') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
            @error('form.muscular_skeletal') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
            @error('form.neurological') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
            @error('form.functional_comorbidity') <p class="mt-1 text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        <x-form-input 
    label="Functional Status"
    model="form.functional_status"
    :options="$this->functionalStatusOptions"
    type="select"
/>


        <hr class="my-6">

        <h3 class="text-xl font-semibold">C. Bio‑Chem Data</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-blue-50 p-4 rounded">
            <x-form-input label="Urea Pre‑Dialysis" model="form.preDialysisUrea" />
            <x-form-input label="Urea Post‑Dialysis" model="form.postDialysisUrea" />
        </div>

        <x-form-input label="URR (%)" model="form.urr" />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-green-50 p-4 rounded">
            <x-form-input label="Pre Dialysis Weight" model="form.preTdxWt" />
            <x-form-input label="Post Dialysis Weight" model="form.postTdxWt" />
            <x-form-input label="Next Dry Weight (KG)" model="form.nextDryWt" />
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
@php
$fields = [
    'idwg' => 'IDWG',
    'qb' => 'QB',
    'dialyzerType' => 'Dialyzer Type',
    'hb' => 'Hb',
    'po4' => 'PO4',
    'alb' => 'Albumin',
    'ktv' => 'Kt/V',
    'ca' => 'Calcium',
    'ipth' => 'iPTH',
    'alp' => 'ALP',
    'ast' => 'AST',
    'all' => 'ALL',
    'hba1c' => 'HbA1c',
    'ironSat' => 'Iron Sat %',
    'ferritin' => 'Ferritin',
    'kPlus2' => 'K+',
];
@endphp

@foreach($fields as $field => $label)
    <x-form-input 
        label="{{ $label }}" 
        model="form.{{ $field }}" 
    />
@endforeach


        </div>

       {{-- Submit Button --}}
<div class="mt-4 flex gap-2 justify-center items-center no-print">
    @if (!$isSubmitted)
        <button
            type="button"
            style="background-color:#ef4444; color:white; padding:8px 16px; border:none; border-radius:6px; cursor:pointer;"
            onclick="if(confirm('Cancel?')) { window.location.href = '/' }"
        >
            Cancel
        </button>
        <button
            type="submit"
            style="background-color:#16a34a; color:white; padding:8px 16px; border:none; border-radius:6px; cursor:pointer;"
        >
            Submit
        </button>
    @else
        <button
            type="button"
            onclick="window.location.href='/'"
            style="background-color:#4b5563; color:white; padding:8px 16px; border:none; border-radius:6px; cursor:pointer;"
        >
            Back to Home
        </button>
        <button 
            type="button" 
            onclick="window.print()" 
            style="background-color:#2563eb; color:white; padding:8px 16px; border:none; border-radius:6px; cursor:pointer;"
        >
            Print / Export to PDF
        </button>
    @endif
</div>
    </form>
</div>
