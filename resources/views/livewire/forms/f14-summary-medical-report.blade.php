<div class="container mx-auto p-6 bg-white rounded shadow" x-data="fileUploadHandler()">
    <h2 class="text-2xl font-bold text-center mb-4">SUMMARY OF MEDICAL REPORT</h2>
    <h4 class="text-center text-gray-700 mb-8">FOR HAEMODIALYSIS PROGRAMME</h4>

    <form wire:submit.prevent="submit" class="space-y-6">
        <x-form-input label="Date" model="form.date" type="date" />

        <x-form-input label="Patient Name" model="form.patient_name" placeholder="Enter patient full name" />
        <x-form-input label="IC No" model="form.ic_no" placeholder="Enter IC number" />
        <x-form-input label="Physician's Name" model="form.physician_name" placeholder="Enter physician name" />
        <x-form-input label="Physician's Clinic / Hospital" model="form.physician_clinic" placeholder="Enter clinic / hospital" />
        <x-form-input label="Phone No" model="form.physician_phone_no" placeholder="Enter phone number" />

        {{-- Etiology Table --}}
        <section>
            <h3 class="font-semibold">Etiology of ESRF</h3>
            <livewire:editable-table
                key="etiology"
                wire:model="form.etiology"
                :initial-rows="[['illness' => 'Diabetes Mellitus'], ['illness' => 'Hypertension']]"
                :columns="[['field' => 'illness', 'label' => 'Illness']]"
            />
            @error('form.etiology') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </section>

        {{-- Other Medical Illness Table --}}
        <section>
            <h3 class="font-semibold mt-6">Other Medical Illness</h3>
            <livewire:editable-table
                key="illness"
                wire:model="form.other_illness"
                :initial-rows="[['illness' => 'Hyperlipidemia']]"
                :columns="[['field' => 'illness', 'label' => 'Illness']]"
            />
            @error('form.other_illness') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </section>

{{-- Allergy --}}
<section 
    x-data="{
        form: @entangle('form'),
        get showAllergyDetails() { return this.form?.allergy === 'Yes' }
    }"
>
    <x-form-input 
        label="Allergy" 
        model="form.allergy" 
        type="radio"
        :options="['Yes' => 'Yes', 'No' => 'No']"
    />

    <template x-if="showAllergyDetails">
        <div x-cloak>
            <x-form-input 
                label="Specify Allergy" 
                model="form.allergy_details" 
                type="textarea" 
            />
        </div>
    </template>
</section>



        {{-- summary medical report --}}
        <x-form-input label="Summary of Medical Report" model="form.summary_medical_report" type="textarea" />

{{-- Specific Questions --}}
<section 
    x-data="{
        form: @entangle('form'),
        get showAmbulantDetail() { return this.form?.ambulant === 'no' },
        get showFitRemark() { return this.form?.fit_for_transplant === 'no' },
        get showVascularOther() { return this.form?.vascular_access === 'other' },
        get showLocationOther() { return this.form?.vascular_location === 'others' },
    }"
>
    <h3 class="font-semibold text-lg mt-8 mb-2">2. Specific Questions</h3>

    {{-- Ambulant --}}
    <x-form-input 
        label="Is patient ambulant?" 
        model="form.ambulant" 
        type="radio" 
        :options="['yes' => 'Yes', 'no' => 'No']"
    />
    <template x-if="showAmbulantDetail">
        <div x-cloak>
            <x-form-input 
                label="If not, please specify" 
                model="form.ambulant_detail" 
                placeholder="Enter details" 
                :required="true"
            />
        </div>
    </template>

    {{-- Fit for transplant --}}
    <x-form-input 
        label="Is patient fit for transplant?" 
        model="form.fit_for_transplant" 
        type="radio" 
        :options="['yes' => 'Yes', 'no' => 'No']"
    />
    <template x-if="showFitRemark">
        <div x-cloak>
            <x-form-input 
                label="Remarks" 
                model="form.fit_remark" 
                placeholder="Enter remark" 
                :required="true"
            />
        </div>
    </template>

    {{-- Vascular Access --}}
    <h4 class="font-semibold mt-6">3. Vascular Access</h4>
    <x-form-input 
        label="Type of Vascular Access" 
        model="form.vascular_access" 
        type="radio" 
        :options="[
            'AVFistula' => 'AV Fistula', 
            'AVGraft' => 'AV Graft', 
            'nil' => 'NIL', 
            'other' => 'Other'
        ]"
    />
    <template x-if="showVascularOther">
        <div x-cloak>
            <x-form-input 
                label="Please specify other access" 
                model="form.vascular_access_other" 
                placeholder="Specify access" 
                :required="true"
            />
        </div>
    </template>

    {{-- Location --}}
    <x-form-input 
        label="Location of Access" 
        model="form.vascular_location" 
        type="radio" 
        :options="[
            'left-arm' => 'Left Arm', 
            'right-arm' => 'Right Arm', 
            'others' => 'Others'
        ]"
    />
    <template x-if="showLocationOther">
        <div x-cloak>
            <x-form-input 
                label="Please specify location" 
                model="form.vascular_location_other" 
                placeholder="Specify location" 
                :required="true"
            />
        </div>
    </template>

    {{-- In Use --}}
    <x-form-input 
        label="Vascular Access in Use?" 
        model="form.vascular_in_use" 
        type="radio" 
        :options="['yes' => 'Yes', 'no' => 'No']"
    />

    <hr class="my-6 border-gray-300">

    {{-- Current Treatment --}}
    <h4 class="font-semibold mt-4">4. Current Treatment</h4>
    <x-form-input 
        label="Current Treatment" 
        model="form.current_treatment" 
        type="radio" 
        :options="[
            'conservative' => 'Conservative',
            'ipd' => 'IPD',
            'capd' => 'CAPD',
            'haemodialysis' => 'Haemodialysis'
        ]"
    />

    {{-- Date of First Dialysis --}}
    <x-form-input 
        label="Date of First Dialysis" 
        model="form.first_dialysis_date" 
        type="date"
    />

    {{-- Dialysis Place --}}
    <x-form-input 
        label="Place of Dialysis" 
        model="form.dialysis_place" 
        placeholder="Enter dialysis centre"
    />
</section>

    {{-- Investigations --}}
    <h4 class="font-semibold mt-4">5. Investigations</h4>

        {{-- MRSA File Upload --}}
        <div x-data="fileUploadHandler()">
<x-form-input 
    label="Upload MRSA Reports" 
    model="mrsa" 
    type="file" 
    multiple
/>
        </div>


        {{-- Submit / Print Buttons --}}
        <div class="mt-4 flex gap-2 justify-center items-center no-print">
            @if (!$isSubmitted)
                <button
                    type="button"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
                    onclick="if(confirm('Cancel?')) { window.location.href = '/' }"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
                >
                    Submit
                </button>
            @else
                <button
                    type="button"
                    onclick="window.location.href='/'"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded"
                >
                    Back to Home
                </button>
                <button 
                    type="button" 
                    onclick="window.print()" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
                >
                    Print / Export to PDF
                </button>
            @endif
        </div>
    </form>
</div>

<script>
    function fileUploadHandler() {
        return {
            files: {},
            handleFileChange(event, section) {
                const newFiles = Array.from(event.target.files);
                if (!this.files[section]) this.files[section] = [];
                this.files[section] = [...this.files[section], ...newFiles];
                event.target.value = ''; // reset input
            },
            removeFile(section, index) {
                if (this.files[section]) {
                    this.files[section].splice(index, 1);
                }
            }
        }
    }
</script>

