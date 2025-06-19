@push('form-css')
    <link rel="stylesheet" href="{{ asset('css/forms/f1.css') }}">
@endpush

<div
    x-data="{
        get showOtherReporter() { return $wire.form.reporting_person === 'other' },
        get showPatientFields() { return $wire.form.patient_involved === 'yes' },
        get showOtherIncident() { return $wire.form.incident_type === 'other' },
    }"
    class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow-md space-y-10"
>
    <h2 class="text-2xl font-bold text-center text-gray-800">
        Incident Reporting Form
    </h2>

    <form wire:submit.prevent="submit" class="space-y-10">
        @if (session()->has('message'))
            <div class="p-4 mb-4 text-sm text-white rounded-xl bg-emerald-500 font-normal no-print">
                {{ session('message') }}
            </div>
        @endif

        {{-- Part A --}}
        <section class="bg-gray-50 border border-gray-200 p-6 rounded-lg space-y-6">
            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">Part A: Reporting Details</h3>

            <x-form-input label="Current Dialysis Centre" model="form.dialysis_centre" type="select"
                :disabled="$isSubmitted"
                :options="[
                    '' => '-- Select --',
                    'nkf_klang' => 'NKF Klang',
                    'nkf_setapak' => 'NKF Setapak',
                    'nkf_cheras' => 'NKF Cheras',
                    'nkf_subang' => 'NKF Subang',
                    'nkf_ipoh' => 'NKF Ipoh',
                ]" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-form-input label="Date of Incident" model="form.incident_date" type="date" :disabled="$isSubmitted" />
                <x-form-input label="Date of Reporting" model="form.report_date" type="date" :disabled="$isSubmitted" />
            </div>

            {{-- Reporter Role --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Reporter Role</label>
                <div class="flex flex-wrap gap-4">
                    @foreach([
                        'doctor' => 'Doctor',
                        'nurse' => 'Nurse',
                        'medical_assistant' => 'Medical Assistant',
                        'other' => 'Other',
                    ] as $key => $value)
                        <label class="flex items-center space-x-2">
                            <input type="radio" wire:model="form.reporting_person" value="{{ $key }}"
                                x-bind:disabled="$wire.isSubmitted"
                                class="text-blue-600 focus:ring-blue-500 border-gray-300" />
                            <span>{{ $value }}</span>
                        </label>
                    @endforeach
                </div>
                @error('form.reporting_person') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <template x-if="showOtherReporter">
                <x-form-input label="Other Reporter" model="form.reporting_person_other" :disabled="$isSubmitted" />
            </template>

            {{-- Reporter Type --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Reporter Type</label>
                <div class="flex gap-6">
                    @foreach([
                        'involved' => 'Involved in the incident',
                        'witnessed' => 'Witnessed the incident'
                    ] as $value => $label)
                        <label class="flex items-center gap-2">
                            <input type="radio" wire:model="form.person_status" value="{{ $value }}"
                                x-bind:disabled="$wire.isSubmitted"
                                class="text-blue-600 focus:ring-blue-500 border-gray-300" />
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
                @error('form.person_status') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            {{-- Patient Involvement --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Are patients involved?</label>
                <div class="flex gap-6">
                    @foreach([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ] as $val => $label)
                        <label class="flex items-center gap-2">
                            <input type="radio" wire:model="form.patient_involved" value="{{ $val }}"
                                x-bind:disabled="$wire.isSubmitted"
                                class="text-blue-600 focus:ring-blue-500 border-gray-300" />
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
                @error('form.patient_involved') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <template x-if="showPatientFields">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-form-input label="Patient Name" model="form.patient_name" :disabled="$isSubmitted" />
                    <x-form-input label="Patient NRIC" model="form.patient_nric" :disabled="$isSubmitted" />
                    <x-form-input label="Shift" model="form.patient_shift" :disabled="$isSubmitted" />
                </div>
            </template>

            {{-- Incident Type --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Incident Type</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach([
                        'medication_error' => 'Medication Error',
                        'drug_blood' => 'Adverse drug/blood reaction',
                        'transfusion_error' => 'Transfusion error',
                        'outcome_procedure' => 'Adverse outcome of procedure',
                        'against_medical' => 'Discharge against medical advice',
                        'equipment_failure' => 'Equipment failure',
                        'fall_accident' => 'Fall/accident',
                        'lab_error' => 'Lab/Radiology error',
                        'needle_injury' => 'Needle stick injury',
                        'complaints' => 'Complaint by patient/relatives',
                        'other' => 'Other',
                    ] as $key => $label)
                        <label class="flex items-center gap-2">
                            <input type="radio" wire:model="form.incident_type" value="{{ $key }}"
                                x-bind:disabled="$wire.isSubmitted"
                                class="text-blue-600 border-gray-300" />
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
                @error('form.incident_type') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <template x-if="showOtherIncident">
                <x-form-input label="Other Incident Type" model="form.incident_other" :disabled="$isSubmitted" />
            </template>

            <x-form-input label="Summary of Incident" model="form.summary" type="textarea" rows="5" :disabled="$isSubmitted" />
        </section>

        {{-- Part B --}}
        <section class="bg-gray-50 border border-gray-200 p-6 rounded-lg space-y-6">
            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">Part B: Assessment</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach([
                    'preventable' => 'Is this incident preventable?',
                    'injury' => 'Any injury to patient?',
                    'loss' => 'Any financial loss?',
                    'complaint' => 'Any complaint from public?',
                ] as $field => $label)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
                        <div class="flex gap-6">
                            <label class="flex items-center gap-2">
                                <input type="radio" wire:model="form.{{ $field }}" value="yes"
                                    x-bind:disabled="$wire.isSubmitted"
                                    class="text-blue-600 border-gray-300" />
                                <span>Yes</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" wire:model="form.{{ $field }}" value="no"
                                    x-bind:disabled="$wire.isSubmitted"
                                    class="text-blue-600 border-gray-300" />
                                <span>No</span>
                            </label>
                        </div>
                        @error("form.$field") <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                @endforeach
            </div>

            <x-form-input label="Recommendation" model="form.recommendation" type="textarea" rows="4" :disabled="$isSubmitted" />
        </section>

        {{-- Buttons --}}
        @if (!$isSubmitted)
            <button type="button" onclick="if(confirm('Cancel?')) { window.location.href = '/' }"
                class="bg-red-500 text-white px-4 py-2 rounded-md no-print">Cancel</button>
            <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded-md no-print">Submit</button>
        @else
            <button type="button" onclick="window.location.href='/'"
                class="bg-gray-600 text-white px-4 py-2 rounded-md no-print">Back to Home</button>
            <button type="button" onclick="window.print()"
                class="bg-blue-600 text-white px-4 py-2 rounded-md no-print">Print / Export to PDF</button>
        @endif
    </form>
</div>
