@push('form-css')
    <link rel="stylesheet" href="{{ asset('css/forms/f1.css') }}">
@endpush

<div
    x-data="{
        vascular_access: @entangle('vascular_access'),
        location: @entangle('location'),
        hbsag: @entangle('hbsag'),
        antihbs: @entangle('antihbs'),
        antihcv: @entangle('antihcv'),
        hiv: @entangle('hiv'),
        showVascularOther: false,
        showLocOther: false,
        showHbsag: false,
        showAntiHbs: false,
        showAntiHcv: false,
        showHiv: false
    }"
    x-init="() => {
        $watch('vascular_access', val => showVascularOther = val === 'other');
        $watch('location', val => showLocOther = val === 'others');
        $watch('hbsag', val => showHbsag = val === 'positive');
        $watch('antihbs', val => showAntiHbs = val === 'positive');
        $watch('antihcv', val => showAntiHcv = val === 'positive');
        $watch('hiv', val => showHiv = val === 'positive');
    }"
    class="max-w-6xl mx-auto p-6 md:p-10 bg-white rounded-2xl shadow-lg space-y-12"
>

    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">
        Holiday Patient Application Form
    </h1>

    {{-- SUCCESS MESSAGE BLOCK --}}
    {{-- This block is now outside the form's conditional display,
         so it can always appear after submission. --}}
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 no-print">
            {{ session('success') }}
        </div>
    @endif

    {{-- CONDITIONAL RENDERING: Show form OR success state --}}
    @if (!$isSubmitted)
        {{-- Display the entire form when $isSubmitted is FALSE --}}
        <form wire:submit.prevent="submit" class="space-y-12">

            {{-- SECTION 1: Patient & Physician Information --}}
            <section class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-1">1. Patient & Physician Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-form-input
                        label="Current Dialysis Centre"
                        model="dialysis_centre"
                        :options="$nkfDialysisCentres"
                        type="select"
                    />
                    <x-form-input
                        label="Request to dialyze at (temporary)"
                        model="request_centre"
                        :options="$requestCentres"
                        type="select"
                    />
                    <x-form-input label="Date of Request" model="request_date" type="date" />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <x-form-input label="Patient Name" model="patient_name" />
                    </div>
                    <x-form-input label="IC / Passport No." model="ic_no" />
                </div>
                <x-form-input label="Phone Number" model="phone_no" />
                <h3 class="text-lg font-medium text-gray-700">Referring Physician</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <x-form-input label="Physician's Name" model="physician_name" />
                    </div>
                    <x-form-input label="Physician's Centre" model="physician_centre" />
                    <x-form-input label="Physician's Phone No" model="physician_phone_no" />
                </div>
            </section>

            {{-- SECTION 2: Etiology of ESRF --}}
            <section class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-1">2. Etiology of ESRF</h2>
                <livewire:editable-table key="etiology" :initial-rows="$etiologies" :columns="[['field'=>'etiology','label'=>'Etiology']]" />
            </section>

            {{-- SECTION 3: First Dialysis Centre --}}
            <section class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-1">3. First Dialysis Centre</h2>
                <livewire:editable-table key="first_centres" :initial-rows="$firstCentres" :columns="[['field'=>'date','label'=>'Date'], ['field'=>'centre','label'=>'Centre']]" />
            </section>

            {{-- SECTION 4: Vascular Access --}}
            <section class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-1">4. Vascular Access</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form-input label="Created On" model="vascular_date" type="date" />
                    <x-form-input label="Status" model="vascular_status" />
                </div>
                <x-form-input label="Vascular Access" model="vascular_access" type="radio" :options="['AVFistula'=>'AV Fistula','AVGraft'=>'AV Graft','nil'=>'NIL','other'=>'Other']" />
                <template x-if="showVascularOther">
                    <x-form-input label="Specify Other" model="vascular_access_other" />
                </template>
                <x-form-input label="Location" model="location" type="radio" :options="['left-arm'=>'Left Arm','right-arm'=>'Right Arm','others'=>'Others']" />
                <template x-if="showLocOther">
                    <x-form-input label="Specify Location" model="location_other_specify" />
                </template>
            </section>

            {{-- SECTION 5: Dialysis Related Complications --}}
            <section class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-1">5. Dialysis Related Complications</h2>
                <livewire:editable-table key="complications" :initial-rows="$complications" :columns="[['field'=>'complication','label'=>'Complication']]" />
            </section>

            {{-- SECTION 6: Other Medical Illness --}}
            <section class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-1">6. Other Medical Illness</h2>
                <livewire:editable-table key="illnesses" :initial-rows="$illnesses" :columns="[['field'=>'illness','label'=>'Illness']]" />
            </section>

            {{-- SECTION 7: Medications --}}
            <section class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-1">7. Medications</h2>
                <livewire:editable-table
                    key="medications"
                    :initial-rows="$medications"
                    :columns="[
                        ['field' => 'name', 'label' => 'Medication Name'],
                        ['field' => 'allergy', 'label' => 'Allergy', 'type' => 'select', 'options' => ['' => 'Please select', 'Yes' => 'Yes', 'No' => 'No']]
                    ]"
                />
            </section>

            {{-- SECTION 8: Investigations --}}
            <section class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-1">8. Investigations</h2>
                <x-form-input label="Date of Test" model="investigation_date" type="date" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form-select label="HBsAg Result" model="hbsag" :options="['positive'=>'Positive','negative'=>'Negative','unknown'=>'Unknown']" />
                    <template x-if="showHbsag"><x-form-input label="HBsAg Value (IU/mL)" model="hbsag_value" /></template>

                    <x-form-select label="AntiHBS Result" model="antihbs" :options="['positive'=>'Positive','negative'=>'Negative','unknown'=>'Unknown']" />
                    <template x-if="showAntiHbs"><x-form-input label="AntiHBS Value (IU/L)" model="antihbs_value" /></template>

                    <x-form-select label="AntiHCV Result" model="antihcv" :options="['positive'=>'Positive','negative'=>'Negative','unknown'=>'Unknown']" />
                    <template x-if="showHcv"><x-form-input label="AntiHCV Value" model="antihcv_value" /></template>

                    <x-form-select label="HIV Result" model="hiv" :options="['positive'=>'Positive','negative','unknown']" />
                    <template x-if="showHiv"><x-form-input label="HIV Value (copies/mL)" model="hiv_value" /></template>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <x-form-input label="Hemoglobin (g/dL)" model="hemoglobin" />
                    <x-form-input label="Calcium (mmol/L)" model="calcium" />
                    <x-form-input label="Creatinine (µmol/L)" model="creatinine" />
                    <x-form-input label="Phosphate (mmol/L)" model="phosphate" />
                    <x-form-input label="Urea (mmol/L)" model="urea" />
                    <x-form-input label="ALT (U/L)" model="alt" />
                </div>
            </section>

            {{-- SECTION 9: Dialysis Prescription --}}
            <section class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-1">9. Current Dialysis Prescription</h2>
                <x-form-input label="Date" model="presc_date" type="date" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form-input label="Dry Weight (kg)" model="dry_weight" />
                    <x-form-select label="Dialysis Frequency" model="dialysis_frequency" :options="['daily'=>'1x/week','2x'=>'2x/week','3x'=>'3x/week','4x'=>'4x/week']" />
                </div>
                <x-form-select label="Dialysis Duration (per session)" model="dialysis_duration" :options="['1'=>'1 h','2'=>'2 h','3'=>'3 h','4'=>'4 h','5'=>'5 h','6'=>'6 h']" />
                <x-form-select label="Type of Dialyzer Use" model="dialyzer_type" :options="['FX60','FX80','FX100','Polyflux 17L','Polyflux 20L','Polyflux 21L','Revaclear 300','Revaclear 400','REXEED 25S','VITAL-22HF']" />
                <x-form-select label="Size of Dialyzer" model="dialyzer_size" :options="['1.4'=>'1.4 m²','1.5'=>'1.5 m²','1.6'=>'1.6 m²','1.7'=>'1.7 m²','1.8'=>'1.8 m²','1.9'=>'1.9 m²','2.0'=>'2.0 m²','2.1'=>'2.1 m²','2.2'=>'2.2 m²','2.3'=>'2.3 m²','2.4'=>'2.4 m²','2.5'=>'2.5 m²']" />
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-form-input label="Heparin Bolus (IU)" model="heparin_bolus" />
                    <x-form-input label="Heparin Hourly (IU)" model="heparin_hourly" />
                    <x-form-input label="Blood Flow (mL/min)" model="blood_flow" />
                </div>
            </section>

            {{-- Buttons for when the form IS NOT submitted --}}
            <div class="mt-4 flex gap-2 justify-center items-center no-print">
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
            </div>
        </form>

    @else
        {{-- Display this content when $isSubmitted is TRUE --}}
        <div class="text-center text-xl font-semibold text-blue-600 mt-8 mb-4">
            Your application has been successfully submitted!
            <p>You can now print or export your form.</p>
        </div>

        {{-- Buttons for when the form IS submitted --}}
        <div class="mt-4 flex gap-2 justify-center items-center no-print">
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
            {{-- Optional: Button to allow filling another form --}}
            <button
                type="button"
                wire:click="$set('isSubmitted', false)"
                style="background-color:#6366f1; color:white; padding:8px 16px; border:none; border-radius:6px; cursor:pointer;"
            >
                Fill Another Form
            </button>
        </div>
    @endif

</div>