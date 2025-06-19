<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class F9EmergencyTrolleyChecklist extends Component
{
    public bool $isSubmitted = false;

    public array $form = [
        'centre' => '',
        'checked_by' => '',
        'bvm_exp_date' => '',
        'oxygen_exp_date' => '',
        'humidifier_exp_date' => '',
        'nasal_exp_date' => '',
        'facemask_exp_date' => '',
        'flowmask_exp_date' => '',
        'urinebag_exp_date' => '',
        'fc14_exp_date' => '',
        'fc16_exp_date' => '',
        'dextrose_exp_date' => '',
        'normal_saline_exp_date' => '',
        'cardiac_board_exp_date' => '',
        'oxygen_tank_exp_date' => '',
    ];

    protected function rules(): array
    {
        return [
            'form.centre' => 'required|string|max:255',
            'form.checked_by' => 'required|string|max:255',
            'form.bvm_exp_date' => 'required|date',
            'form.oxygen_exp_date' => 'required|date',
            'form.humidifier_exp_date' => 'required|date',
            'form.nasal_exp_date' => 'required|date',
            'form.facemask_exp_date' => 'required|date',
            'form.flowmask_exp_date' => 'required|date',
            'form.urinebag_exp_date' => 'required|date',
            'form.fc14_exp_date' => 'required|date',
            'form.fc16_exp_date' => 'required|date',
            'form.dextrose_exp_date' => 'required|date',
            'form.normal_saline_exp_date' => 'required|date',
            'form.cardiac_board_exp_date' => 'required|date',
            'form.oxygen_tank_exp_date' => 'required|date',
        ];
    }

    protected function messages(): array
    {
        return [
            'form.*.required' => 'This field is required.',
            'form.*.date' => 'Please enter a valid date.',
            'form.centre.required' => 'Please enter the name of the centre.',
            'form.checked_by.required' => 'Please enter the name of the checker.',
        ];
    }

    public function submit()
    {
        $this->validate();

        // Save to database or handle logic here

        $this->isSubmitted = true;
        session()->flash('success', 'Checklist submitted successfully!');
    }

    public function render()
    {
        return view('livewire.forms.f9-emergency-trolley-checklist');
    }
}
