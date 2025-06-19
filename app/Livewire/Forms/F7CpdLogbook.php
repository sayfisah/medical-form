<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class F7CpdLogbook extends Component
{
    public $name = '';
    public $designation = '';
    public $ic_number = '';
    public $supervisor_name = '';
    public $date_of_activity = '';
    public $cpd_category = '';
    public $activity_description = '';
    public $course_organiser = '';
    public $credit_points = '';
    public $method_of_verification = '';

    public $isSubmitted = false;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'ic_number' => ['required', 'regex:/^\d{6}-\d{2}-\d{4}$/'],
            'supervisor_name' => 'required|string|max:255',
            'date_of_activity' => 'required|date',
            'cpd_category' => 'required|string|in:' . implode(',', $this->categories()),
            'activity_description' => 'required|string|max:2000',
            'course_organiser' => 'required|string|max:255',
            'credit_points' => 'required|numeric|min:0|max:100',
            'method_of_verification' => 'required|string|max:255',
        ];
    }

    public function categories()
    {
        return [
            "A1", "A2", "A3", "A4", "A5", "A6", "A7", "A8", "A9", "A10", "A11",
            "B1", "B2"
        ];
    }

    public function submit()
    {
        $this->validate();

        // Save to DB or emit an event here (example placeholder)
        // Example: CPDActivity::create([...]);

        $this->isSubmitted = true;
        session()->flash('success', 'CPD Activity recorded successfully!');
    }

    public function render()
    {
        return view('livewire.forms.f7-cpd-logbook');
    }
}
