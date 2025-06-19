<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Validation\Rule;

class F8DailyNursingReport extends Component
{
    public $form = [];
    public $isSubmitted = false;

    public function render()
    {
        return view('livewire.forms.f8-daily-nursing-report');
    }

    public function submit()
    {
        $this->validate($this->rules(), $this->messages());

        // Store the data here (e.g. Model::create($this->form);)

        $this->isSubmitted = true;
        session()->flash('success', 'Form successfully submitted.');
    }

    protected function rules()
    {
        return [
            'form.name' => 'required|string|max:255',
            'form.ic_no' => 'required|string|max:20',
            'form.date' => 'required|date',
            'form.weight' => 'required|numeric|min:0',
            'form.blood_pressure' => 'required|string|max:20',
            'form.pulse' => 'required|string|max:20',

            'form.exit_site_done_by' => 'required|string|max:255',
            'form.exit_site_infection' => ['required', Rule::in(['Yes', 'No'])],
            'form.exit_site_remark' => 'nullable|string',

            'form.transfer_done_by' => 'required|string|max:255',
            'form.transfer_done' => ['required', Rule::in(['Yes', 'No'])],
            'form.transfer_remark' => 'nullable|string',

            'form.antibiotic_done_by' => 'required|string|max:255',
            'form.antibiotic_day' => 'required|string|max:50',
            'form.antibiotic_total_bag' => 'required|string|max:50',
            'form.antibiotic_remark' => 'nullable|string',
        ];
    }

    protected function messages()
    {
        return [
            'form.name.required' => 'Name is required.',
            'form.ic_no.required' => 'IC number is required.',
            'form.date.required' => 'Date is required.',
            'form.weight.required' => 'Weight is required.',
            'form.blood_pressure.required' => 'Blood pressure is required.',
            'form.pulse.required' => 'Pulse is required.',
            'form.exit_site_done_by.required' => 'Please enter who did the Exit Site Dressing.',
            'form.exit_site_infection.required' => 'Please select status for Exit Site Infection.',
            'form.transfer_done_by.required' => 'Please enter who did the Transfer Set Change.',
            'form.transfer_done.required' => 'Please select if the Transfer Set Change was done.',
            'form.antibiotic_done_by.required' => 'Please enter who did the I/P Antibiotic procedure.',
            'form.antibiotic_day.required' => 'Please provide the antibiotic day.',
            'form.antibiotic_total_bag.required' => 'Please provide the total bag used.',
        ];
    }
}
