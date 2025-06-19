@push('form-css')
    <link rel="stylesheet" href="{{ asset('css/forms/f1.css') }}">
@endpush

<div
    x-data="knowledgeSlider()"
    class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg mt-8"
>
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">CKD Nursing Report</h2>

    @if (session()->has('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4 no-print">
        {{ session('success') }}
    </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
 <div class="bg-white p-6 rounded-2xl shadow-md mb-6 max-w-5xl mx-auto">
    <h3 class="text-xl font-medium text-left mb-6 text-gray-700">
        Patient Information
    </h3>

    {{-- Patient Name --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div class="md:col-span-2">
            <x-form-input
                label="Name"
                model="name"
                placeholder="Enter full name"
                :disabled="$isSubmitted"
            />
        </div>
    </div>

    {{-- NRIC & Age --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <x-form-input
            label="NRIC"
            model="nric"
            placeholder="Enter NRIC number"
            :disabled="$isSubmitted"
        />
        <x-form-input
            label="Age"
            model="age"
            type="number"
            placeholder="Enter age"
            :disabled="$isSubmitted"
        />
    </div>

    {{-- Referring Hospital & REC --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <x-form-input
            label="Referring Hospital/Clinic"
            model="referringHosp"
            placeholder="Enter hospital or clinic name"
            :disabled="$isSubmitted"
        />
        <x-form-input
            label="Renal Education Centre"
            model="rec"
            placeholder="Enter REC name"
            :disabled="$isSubmitted"
        />
    </div>

    {{-- Date & Time --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <x-form-input
            label="Date of Counseling"
            model="counselingdate"
            type="date"
            :disabled="$isSubmitted"
        />
        <x-form-input
            label="Time"
            model="time"
            type="time"
            :disabled="$isSubmitted"
        />
    </div>

    {{-- Case Status --}}
    <div class="mb-4">
        <x-form-input
            label="Case Status"
            model="case_status"
            type="radio"
            :options="['new' => 'New Case', 'follow_up' => 'Follow Up']"
            :disabled="$isSubmitted"
        />
    </div>
</div>




        <h3 class="text-2xl font-bold text-center mb-8">
            Knowledge Assessment
        </h3>

        {{-- Patient Knowledge --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h4 class="text-lg font-semibold mb-4">Patient Knowledge</h4>

<x-form-slider label="Patient Pre" model="patientPre" :disabled="$isSubmitted" />
<x-form-slider label="Patient Post" model="patientPost" :disabled="$isSubmitted" />
<x-form-slider label="Spouse Pre" model="SpousePre" :disabled="$isSubmitted" />
<x-form-slider label="Spouse Post" model="SpousePost" :disabled="$isSubmitted" />

        </div>
  
<x-form-checkbox 
    name="reason_of_referral"
    :options="[
        'lifestyle' => 'Lifestyle modification',
        'diabetes' => 'Diabetes/Hypertension Control',
        'rrt' => 'RRT Options',
        'diet' => 'Lifestyle & Diet Counselling',
        'other' => 'Other',
    ]"
    otherName="other_reason_referral"
    otherValue="{{ old('other_reason_referral', $other_reason_referral ?? '') }}"
    title="Reason of Referral"
/>


        <h3 class="text-2xl font-bold text-center mb-8">
Assessment        
</h3>

<livewire:editable-table 
    :initial-rows="[
        ['Comorbidities' => 'Diabetes'], 
        ['Comorbidities' => 'Cholesterol']
    ]" 
    :columns="[
        ['field' => 'Comorbidities', 'label' => 'Comorbidities']
    ]" 
/>
<br>
<div class="bg-white p-6 rounded-2xl shadow-md mb-6">
    <h3 class="text-xl font-medium text-left mb-6 text-gray-700">
        Anthropometry
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        {{-- Height --}}
        <x-form-input
            label="Height (cm)"
            model="height"
            :disabled="$isSubmitted"
        />

        {{-- Weight --}}
        <x-form-input
            label="Weight (kg)"
            model="weight"
            :disabled="$isSubmitted"
        />

        {{-- BMI --}}
        <x-form-input
            label="BMI"
            model="bmi"
            :disabled="$isSubmitted"
        />

        {{-- Others --}}
        <x-form-input
            label="Others"
            model="others_anthropometry"
            :disabled="$isSubmitted"
        />
    </div>
</div>


<livewire:editable-table 
    :initial-rows="[
        ['Biochemical' => 'Blood Glucose'], 
        ['Biochemical' => 'Cholesterol']
    ]" 
    :columns="[
        ['field' => 'Biochemical', 'label' => 'Biochemical']
    ]" 
/>
<br>

<div class="bg-white p-6 rounded-2xl shadow-md mb-6">
    <h3 class="text-xl font-medium text-left mb-6 text-gray-700">
        Clinical/Nutrition-focused Physical Finding
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        {{-- B/P --}}
        <x-form-input
            label="B/P"
            model="bloodPressure"
            :disabled="$isSubmitted"
        />

        {{-- Pulse --}}
        <x-form-input
            label="Pulse"
            model="pulse"
            :disabled="$isSubmitted"
        />

        {{-- Glucose --}}
        <x-form-input
            label="Glucose"
            model="glucose"
            :disabled="$isSubmitted"
        />

        {{-- Others --}}
        <x-form-input
            label="Others"
            model="others_nutrition"
            :disabled="$isSubmitted"
        />
    </div>
</div>


<livewire:editable-table 
    :initial-rows="[
        ['medication' => 'Amlodipine', 'dose' => '2', 'frequency' => 'Once Daily'], 
        ['medication' => 'Metformin', 'dose' => '500', 'frequency' => 'Twice daily'], 
    ]" 
    :columns="[
        ['field' => 'medication', 'label' => 'Medication'],
        ['field' => 'dose', 'label' => 'Dose (mg)'],
        ['field' => 'frequency', 'label' => 'Frequency']
    ]" 
/>

<br>

<div class="bg-white p-6 rounded-2xl shadow-md mb-6">
    <h3 class="text-xl font-medium text-left mb-6 text-gray-700">
        Diet
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        {{-- kcal --}}
        <x-form-input
            label="Estimated kcal intake"
            model="kcal"
            :disabled="$isSubmitted"
        />

        {{-- protein --}}
        <x-form-input
            label="Estimated protein intake"
            model="protein"
            :disabled="$isSubmitted"
        />

        {{-- sodium --}}
        <x-form-input
            label="Estimated sodium intake"
            model="sodium"
            :disabled="$isSubmitted"
        />
    </div>
</div>
<br>
 
<x-form-checkbox 
    name="diet_issue"
    :options="[
        'medicationNonAdherence' => 'Medication non-adherence',
        'dietNonAdherence' => 'Diet non-adherence',
        'knowledgeDeficit' => 'Knowledge deficit',
        'diet' => 'Lifestyle & Diet Counselling',
        'other' => 'Other',
    ]"
    otherName="other_reason_diet"
    otherValue="{{ old('other_reason_diet', $other_reason_diet ?? '') }}"
    title="Nursing/Diet Issue(s)"
/>

<x-form-checkbox 
    name="intervention"
    :options="[
        'education' => 'Education',
        'counseling' => 'Counseling',
        'deviceLoan' => 'Device Loan',
        'rrtOptions' => 'RRT Options',
        'other' => 'Other',
    ]"
    otherName="other_intervention"
    otherValue="{{ old('other_intervention', $other_intervention ?? '') }}"
    title="Intervention"
/>

<x-form-checkbox 
    name="monitoring_evaluation"
    :options="[
        'fup' => 'F/up needed',
        'monitorBlood' => 'Monitor Blood test',
        'improvedAdherence' => 'Improved adherence',
        'other' => 'Other',
    ]"
    otherName="other_monitoring"
    otherValue="{{ old('other_monitoring', $other_monitoring ?? '') }}"
    title="Monitoring & Evaluation"
/>







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
