<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class F6CkdSelfMonitoring extends Component
{
public $date, $name, $ic_no, $weight;
public $bp_pre_breakfast, $bp_pre_bed;
public $sugar_pre_breakfast, $sugar_pre_lunch, $sugar_pre_dinner, $sugar_pre_bed;

public $medication = [];
public $other_medication = '';

public $diet_breakfast, $diet_lunch, $diet_dinner;

public $isSubmitted = false;


    public array $medicationOptions = [
        'Actrapid' => 'Actrapid',
        'Insulatard' => 'Insulatard',
        'Vildagliptin' => 'Vildagliptin',
        'Amlodipine 10mg dly' => 'Amlodipine 10mg dly',
        'Losartan 100mgm dly' => 'Losartan 100mgm dly',
        'Frusemide 40mg dly' => 'Frusemide 40mg dly',
        'Others' => 'Others',
    ];

protected function rules()
{
    $rules = [
        'date' => 'required|date',
        'name' => 'required|string|max:255',
        'ic_no' => ['required', 'string', 'regex:/^\d{6}-\d{2}-\d{4}$/'],
        'weight' => 'required|numeric|min:1|max:500',

        // Blood Pressure
        'bp_pre_breakfast' => 'required|numeric|min:0|max:300',
        'bp_pre_bed' => 'required|numeric|min:0|max:300',

        // Sugar Level
        'sugar_pre_breakfast' => 'required|numeric|min:0|max:30',
        'sugar_pre_lunch' => 'required|numeric|min:0|max:30',
        'sugar_pre_dinner' => 'required|numeric|min:0|max:30',
        'sugar_pre_bed' => 'required|numeric|min:0|max:30',

        // Medication checkboxes
        'medication' => 'required|array|min:1',
        'medication.*' => 'string',

        // Diet Textareas
        'diet_breakfast' => 'required|string|max:1000',
        'diet_lunch' => 'required|string|max:1000',
        'diet_dinner' => 'required|string|max:1000',

        // Default nullable unless 'other' is selected
        'other_medication' => 'nullable|string|max:500',
    ];

    if (in_array('other', $this->medication ?? [])) {
        $rules['other_medication'] = 'required|string|max:500';
    }

    return $rules;
}

protected function messages()
{
    return [
        'date.required' => 'Please enter the date.',
        'date.date' => 'The date must be a valid date.',

        'name.required' => 'Please enter the patient name.',
        'name.string' => 'The patient name must be a valid string.',
        'name.max' => 'The patient name may not exceed 255 characters.',

        'ic_no.required' => 'NRIC is required.',
        'ic_no.regex' => 'NRIC format is invalid. Format should be xxxxxx-xx-xxxx.',

        'weight.required' => 'Please enter the weight.',
        'weight.numeric' => 'Weight must be a number.',
        'weight.min' => 'Weight must be at least 1.',
        'weight.max' => 'Weight may not be greater than 500.',

        'bp_pre_breakfast.required' => 'Blood pressure before breakfast is required.',
        'bp_pre_breakfast.numeric' => 'Blood pressure before breakfast must be a number.',
        'bp_pre_breakfast.min' => 'Blood pressure must be at least 0.',
        'bp_pre_breakfast.max' => 'Blood pressure may not exceed 300.',

        'bp_pre_bed.required' => 'Blood pressure before bed is required.',
        'bp_pre_bed.numeric' => 'Blood pressure before bed must be a number.',
        'bp_pre_bed.min' => 'Blood pressure must be at least 0.',
        'bp_pre_bed.max' => 'Blood pressure may not exceed 300.',

        'sugar_pre_breakfast.required' => 'Sugar level before breakfast is required.',
        'sugar_pre_breakfast.numeric' => 'Sugar level before breakfast must be a number.',
        'sugar_pre_breakfast.min' => 'Sugar level must be at least 0.',
        'sugar_pre_breakfast.max' => 'Sugar level may not exceed 30.',

        'sugar_pre_lunch.required' => 'Sugar level before lunch is required.',
        'sugar_pre_lunch.numeric' => 'Sugar level before lunch must be a number.',
        'sugar_pre_lunch.min' => 'Sugar level must be at least 0.',
        'sugar_pre_lunch.max' => 'Sugar level may not exceed 30.',

        'sugar_pre_dinner.required' => 'Sugar level before dinner is required.',
        'sugar_pre_dinner.numeric' => 'Sugar level before dinner must be a number.',
        'sugar_pre_dinner.min' => 'Sugar level must be at least 0.',
        'sugar_pre_dinner.max' => 'Sugar level may not exceed 30.',

        'sugar_pre_bed.required' => 'Sugar level before bed is required.',
        'sugar_pre_bed.numeric' => 'Sugar level before bed must be a number.',
        'sugar_pre_bed.min' => 'Sugar level must be at least 0.',
        'sugar_pre_bed.max' => 'Sugar level may not exceed 30.',

        'medication.required' => 'Please select at least one medication.',
        'medication.array' => 'Medication must be an array.',
        'medication.min' => 'Please select at least one medication.',

        'medication.*.string' => 'Invalid medication selection.',

        'diet_breakfast.required' => 'Please describe your breakfast diet.',
        'diet_breakfast.string' => 'Breakfast diet must be a string.',
        'diet_breakfast.max' => 'Breakfast diet may not exceed 1000 characters.',

        'diet_lunch.required' => 'Please describe your lunch diet.',
        'diet_lunch.string' => 'Lunch diet must be a string.',
        'diet_lunch.max' => 'Lunch diet may not exceed 1000 characters.',

        'diet_dinner.required' => 'Please describe your dinner diet.',
        'diet_dinner.string' => 'Dinner diet must be a string.',
        'diet_dinner.max' => 'Dinner diet may not exceed 1000 characters.',

        'other_medication.required' => 'Please specify your other medication.',
        'other_medication.string' => 'Other medication must be a string.',
        'other_medication.max' => 'Other medication may not exceed 500 characters.',
    ];
}



public function updatedMedication()
{
    if (!in_array('other', $this->medication)) {
        $this->resetErrorBag('other_medication');
        $this->other_medication = '';
    } else {
        $this->validateOnly('other_medication');
    }
}


    public function submit()
    {
        $this->validate();
        $this->isSubmitted = true;
        session()->flash('success', 'Form submitted successfully.');
    }

    public function render()
    {
        return view('livewire.forms.f6-ckd-self-monitoring');
    }
}
