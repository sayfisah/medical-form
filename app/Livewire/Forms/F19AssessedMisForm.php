<?php
namespace App\Livewire\Forms;

use Livewire\Component;

class F19AssessedMisForm extends Component
{
    public array $form = [
        'patient_name' => '',
        'nric' => '',
        'date_assessed' => '',
        'weight_change' => null,
        'dietary_intake' => null,
        'gi_symptoms' => null,
        'functional_capacity' => null,
        'comorbidity' => null,
    ];

    public bool $isSubmitted = false;

    public function rules(): array
    {
        return [
            'form.patient_name' => 'required|string|max:255',
            'form.nric' => ['required', 'regex:/^\d{6}-\d{2}-\d{4}$/'],
            'form.date_assessed' => 'required|date',
            'form.weight_change' => 'required|in:0,1,2,3',
            'form.dietary_intake' => 'required|in:0,1,2,3',
            'form.gi_symptoms' => 'required|in:0,1,2,3',
            'form.functional_capacity' => 'required|in:0,1,2,3',
            'form.comorbidity' => 'required|in:0,1,2,3',
        ];
    }

    public function messages(): array
    {
        return [
            'form.patient_name.required' => 'Patient name is required.',
            'form.nric.required' => 'NRIC is required.',
            'form.nric.regex' => 'Please enter NRIC in format XXXXXX-XX-XXXX.',
            'form.date_assessed.required' => 'Assessment date is required.',
            'form.date_assessed.date' => 'Please enter a valid date.',
            '*.required' => 'This question is required.',
            '*.in' => 'Invalid selection.',
        ];
    }

    public function submit()
    {
        $this->validate();

        // Store in database...
        $this->isSubmitted = true;

        session()->flash('message', 'Form submitted successfully!');
    }

    public function cancel()
    {
        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.forms.f19-assessed-mis-form');
    }
}
