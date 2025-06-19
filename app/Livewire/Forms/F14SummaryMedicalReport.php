<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;

class F14SummaryMedicalReport extends Component
{
    use WithFileUploads;

    public bool $isSubmitted = false;

    public array $form = [
        'date' => '',
        'patient_name' => '',
        'ic_no' => '',
        'physician_name' => '',
        'physician_clinic' => '',
        'physician_phone_no' => '',

        // Editable tables
        'etiology' => [['illness' => '']],
        'other_illness' => [['illness' => '']],

        // Allergy & Summary
        'allergy' => null,
        'allergy_details' => '',

        'summary_medical_report' => '',
        'mrsa_status' => '',

        // Specific Questions
        'ambulant' => '',
        'ambulant_detail' => '',
        'fit_for_transplant' => '',
        'fit_remark' => '',
        'vascular_access' => '',
        'vascular_access_other' => '',
        'vascular_location' => '',
        'vascular_location_other' => '',
        'vascular_in_use' => '',
        'current_treatment' => '',
        'first_dialysis_date' => '',
        'dialysis_place' => '',
    ];

    public array $fileUploads = [
        'mrsa' => [],
    ];

    public function rules()
    {
        return [
            'form.date' => 'required|date',
            'form.patient_name' => 'required|string',
            'form.ic_no' => 'required|string',
            'form.physician_name' => 'required|string',
            'form.physician_clinic' => 'required|string',
            'form.physician_phone_no' => 'required|string',

            'form.etiology' => 'required|array|min:1',
            'form.etiology.*.illness' => 'required|string',
            'form.other_illness' => 'required|array|min:1',
            'form.other_illness.*.illness' => 'required|string',

            'form.allergy' => 'required',
            'form.allergy_details' => 'required_if:form.allergy,Yes',
            'form.summary_medical_report' => 'required|string',
            'form.mrsa_status' => 'required|string',

            // Specific questions
            'form.ambulant' => 'required',
            'form.ambulant_detail' => 'required_if:form.ambulant,no',
            'form.fit_for_transplant' => 'required',
            'form.fit_remark' => 'required_if:form.fit_for_transplant,no',
            'form.vascular_access' => 'required',
            'form.vascular_access_other' => 'required_if:form.vascular_access,other',
            'form.vascular_location' => 'required',
            'form.vascular_location_other' => 'required_if:form.vascular_location,others',
            'form.vascular_in_use' => 'required',
            'form.current_treatment' => 'required|string',
            'form.first_dialysis_date' => 'required|date',
            'form.dialysis_place' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'form.date.required' => 'Please select a date.',
            'form.patient_name.required' => 'Patient name is required.',
            'form.ic_no.required' => 'IC number is required.',
            'form.physician_name.required' => 'Physician name is required.',
            'form.physician_clinic.required' => 'Clinic or hospital is required.',
            'form.physician_phone_no.required' => 'Physician phone number is required.',

            'form.etiology.required' => 'At least one etiology must be entered.',
            'form.etiology.*.illness.required' => 'Etiology illness is required.',
            'form.other_illness.required' => 'At least one medical illness must be entered.',
            'form.other_illness.*.illness.required' => 'Medical illness entry is required.',

            'form.allergy.required' => 'Please select an allergy option.',
            'form.allergy_details.required_if' => 'Please specify the allergy details.',
            'form.summary_medical_report.required' => 'Summary of medical report is required.',
            'form.mrsa_status.required' => 'Please select the MRSA status.',

            'form.ambulant.required' => 'Please select ambulant status.',
            'form.ambulant_detail.required_if' => 'Please specify ambulant detail.',
            'form.fit_for_transplant.required' => 'Please select transplant fitness.',
            'form.fit_remark.required_if' => 'Please provide transplant remark.',
            'form.vascular_access.required' => 'Please select vascular access.',
            'form.vascular_access_other.required_if' => 'Please specify other access.',
            'form.vascular_location.required' => 'Please select vascular location.',
            'form.vascular_location_other.required_if' => 'Please specify other location.',
            'form.vascular_in_use.required' => 'Please specify if vascular is in use.',
            'form.current_treatment.required' => 'Please select current treatment.',
            'form.first_dialysis_date.required' => 'Date of first dialysis is required.',
            'form.dialysis_place.required' => 'Place of dialysis is required.',
        ];
    }

    public function submit()
    {
        $validatedData = $this->validate();

        // Handle file uploads (you can store or process as needed)
        foreach ($this->fileUploads['mrsa'] as $file) {
            $file->store('uploads/mrsa', 'public');
        }

        $this->isSubmitted = true;

        session()->flash('success', 'Medical report submitted successfully.');
    }

    public function render()
    {
        return view('livewire.forms.f14-summary-medical-report');
    }
}
