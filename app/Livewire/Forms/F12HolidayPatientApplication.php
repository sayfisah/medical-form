<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class F12HolidayPatientApplication extends Component
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

    public array $requestCentres = [
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

    public $dialysis_centre, $patient_name, $ic_no, $phone_no;
    public $physician_name, $physician_centre, $physician_phone_no;
    public $request_centre, $request_date;

    public $etiologies = [];
    public $firstCentres = [];
    public $complications = [];
    public $illnesses = [];
    public $medications = [];

    public $vascular_date, $vascular_status, $vascular_access, $vascular_access_other;
    public $location, $location_other_specify;

    public $investigation_date, $hbsag, $hbsag_value;
    public $antihbs, $antihbs_value, $antihcv, $antihcv_value;
    public $hiv, $hiv_value;
    public $hemoglobin, $calcium, $creatinine, $phosphate, $urea, $alt;

    public $presc_date, $dry_weight, $dialysis_frequency, $dialysis_duration, $dialyzer_type, $dialyzer_size;
    public $heparin_bolus, $heparin_hourly, $blood_flow;

    public function mount()
    {
        $this->etiologies = [
            ['etiology' => 'Diabetes Mellitus'],
            ['etiology' => 'Hypertension'],
        ];

        $this->firstCentres = [
            ['date' => '2023-01-15', 'centre' => 'Hospital A'],
            ['date' => '2023-06-20', 'centre' => 'Clinic B'],
        ];

        $this->complications = [
            ['complication' => 'Hypotension'],
            ['complication' => 'Muscle Cramps'],
        ];

        $this->illnesses = [
            ['illness' => 'Hypertension'],
            ['illness' => 'Diabetes Mellitus'],
        ];

        $this->medications = [
            ['name' => 'Amlodipine', 'allergy' => 'Yes'],
            ['name' => 'Metformin', 'allergy' => 'No'],
        ];
    }

    protected function rules()
    {
        return [
            'dialysis_centre' => 'required|string',
            'patient_name' => 'required|string|max:255',
            'ic_no' => 'required|string',
            'phone_no' => 'required|string',
            'physician_name' => 'required|string',
            'physician_centre' => 'required|string',
            'physician_phone_no' => 'required|string',
            'request_centre' => 'required|string',
            'request_date' => 'required|date',

            'etiologies.*.etiology' => 'required|string|max:255',
            'firstCentres.*.date' => 'required|date',
            'firstCentres.*.centre' => 'required|string|max:255',
            'complications.*.complication' => 'required|string|max:255',
            'illnesses.*.illness' => 'required|string|max:255',
            'medications.*.name' => 'required|string|max:255',
            'medications.*.allergy' => 'nullable|string|max:255',

            'vascular_date' => 'required|date',
            'vascular_status' => 'required|string|max:255',
            'vascular_access' => 'required|string|in:AVFistula,AVGraft,nil,other',
            'vascular_access_other' => 'required_if:vascular_access,other|string|max:255',
            'location' => 'required|string|in:left-arm,right-arm,others',
            'location_other_specify' => 'required_if:location,others|string|max:255',

            'investigation_date' => 'required|date',
            'hbsag' => 'required|in:positive,negative,unknown',
            'hbsag_value' => 'required_if:hbsag,positive|string|max:255',
            'antihbs'=> 'required|in:positive,negative,unknown',
            'antihbs_value' => 'required_if:antihbs,positive|string|max:255',
            'antihcv'=> 'required|in:positive,negative,unknown',
            'antihcv_value'=>'required_if:antihcv,positive|string|max:255',
            'hiv'=> 'required|in:positive,negative,unknown',
            'hiv_value'=>'required_if:hiv,positive|string|max:255',
            'hemoglobin'=>'nullable|numeric',
            'calcium'=>'nullable|numeric',
            'creatinine'=>'nullable|numeric',
            'phosphate'=>'nullable|numeric',
            'urea'=>'nullable|numeric',
            'alt'=>'nullable|numeric',

            'presc_date'=>'required|date',
            'dry_weight'=>'required|numeric',
            'dialysis_frequency'=>'required|string',
            'dialysis_duration'=>'required|string',
            'dialyzer_type'=>'required|string',
            'dialyzer_size'=>'required|string',
            'heparin_bolus'=>'nullable|numeric',
            'heparin_hourly'=>'nullable|numeric',
            'blood_flow'=>'nullable|numeric',
        ];
    }

    protected function messages()
    {
        return [
            'vascular_access_other.required_if' => 'Please specify other vascular access.',
            'location_other_specify.required_if' => 'Please specify location.',
            'hbsag_value.required_if' => 'Please input HBsAg value since result is positive.',
            'antihbs_value.required_if' => 'Please input AntiHBS value since result is positive.',
            'antihcv_value.required_if' => 'Please input AntiHCV value since result is positive.',
            'hiv_value.required_if' => 'Please input HIV value since result is positive.',
        ];
    }

    public function submit()
    {
        $this->validate();
        $this->isSubmitted = true;
        session()->flash('success', 'Form submitted successfully!');
    }

    public function render()
    {
        return view('livewire.forms.f12-holiday-patient-application', [
            'dialysisCentres' => [
                '' => 'Please select',
                'Centre A' => 'Centre A',
                'Centre B' => 'Centre B',
                'Centre C' => 'Centre C',
            ],
            'nkfDialysisCentres' => $this->nkfDialysisCentres,
            'requestCentres' => $this->requestCentres,
        ]);
    }
}