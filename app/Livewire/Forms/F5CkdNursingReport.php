<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class F5CkdNursingReport extends Component
{
    // Basic Info
    public $name, $nric, $age;
    public $referringHosp, $rec;
    public $counselingdate, $time, $case_status;

    // Sliders
    public $patientPre = null;
    public $patientPost = null;
    public $SpousePre = null;
    public $SpousePost = null;

    // Checkbox Groups
    public $reason_of_referral = [];
    public $other_reason_referral = '';

    public $diet_issue = [];
    public $other_reason_diet = '';

    public $intervention = [];
    public $other_intervention = '';

    public $monitoring_evaluation = [];
    public $other_monitoring = '';

    // Vitals
    public $height, $weight, $bmi, $others_anthropometry, $others_nutrition;
    public $bloodPressure, $pulse, $glucose, $others2;
    public $kcal, $protein, $sodium;

    public $isSubmitted = false;

    // ───────────────────────
    // 🟡 Checkbox Dependency Watchers
    // ───────────────────────

    public function updatedReasonOfReferral()
    {
        if (!in_array('other', $this->reason_of_referral)) {
            $this->resetErrorBag('other_reason_referral');
            $this->other_reason_referral = '';
        } else {
            $this->validateOnly('other_reason_referral');
        }
    }

    public function updatedDietIssue()
    {
        if (!in_array('other', $this->diet_issue)) {
            $this->resetErrorBag('other_reason_diet');
            $this->other_reason_diet = '';
        } else {
            $this->validateOnly('other_reason_diet');
        }
    }

    public function updatedIntervention()
    {
        if (!in_array('other', $this->intervention)) {
            $this->resetErrorBag('other_intervention');
            $this->other_intervention = '';
        } else {
            $this->validateOnly('other_intervention');
        }
    }

    public function updatedMonitoringEvaluation()
    {
        if (!in_array('other', $this->monitoring_evaluation)) {
            $this->resetErrorBag('other_monitoring');
            $this->other_monitoring = '';
        } else {
            $this->validateOnly('other_monitoring');
        }
    }

    // ───────────────────────
    // ✅ Dynamic Rule Groups
    // ───────────────────────

    protected function referralRules()
    {
        $rules = [
            'reason_of_referral' => 'required|array|min:1',
            'reason_of_referral.*' => 'string|in:lifestyle,diabetes,rrt,diet,other',
            'other_reason_referral' => 'nullable|string|max:500',
        ];

        if (in_array('other', $this->reason_of_referral)) {
            $rules['other_reason_referral'] = 'required|string|max:500';
        }

        return $rules;
    }

    protected function dietIssueRules()
    {
        $rules = [
            'diet_issue' => 'required|array|min:1',
            'diet_issue.*' => 'string|in:medicationNonAdherence,dietNonAdherence,knowledgeDeficit,diet,other',
            'other_reason_diet' => 'nullable|string|max:500',
        ];

        if (in_array('other', $this->diet_issue)) {
            $rules['other_reason_diet'] = 'required|string|max:500';
        }

        return $rules;
    }

    protected function interventionRules()
    {
        $rules = [
            'intervention' => 'required|array|min:1',
            'intervention.*' => 'string|in:education,counseling,deviceLoan,rrtOptions,other',
            'other_intervention' => 'nullable|string|max:500',
        ];

        if (in_array('other', $this->intervention)) {
            $rules['other_intervention'] = 'required|string|max:500';
        }

        return $rules;
    }

    protected function monitoringRules()
    {
        $rules = [
            'monitoring_evaluation' => 'required|array|min:1',
            'monitoring_evaluation.*' => 'string|in:fup,monitorBlood,improvedAdherence,other',
            'other_monitoring' => 'nullable|string|max:500',
        ];

        if (in_array('other', $this->monitoring_evaluation)) {
            $rules['other_monitoring'] = 'required|string|max:500';
        }

        return $rules;
    }

    // ───────────────────────
    // 🔒 Full Rule Set
    // ───────────────────────

    protected function rules()
    {
        return array_merge([
            'name' => 'required|string|max:255',
            'nric' => ['required', 'string', 'regex:/^\d{6}-\d{2}-\d{4}$/'],
            'age' => 'required|numeric|min:0|max:120',
            'referringHosp' => 'required|string|max:255',
            'rec' => 'required|string|max:255',
            'counselingdate' => 'required|date',
            'time' => 'required|date_format:H:i',
            'case_status' => 'required|in:new,follow_up',

            'patientPre' => 'required|integer|min:0|max:10',
            'patientPost' => 'required|integer|min:0|max:10',
            'SpousePre' => 'required|integer|min:0|max:10',
            'SpousePost' => 'required|integer|min:0|max:10',

            'height' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'bmi' => 'required|string|max:255',
            'others_anthropometry' => 'nullable|string|max:255',
            'others_nutrition' => 'nullable|string|max:255',
            'bloodPressure' => 'required|string|max:255',
            'pulse' => 'required|string|max:255',
            'glucose' => 'required|string|max:255',
            'others2' => 'nullable|string|max:255',

            'kcal' => 'required|string|max:255',
            'protein' => 'required|string|max:255',
            'sodium' => 'required|string|max:255',

            // core checkbox validations (to prevent Livewire initial errors)
            'intervention' => 'required|array|min:1',
            'intervention.*' => 'string|in:education,counseling,deviceLoan,rrtOptions,other',
            'other_intervention' => 'nullable|string|max:500',

            'monitoring_evaluation' => 'required|array|min:1',
            'monitoring_evaluation.*' => 'string|in:fup,monitorBlood,improvedAdherence,other',
            'other_monitoring' => 'nullable|string|max:500',

        ], $this->referralRules(), $this->dietIssueRules(), $this->interventionRules(), $this->monitoringRules());
    }

    protected function messages()
{
    return [
        'name.required' => 'Please enter the name.',
        'name.string' => 'The name must be a valid string.',
        'name.max' => 'The name may not be greater than 255 characters.',

        'nric.required' => 'NRIC is required.',
        'nric.regex' => 'NRIC format is invalid. It should be like 123456-78-9101.',

        'age.required' => 'Please enter the age.',
        'age.numeric' => 'Age must be a number.',
        'age.min' => 'Age must be at least 0.',
        'age.max' => 'Age may not be greater than 120.',

        'referringHosp.required' => 'Referring hospital is required.',
        'referringHosp.string' => 'Referring hospital must be a string.',
        'referringHosp.max' => 'Referring hospital may not be greater than 255 characters.',

        'rec.required' => 'Record is required.',
        'rec.string' => 'Record must be a string.',
        'rec.max' => 'Record may not be greater than 255 characters.',

        'counselingdate.required' => 'Counseling date is required.',
        'counselingdate.date' => 'Counseling date must be a valid date.',

        'time.required' => 'Time is required.',
        'time.date_format' => 'Time must be in the format HH:mm.',

        'case_status.required' => 'Case status is required.',
        'case_status.in' => 'Case status must be either "new" or "follow_up".',

        'patientPre.required' => 'Patient pre value is required.',
        'patientPre.integer' => 'Patient pre value must be an integer.',
        'patientPre.min' => 'Patient pre value must be at least 0.',
        'patientPre.max' => 'Patient pre value may not be greater than 10.',

        'patientPost.required' => 'Patient post value is required.',
        'patientPost.integer' => 'Patient post value must be an integer.',
        'patientPost.min' => 'Patient post value must be at least 0.',
        'patientPost.max' => 'Patient post value may not be greater than 10.',

        'SpousePre.required' => 'Spouse pre value is required.',
        'SpousePre.integer' => 'Spouse pre value must be an integer.',
        'SpousePre.min' => 'Spouse pre value must be at least 0.',
        'SpousePre.max' => 'Spouse pre value may not be greater than 10.',

        'SpousePost.required' => 'Spouse post value is required.',
        'SpousePost.integer' => 'Spouse post value must be an integer.',
        'SpousePost.min' => 'Spouse post value must be at least 0.',
        'SpousePost.max' => 'Spouse post value may not be greater than 10.',

        'height.required' => 'Height is required.',
        'height.string' => 'Height must be a string.',
        'height.max' => 'Height may not be greater than 255 characters.',

        'weight.required' => 'Weight is required.',
        'weight.string' => 'Weight must be a string.',
        'weight.max' => 'Weight may not be greater than 255 characters.',

        'bmi.required' => 'BMI is required.',
        'bmi.string' => 'BMI must be a string.',
        'bmi.max' => 'BMI may not be greater than 255 characters.',

        'others_anthropometry.string' => 'Others anthropometry must be a string.',
        'others_anthropometry.max' => 'Others anthropometry may not be greater than 255 characters.',

        'others_nutrition.string' => 'Others nutrition must be a string.',
        'others_nutrition.max' => 'Others nutrition may not be greater than 255 characters.',

        'bloodPressure.required' => 'Blood pressure is required.',
        'bloodPressure.string' => 'Blood pressure must be a string.',
        'bloodPressure.max' => 'Blood pressure may not be greater than 255 characters.',

        'pulse.required' => 'Pulse is required.',
        'pulse.string' => 'Pulse must be a string.',
        'pulse.max' => 'Pulse may not be greater than 255 characters.',

        'glucose.required' => 'Glucose is required.',
        'glucose.string' => 'Glucose must be a string.',
        'glucose.max' => 'Glucose may not be greater than 255 characters.',

        'others2.string' => 'Others 2 must be a string.',
        'others2.max' => 'Others 2 may not be greater than 255 characters.',

        'kcal.required' => 'Kcal is required.',
        'kcal.string' => 'Kcal must be a string.',
        'kcal.max' => 'Kcal may not be greater than 255 characters.',

        'protein.required' => 'Protein is required.',
        'protein.string' => 'Protein must be a string.',
        'protein.max' => 'Protein may not be greater than 255 characters.',

        'sodium.required' => 'Sodium is required.',
        'sodium.string' => 'Sodium must be a string.',
        'sodium.max' => 'Sodium may not be greater than 255 characters.',

        'intervention.required' => 'Please select at least one intervention.',
        'intervention.array' => 'Intervention must be an array.',
        'intervention.min' => 'Please select at least one intervention.',

        'intervention.*.in' => 'Invalid intervention selected.',

        'other_intervention.string' => 'Other intervention must be a string.',
        'other_intervention.max' => 'Other intervention may not be greater than 500 characters.',

        'monitoring_evaluation.required' => 'Please select at least one monitoring evaluation.',
        'monitoring_evaluation.array' => 'Monitoring evaluation must be an array.',
        'monitoring_evaluation.min' => 'Please select at least one monitoring evaluation.',

        'monitoring_evaluation.*.in' => 'Invalid monitoring evaluation selected.',

        'other_monitoring.string' => 'Other monitoring must be a string.',
        'other_monitoring.max' => 'Other monitoring may not be greater than 500 characters.',
    ];
}



    public function submit()
    {
        $validatedData = $this->validate();

        $this->isSubmitted = true;

        session()->flash('success', 'CKD Nursing Report submitted successfully.');
    }

    public function render()
    {
        return view('livewire.forms.f5-ckd-nursing-report');
    }
}
