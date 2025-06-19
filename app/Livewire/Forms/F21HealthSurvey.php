<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class F21HealthSurvey extends Component
{
    public bool $isSubmitted = false;

    public array $form = [
        'dialysis_centre' => '',
        'name' => '',
        'date' => '',
        'healthLevel' => '',
        'limitAct2' => '',
        'limitAct3' => '',
        'limitAct4' => '',
        'limitAct5' => '',
        'limitAct6' => '',
        'limitAct7' => '',
        'limitAct8' => '',
        'q9' => '',
        'q10' => '',
        'q11' => '',
        'q12' => '',
    ];

    public function rules()
    {
        return [
            'form.dialysis_centre' => 'required',
            'form.name' => 'required|string',
            'form.date' => 'required|date',
            'form.healthLevel' => 'required',
            'form.limitAct2' => 'required',
            'form.limitAct3' => 'required',
            'form.limitAct4' => 'required',
            'form.limitAct5' => 'required',
            'form.limitAct6' => 'required',
            'form.limitAct7' => 'required',
            'form.limitAct8' => 'required',
            'form.q9' => 'required',
            'form.q10' => 'required',
            'form.q11' => 'required',
            'form.q12' => 'required',
        ];
    }

    public function submit()
    {
        $this->validate();
        $this->isSubmitted = true;

        // Save logic or emit event here
    }

    public function render()
    {
        return view('livewire.forms.f21-health-survey');
    }
}
