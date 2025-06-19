<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class F13IncidentReportReferral extends Component
{
    public bool $isSubmitted = false;

    public array $form = [
        // Part A
        'dialysis_centre' => '',
        'incident_date' => '',
        'report_date' => '',
        'reporting_person' => '',
        'reporting_person_other' => '',
        'person_status' => '',
        'patient_involved' => '',
        'patient_name' => '',
        'patient_nric' => '',
        'patient_shift' => '',
        'incident_type' => '',
        'incident_other' => '',
        'summary' => '',

        // Part B
        'preventable' => '',
        'injury' => '',
        'loss' => '',
        'complaint' => '',
        'recommendation' => '',
    ];

public function rules()
{
    return [
        'form.dialysis_centre' => 'required|string',
        'form.incident_date' => 'required|date',
        'form.report_date' => 'required|date',
        'form.reporting_person' => 'required|string',
        'form.reporting_person_other' => 'required_if:form.reporting_person,other|string|nullable',
        'form.person_status' => 'required|string',
        'form.patient_involved' => 'required|string',
        'form.patient_name' => 'required_if:form.patient_involved,yes|string|nullable',
        'form.patient_nric' => [
            'required_if:form.patient_involved,yes',
            'nullable',
            'regex:/^\d{6}-\d{2}-\d{4}$/',
        ],
        'form.patient_shift' => 'required_if:form.patient_involved,yes|string|nullable',
        'form.incident_type' => 'required|string',
        'form.incident_other' => 'required_if:form.incident_type,other|string|nullable',
        'form.summary' => 'required|string',

        // Part B
        'form.preventable' => 'required|string',
        'form.injury' => 'required|string',
        'form.loss' => 'required|string',
        'form.complaint' => 'required|string',
        'form.recommendation' => 'required|string',
    ];
}


public function messages()
{
    return [
        'form.dialysis_centre.required' => 'Please select the dialysis centre.',
        'form.incident_date.required' => 'The date of incident is required.',
        'form.report_date.required' => 'The date of reporting is required.',

        'form.reporting_person.required' => 'Please select the reporter role.',
        'form.reporting_person_other.required_if' => 'Please specify the other reporter role.',

        'form.person_status.required' => 'Please indicate whether the reporter was involved or witnessed.',

        'form.patient_involved.required' => 'Please specify whether a patient was involved.',
        'form.patient_name.required_if' => 'Please provide the patient’s name.',
'form.patient_nric.required_if' => 'Please provide the patient’s NRIC.',
'form.patient_nric.regex' => 'NRIC format is invalid. Please enter in the format XXXXXX-XX-XXXX.',

        'form.patient_shift.required_if' => 'Please provide the patient’s shift.',

        'form.incident_type.required' => 'Please select the type of incident.',
        'form.incident_other.required_if' => 'Please specify the other type of incident.',

        'form.summary.required' => 'Please provide a summary of the incident.',

        'form.preventable.required' => 'Please indicate if the incident was preventable.',
        'form.injury.required' => 'Please specify whether there was any injury.',
        'form.loss.required' => 'Please specify whether there was financial loss.',
        'form.complaint.required' => 'Please specify whether there was a public complaint.',

        'form.recommendation.required' => 'Please provide a recommendation.',
    ];
}


public function submit()
{
    $this->validate($this->rules(), $this->messages());

    // Save data or process further...

    $this->isSubmitted = true; // Update submission state
    session()->flash('message', 'Form successfully submitted!');
}

    public function render()
    {
        return view('livewire.forms.f13-incident-report-referral');
    }
}
