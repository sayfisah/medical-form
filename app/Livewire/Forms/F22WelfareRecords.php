<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Carbon\Carbon;


class F22WelfareRecords extends Component
{

    public bool $isSubmitted = false;

    public array $nkfDialysisCentres = [
    'nkf_klang' => 'NKF Klang',
    'nkf_setapak' => 'NKF Setapak',
    'nkf_cheras' => 'NKF Cheras',
    'nkf_subang' => 'NKF Subang',
    'nkf_ipoh' => 'NKF Ipoh',
    'nkf_penang' => 'NKF Penang',
    'nkf_johor_bahru' => 'NKF Johor Bahru',
    'nkf_kota_bharu' => 'NKF Kota Bharu',
    'nkf_kuching' => 'NKF Kuching',
    'nkf_kota_kinabalu' => 'NKF Kota Kinabalu',
];

public array $functionalStatusOptions = [
    'Independent' => 'Independent',
    'Restricted' => 'Restricted',
    'Dependent' => 'Dependent',
];



    public array $form = [
        'name' => '',
        'ic_number' => '',
        'age' => '',
        'gender' => '',
        'marital_status' => '',
        'ethnic' => '',
        'caregiver' => '',
        'education' => '',
        'employment' => '',
        'house_type' => '',
        'house_type_other' => '',
        'payment' => '',
        'payment_other' => '',
        'hd_duration' => '',
        'hd_start_date' => '',
        'months_on_hd' => '',
        'functional_status' => '',
        'esrd_etiology' => '',
        'dialysis_access' => '',
        'comorbidity' => '',
        'cardio_respiratory' => '',
        'muscular_skeletal' => '',
        'neurological' => '',
        'functional_comorbidity' => '',
        // Bio-Chem
        'preDialysisUrea' => '',
        'postDialysisUrea' => '',
        'urr' => '',
        'preTdxWt' => '',
        'postTdxWt' => '',
        'nextDryWt' => '',
        'idwg' => '',
        'qb' => '',
        'dialyzerType' => '',
        'hb' => '',
        'po4' => '',
        'alb' => '',
        'ktv' => '',
        'ca' => '',
        'ipth' => '',
        'alp' => '',
        'ast' => '',
        'all' => '',
        'hba1c' => '',
        'ironSat' => '',
        'ferritin' => '',
        'kPlus2' => '',
    ];

    public function updatedForm($key, $value)
    {
        if (in_array($key, ['house_type', 'payment'])) {
            $this->form["{$key}_other"] = '';
            $this->resetErrorBag("form.{$key}_other");
        }
    }

    protected function messages(): array
{
    return [
        'form.dialysis_centre.required' => 'Please select a dialysis centre.',
        'form.name.required' => 'The name field is required.',
        'form.ic_number.required' => 'Please enter the IC number.',
        'form.age.required' => 'Age is required.',
        'form.age.integer' => 'Age must be a valid number.',
        'form.age.min' => 'Age cannot be negative.',
        'form.age.max' => 'Age seems unusually high.',
        'form.gender.required' => 'Please select a gender.',
        'form.marital_status.required' => 'Please select marital status.',
        'form.ethnic.required' => 'Please select ethnic group.',
        'form.caregiver.required' => 'Caregiver information is required.',
        'form.education.required' => 'Education level is required.',
        'form.employment.required' => 'Employment status is required.',
        'form.house_type.required' => 'Please select a house type.',
        'form.house_type_other.required' => 'Please specify the house type.',
        'form.payment.required' => 'Please select a payment method.',
        'form.payment_other.required' => 'Please specify the payment method.',
        'form.hd_duration.required' => 'Please specify HD duration.',
        'form.hd_start_date.required' => 'Please enter HD start date.',
        'form.hd_start_date.date' => 'Start date must be a valid date.',
        'form.months_on_hd.required' => 'Months on HD is required.',
        'form.months_on_hd.integer' => 'Months on HD must be a number.',
        'form.functional_status.required' => 'Please select the functional status.',
        'form.functional_status.in' => 'Selected functional status is invalid.',
        'form.esrd_etiology.required' => 'ESRD etiology is required.',
        'form.dialysis_access.required' => 'Dialysis access type is required.',
        'form.comorbidity.required' => 'Please fill in comorbidity details.',
        'form.cardio_respiratory.required' => 'Please select Yes or No for cardio-respiratory condition.',
        'form.muscular_skeletal.required' => 'Please select Yes or No for muscular-skeletal condition.',
        'form.neurological.required' => 'Please select Yes or No for neurological condition.',
        'form.functional_comorbidity.required' => 'Please select Yes or No for functional comorbidity.',
        'form.*.required' => 'This field is required.', // fallback for all other fields
    ];
}


    public function updatedFormIcNumber($value)
{
    // Normalize: remove dashes
    $cleanIc = preg_replace('/[^0-9]/', '', $value);

    if (strlen($cleanIc) >= 6) {
        $birthDatePart = substr($cleanIc, 0, 6);

        $year = (int) substr($birthDatePart, 0, 2);
        $month = (int) substr($birthDatePart, 2, 2);
        $day = (int) substr($birthDatePart, 4, 2);

        // Assume cutoff year 00–49 = 2000s, 50–99 = 1900s
        $year += ($year >= 50) ? 1900 : 2000;

        if (checkdate($month, $day, $year)) {
            $birthDate = Carbon::create($year, $month, $day);

            $this->form['age'] = $birthDate->age;
        } else {
            $this->form['age'] = null; // Invalid date
        }
    }
}


    protected function rules(): array
    {
        $rules = [
            'form.dialysis_centre' => 'required',
            'form.name' => 'required|string|max:255',
            'form.ic_number' => 'required|string|max:255',
            'form.age' => 'required|integer|min:0|max:120',
            'form.gender' => 'required',
            'form.marital_status' => 'required',
            'form.ethnic' => 'required',
            'form.caregiver' => 'required',
            'form.education' => 'required',
            'form.employment' => 'required',
            'form.house_type' => 'required',
            'form.payment' => 'required',
            'form.hd_duration' => 'required|string',
            'form.hd_start_date' => 'required|date',
            'form.months_on_hd' => 'required|integer|min:0',
            'form.functional_status' => 'required|in:Independent,Restricted,Dependent',
            'form.esrd_etiology' => 'required',
            'form.dialysis_access' => 'required',
            'form.comorbidity' => 'required|string',
            'form.cardio_respiratory' => 'required|in:yes,no',
            'form.muscular_skeletal' => 'required|in:yes,no',
            'form.neurological' => 'required|in:yes,no',
            'form.functional_comorbidity' => 'required|in:yes,no',
            'form.preDialysisUrea' => 'required',
            'form.postDialysisUrea' => 'required',
            'form.urr' => 'required',
            'form.preTdxWt' => 'required',
            'form.postTdxWt' => 'required',
            'form.nextDryWt' => 'required',
            'form.idwg' => 'required',
            'form.qb' => 'required',
            'form.dialyzerType' => 'required',
            'form.hb' => 'required',
            'form.po4' => 'required',
            'form.alb' => 'required',
            'form.ktv' => 'required',
            'form.ca' => 'required',
            'form.ipth' => 'required',
            'form.alp' => 'required',
            'form.ast' => 'required',
            'form.all' => 'required',
            'form.hba1c' => 'required',
            'form.ironSat' => 'required',
            'form.ferritin' => 'required',
            'form.kPlus2' => 'required',
        ];

        if ($this->form['house_type'] === 'others') {
            $rules['form.house_type_other'] = 'required|string|max:255';
        }

        if ($this->form['payment'] === 'Others') {
            $rules['form.payment_other'] = 'required|string|max:255';
        }

        return $rules;
    }

public function submit()
{
    $validated = $this->validate();

    // Handle the data (e.g., save to DB)
    $this->isSubmitted = true;

    session()->flash('success', 'Form submitted successfully!');
}


    public function render()
    {
        return view('livewire.forms.f22-welfare-records');
    }
}
