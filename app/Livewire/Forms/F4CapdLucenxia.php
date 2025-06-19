<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf;

class F4CapdLucenxia extends Component
{
    public $name, $nric, $date;
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
        '3.1 Perform the following steps: <br><br>3.1.1 Wear face mask',
        '3.1.2 Perform hand washing with correct technique',
        '3.1.3 Dry hands with tissue',
    ],
],
[
    'text' => 'Check the PD bag solution',
    'steps' => [
        '4.1 Open and remove the plastic wrap from the PD bag solution',
        '4.2 Perform hand rub',
        '4.3 Check details on PD bag solution such as: ,br><br>4.3.1 Expiry date',
        '4.3.2 Volume of the bag',
        '4.3.3 Concentration of dialysate',
        '4.3.4 Leakage of the dialysate bag, tubing & drainage bag',
        '4.3.5 Dialysate is clear',
        '4.3.6 The seal of PD bag solution is still intact',
    ],
],
[
    'text' => 'Connect the transfer set',
    'steps' => [
        '5.1 Take out the transfer set from the pouch',
        '5.2 Perform hand rub',
        '5.3 Connect the transfer set to the dialysate lines:',
        '5.3.1 Ensure a clean environment & avoid contamination',
        '5.3.2 Confirm the connection is tight and secured',
    ],
],
[
    'text' => 'Drain phase',
    'steps' => [
        '6.1 Break the seal from PD dialysate bag',
        '6.2 Hang PD dialysate bag on the drip stand',
        '6.3 Place PD effluent bag at the bottom of the bucket or drip stand',
        '6.4 Ensure the tube is not folded',
        '6.5 Open clamp from PD effluent bag set',
        '6.6 Drain PD effluent fluid from the peritoneal cavity',
        '6.7 Observe the drain phase',
        '6.8 Ensure PD effluent flows out smoothly',
        '6.9 Check appearance of PD effluent (clear effluent)',
        '6.10 Close roller clamp when PD effluent drainage is completed',
    ],
],
[
    'text' => 'Fill-in phase',
    'steps' => [
        '7.1 Open the fill clamp',
        '7.2 Flush before filling PD dialysate',
        '7.3 Close the drain clamp',
        '7.4 Fill in PD dialysate into the peritoneal cavity (5-10 min)',
        '7.5 Close the fill clamp and roller clamp from transfer set',
    ],
],
[
    'text' => 'Disconnect transfer set from dialysate lines',
    'steps' => [
        '8.1 Perform hand rub',
        '8.2 Open new mini cap from packaging',
        '8.3 Separate transfer set from dialysate line',
        '8.4 Apply new mini cap to the transfer set',
        '8.5 Store transfer set inside the pouch',
    ],
],
[
    'text' => 'Documentation',
    'steps' => [
        '9.1 Record the following items into the PD treatment record book:',
        '9.1.1 Weight of the effluent bag',
        '9.1.2 Concentration of dialysate',
        '9.1.3 Total volume in',
        '9.1.4 Total volume out',
        '9.1.5 Net UF',
    ],
],
[
    'text' => 'Effluent disposal',
    'steps' => [
        '10.1 Cut the PD effluent bag',
        '10.2 Remove effluent (waste) into the toilet bowl and flush',
        '10.3 Dispose of the PD effluent bag in a clinical waste bin',
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
        return view('livewire.forms.f4-capd-lucenxia');
    }
}
