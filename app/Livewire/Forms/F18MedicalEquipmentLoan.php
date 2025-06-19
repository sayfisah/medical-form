<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class F18MedicalEquipmentLoan extends Component
{
    public $name, $nric, $phone, $address, $clinic;
    public $bp_machine, $small_cuff, $big_cuff;
    public $glucometer, $lancing_pen, $lancet;
    public $loan_date, $return_date, $remarks;
    public $agree = false;
    public bool $isSubmitted = false;


    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'nric' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'clinic' => 'required|string|max:255',
            'bp_machine' => 'required|numeric',
            'small_cuff' => 'required|numeric',
            'big_cuff' => 'required|numeric',
            'glucometer' => 'required|numeric',
            'lancing_pen' => 'required|numeric',
            'lancet' => 'required|numeric',
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:loan_date',
            'remarks' => 'nullable|string',
            'agree' => 'accepted',
        ];
    }

    public function submit()
    {
        $this->validate();

        // ... Store the data or whatever logic

        $this->isSubmitted = true; // Mark the form as submitted
        session()->flash('message', 'Form submitted successfully!');
    }


    public function render()
    {
        return view('livewire.forms.f18-medical-equipment-loan');
    }
}
