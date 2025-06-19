<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf;

class F3CapdFmc extends Component
{
    public $name, $nric, $date;
    public $dialysis_centre = '';
    public $assessment = '';
    public $questions = [];
    public $answers = [];
    public $remarks = [];
    public $final_remark = '';
    public $training_by = '';
    public $isSubmitted = false;
    public function mount()
    {
        $this->questions = [
[
    'text' => 'Take Vital Signs',
    'steps' => [
        '1.1.1 Body weight',
        '1.1.2 Blood pressure reading (B/P)',
        '1.1.3 Body temperature',
        '1.2 All parameters will be recorded into CAPD treatment book',
    ],
],
[
    'text' => 'Arrange CAPD equipment on the table',
    'steps' => [
        '2.1 Clean the work area',
        '2.2 Prepare the following items: <br><br>
        2.2.1 Drip stand',
        '2.2.2 PD dialysate bag',
        '2.2.3 Disinfectant cap/mini cap',
        '2.2.4 Disinfectant spray',
    ],
],
[
    'text' => 'Before PD exchange procedure',
    'steps' => [
        '3.1 Perform the following steps: <br><br>
        3.1.1 Wear face mask',
        '3.1.2 Perform hand washing with correct technique',
        '3.1.3 Dry hands with tissue',
    ],
],
[
    'text' => 'Check the PD bag solution',
    'steps' => [
        '4.1 Open and remove the plastic wrap from the PD bag solution.',
        '4.2 Perform hand rub.',
        '4.3 Check details on PD bag solution such as: <br><br>
        4.3.1 Expiry date',
        '4.3.2 Volume of the bag',
        '4.3.3 Concentration of dialysate',
        '4.3.4 Leakage of the dialysate bag, tubing & drainage bag',
        '4.3.5 Dialysate is clear',
        '4.3.6 The seal of PD bag solution is still intact',
    ],
],
[
    'text' => 'Perform APD Termination Procedure',
'steps' => [
    // 1 mark: 5.1 + 5.2
    '5.1 Put Disc inside the organizer and press hard to ensure it attaches properly.<br><br>5.2 Insert and press dialysate line into the line tube compartment.',

    // 2 mark: 5.3 + 5.4
    '5.3 Loosen the rolls between Disc and the drainage bag.<br><br>5.4 Hang dialysate bag on the drip stand.',

    // 3 mark: 5.5
    '5.5 Put PD effluent bag at the bottom of the bucket or hang it.',

    // 4 mark: 5.6 + 5.7
    '5.6 Take out the transfer set from pouch.<br><br>5.7 Perform hand rub.',

    // 5 mark: 5.8.1
    '5.8.1 Insert the tip of the transfer set into the hole which located at the right side of the organizer.',

    // 6 mark: 5.8.2
    '5.8.2 Ensure it is inserted completely into the organizer.',

    // 7 mark: 5.8.3
    '5.8.3 Perform hand rub.',

    // 8 mark: 5.8.4
    '5.8.4 Open the cap of the Disc and discard it.',

    // 9 mark: 5.8.5
    '5.8.5 Connect the transfer set to the Disc.',

    // 10 mark: 5.8.6
    '5.8.6 Ensure the connection is safe from contamination and secured.',
],

],
[
    'text' => 'Drain phase',
    'steps' => [
        '6.1 Ensure the Disc knob is in the ONE dot position (●).',
        '6.2 Open the clamp of the transfer set to start the outflow.',
        '6.3 Drain PD eluent from the peritoneal cavity.',
        '6.4 Observe the drain phase to ensure a smooth outflow.',
        '6.5 Check the appearance of PD effluent (should be clear).',
        '6.6 Ensure the process takes 15-20 minutes.',
    ],
],
[
    'text' => 'Flush the catheter before fill',
    'steps' => [
        '7.1 After drain phase, turn the Disc knob to TWO dots (●●) for flushing.',
        '7.2 Count 1 to 10 during flushing (50-60ml estimated flush volume).',
        '7.3 Catheter will be flushed with fresh solution into drainage bag.',
    ],
],
[
    'text' => 'Fill-in phase',
    'steps' => [
        '8.1 Turn the Disc knob clockwise to THREE dots (●●●).',
        '8.2 Determine inflow speed using icons: <br><br>
        8.2.1 (◦) Slow inflow',
        '8.2.2 ( ) Partial inflow',
        '8.2.3 (●) Fast inflow',
        '8.3 Peritoneal cavity is filled with fresh PD dialysate (5-10 minutes).',
    ],
],
[
    'text' => 'Disconnect transfer set from dialysate lines',
'steps' => [
    // 1 mark: 9.1
    '9.1 After fill phase completed then continue by turning the Disc knob clockwise to FOUR dots (●●●●)

(Safety pin inside the Disc knob will automatically release into catheter extension to avoid contamination and backflow.)',

    // 2 mark: 9.2 + 9.3 + 9.4
    '9.2 Close the white clip of the transfer set.<br><br>9.3 Open new disinfection cap. <br><br>9.4 Perform hand rub',

    // 3 mark: 9.5 + 9.6
    '9.5 Insert new disinfection cap into the left of the organizer. <br><br>9.6 Disconnect catheter extension (transfer set) from dialysate line.',

    // 4 mark: 9.7
    '9.7 Close the transfer set with new disinfection cap at the left hole of the organizer securely to avoid contamination.',

    // 5 mark: 9.8
    '9.8 Tidy up and keep transfer set inside the pouch.',
],

],
[
    'text' => 'Documentation',
    'steps' => [
        '10.1 Record into the PD treatment record book:',
        '10.1.1 Weight of the effluent bag',
        '10.1.2 Concentration of dialysate',
        '10.1.3 Total volume in',
        '10.1.4 Total volume out',
        '10.1.5 Net UF',
    ],
],
[
    'text' => 'Effluent disposal',
    'steps' => [
        '11.1 Cut the PD effluent bag.',
        '11.2 Remove effluent (waste) into the toilet bowl and flush.',
        '11.3 Dispose of the PD effluent bag in the clinical waste bin.',
    ],
],

           
        ];

        foreach ($this->questions as $qIndex => $question) {
            foreach ($question['steps'] as $sIndex => $_) {
                $this->answers[$qIndex][$sIndex] = null;
            }
            $this->remarks[$qIndex] = '';
        }
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'nric' => ['required', 'string', 'regex:/^\d{6}-\d{2}-\d{4}$/'],
            'date' => 'required|date',
            'dialysis_centre' => 'required|in:nkf_klang,nkf_setapak,nkf_cheras,nkf_subang,nkf_ipoh,nkf_penang,nkf_johor_bahru,nkf_kota_bharu,nkf_kuching,nkf_kota_kinabalu',
            'assessment' => 'required|string|max:255',
            'training_by' => 'required|string',
            'answers.*.*' => 'required|in:yes,no',
        ];

        foreach ($this->answers as $qIndex => $steps) {
            foreach ($steps as $sIndex => $value) {
                $rules["answers.$qIndex.$sIndex"] = 'required|in:yes,no';
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter the name.',
            'nric.required' => 'NRIC is required.',
            'nric.regex' => 'NRIC format is invalid. Please enter in the format XXXXXX-XX-XXXX.',
            'date.required' => 'Date is required.',
            'date.date' => 'Please enter a valid date.',
            'dialysis_centre.required' => 'Please select a dialysis centre.',
            'assessment.required' => 'Please enter who did the assessment.',
            'assessment.string' => 'Assessment must be a valid name.',
            'assessment.max' => 'Assessment name must not exceed 255 characters.',
            'training_by.required' => 'Please specify who completed the training.',
            'answers.*.*.required' => 'Require',
            'answers.*.*.in' => 'Invalid selection, please choose yes or no.',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules(), $this->messages());
    }

    
public function submit()
{
    $this->validate($this->rules(), $this->messages());

    // Save data or process further...

    $this->isSubmitted = true; // Update submission state
    session()->flash('message', 'Form successfully submitted!');
}
    

    public function render()
    {
        return view('livewire.forms.f3-capd-fmc');
    }
}
