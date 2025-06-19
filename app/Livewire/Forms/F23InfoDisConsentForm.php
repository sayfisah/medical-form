<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class F23InfoDisConsentForm extends Component
{
    // Consent checkboxes
    public $consent_disclose_outside = false;
    public $consent_planning_development = false;
    public $consent_research_development = false;
    public $consent_training_education = false;
    public $consent_safety_quality = false;
    public $consent_renal_registry = false;
    public $consent_internal_audit = false;
    public $consent_health_fund = false;
    public $consent_educational_materials = false;

    public $initial_disclose_outside = '';
    public $initial_planning_development = '';
    public $initial_research_development = '';
    public $initial_training_education = '';
    public $initial_safety_quality = '';
    public $initial_renal_registry = '';
    public $initial_internal_audit = '';
    public $initial_health_fund = '';
    public $initial_educational_materials = '';


    // Restriction fields
    public $restriction_name = '';
    public $restriction_signature = '';
    public $restriction_date = '';

    // Patient signature fields
    public $patient_signature = '';
    public $patient_name = '';
    public $patient_nric = '';
    public $patient_date_time = '';

    // Witness signature fields
    public $witness_signature = '';
    public $witness_name = '';
    public $witness_nric = '';
    public $witness_date_time = '';

    // Physician signature fields
    public $physician_signature = '';
    public $physician_name = '';
    public $physician_nric = '';
    public $physician_date_time = '';

    protected $rules = [
        'patient_signature' => 'required|string|max:255',
        'patient_name' => 'required|string|max:255',
        'patient_nric' => 'required|string|max:50',
        'patient_date_time' => 'required|date',
        'physician_signature' => 'required|string|max:255',
        'physician_name' => 'required|string|max:255',
        'physician_nric' => 'required|string|max:50',
        'physician_date_time' => 'required|date',
    ];

    protected $messages = [
        'patient_signature.required' => 'Patient signature is required.',
        'patient_name.required' => 'Patient name is required.',
        'patient_nric.required' => 'Patient NRIC is required.',
        'patient_date_time.required' => 'Patient signature date & time is required.',
        'physician_signature.required' => 'Physician signature is required.',
        'physician_name.required' => 'Physician name is required.',
        'physician_nric.required' => 'Physician NRIC is required.',
        'physician_date_time.required' => 'Physician signature date & time is required.',
    ];

    public function mount()
    {
        // Set current date for convenience
        $this->patient_date_time = now()->format('Y-m-d\TH:i');
        $this->physician_date_time = now()->format('Y-m-d\TH:i');
        $this->witness_date_time = now()->format('Y-m-d\TH:i');
        $this->restriction_date = now()->format('Y-m-d');
    }

    public function submit()
    {
        $this->validate();

        // Process the form data
        $formData = [
            'consent_options' => [
                'disclose_outside' => $this->consent_disclose_outside,
                'planning_development' => $this->consent_planning_development,
                'research_development' => $this->consent_research_development,
                'training_education' => $this->consent_training_education,
                'safety_quality' => $this->consent_safety_quality,
                'renal_registry' => $this->consent_renal_registry,
                'internal_audit' => $this->consent_internal_audit,
                'health_fund' => $this->consent_health_fund,
                'educational_materials' => $this->consent_educational_materials,
            ],
            'restriction' => [
                'name' => $this->restriction_name,
                'signature' => $this->restriction_signature,
                'date' => $this->restriction_date,
            ],
            'patient' => [
                'signature' => $this->patient_signature,
                'name' => $this->patient_name,
                'nric' => $this->patient_nric,
                'date_time' => $this->patient_date_time,
            ],
            'witness' => [
                'signature' => $this->witness_signature,
                'name' => $this->witness_name,
                'nric' => $this->witness_nric,
                'date_time' => $this->witness_date_time,
            ],
            'physician' => [
                'signature' => $this->physician_signature,
                'name' => $this->physician_name,
                'nric' => $this->physician_nric,
                'date_time' => $this->physician_date_time,
            ],
        ];

        // Here you would typically save to database
        // Example: ConsentForm::create($formData);

        session()->flash('message', 'Consent form submitted successfully!');

        // Optionally redirect or reset form
        $this->reset();
        $this->mount(); // Reset dates
    }

    public function render()
    {
        return view('livewire.forms.f23-info-dis-consent-form');
    }
}
