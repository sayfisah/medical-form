<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf;

class F1ApdCommence extends Component
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
                'text' => 'Take vital signs',
                'steps' => [
                    'Check the following before 1st exchange & after last exchange:<br>1.1 Body weight',
                    '1.2 Blood pressure reading (B/P)',
                    '1.3 Body temperature',
                    '1.4 All parameters will be recorded into APD treatment book.',
                ],
            ],
            [
                'text' => 'Preparation of PD supplies and equipment',
                'steps' => [
                    '2.1 Clean work area.',
                    '2.2 Prepare PD supplies:
                    <ul style="list-style-type: disc; padding-left: 20px;">
                        <li>PD dialysate</li>
                        <li>Home Choice cassette</li>
                        <li>Mask, mini cap, hand rub</li>
                        <li>Gauze & plaster</li>
                    </ul>',
                ],
            ],
             [
                'text' => 'Start Home Choice automated PD machine',
                'steps' => [
                    '3.1 Press ON button which is located at the back of the machine until Press Go To Start appears on the screen.',
                    '3.2 Press the green button',
                    '3.3 Wait until Load The Set appears on the screen.',
                ],
            ],
                         [
                'text' => 'Management of Home Choice automated PD machine',
                'steps' => [
                    '4.1 Wear face mask.',
                    '4.2 Perform hand washing.',
                    '4.3 Remove Home Choice cassette wrap.',
                    '4.4 Close all clamps.',
                    '4.5 Load the cassette by inserting the bottom edge and press on <br>

(Note: Window of cassette compartment only will be opened manually when “Load The Set” or “Turn Me Off” is appear on the screen).',
                    '4.5.1 Pull the tubing to the correct position',
                    '4.5.2 Close and lock the window of cassette compartment.',
                    '4.5.3 Insert the end of the drain tubing into the receiver.',
                    '4.5.4 Press the green button and wait until “Self Testing” appears on the screen.',
                    
                ],
            ],
                         [
                'text' => 'Check PD bag solution',
                'steps' => [
                    '5.1 Perform hand washing.',
                    '5.2 Remove the plastic wrap of APD dialysate bag',
                    '5.3 Perform hand rub.',
                    '5.4 Check APD dialysate bag for the following details such as:<br>5.4.1 Expiry date',
                    '5.4.2 Volume of the bag',
                    '5.4.3 Dialysate concentration',
                    '5.4.4 check as below:<br>5.4.4.1 Look for any leakages by squeezing both sides of the PD bag solution',
                    '5.4.5 Dialysate appearance is clear',
                    '5.4.6 Green frangible ring intact',
                    '6.5 Repeat same procedure for the rest of PD solution bags',
                    

                ],
            ],
                         [
                'text' => '	Connect PD dialysate bag',
                'steps' => [
                    '6.1 Perform hand rub.',
                    '6.2 Wait until “Connect Bags” appear on the screen.',
                    '6.3 Connect:
<ul style="list-style-type: disc; padding-left: 20px;">
    <li>Red clamp tubing to Heater Bag</li>
    <li>White and blue tubing to PD bag</li>
</ul>',

                    '6.4 Make sure the connection procedure is performed in clean environment and avoid contamination.',
                                        '6.4.1 Ensure the connection is tight and secured.',
                    '6.4.2 Break the green frangible seal and open the tubing clamp for dialysate flow.',
                    '6.5 Repeat the same procedures for the rest of the PD solution bags',


                ],
            ],
                         [
                'text' => 'Priming phase',
                'steps' => [
                    '	
7.1 Open all clamps.',
                    '7.2 Press the green button and wait until “Priming” appears on the screen. (The priming process takes about 5-7 minutes approximately.)',
                    '7.3 When priming is completed, press the green button.<br>7.4 Proceed to next step.',

                ],
            ],
                         [
                'text' => '	Connect patient’s line to the transfer set',
                'steps' => [
                    '8.1 Perform hand washing.',
                    '8.2 “Connect Yourself” appears on the screen.',
                    '8.3 Close tubing clamp of patient line.',
                    '8.4 Take out transfer set from waist pouch of the patient.',
                    '8.5 Perform hand rub.',
                    '8.6 Remove the blue pull ring from the patient’s line.',
                    '8.7 Remove the mini cap from transfer set carefully.',
                    '8.8 Connect both patient’s line and transfer set securely.',
                    '8.9 Loosen the adjustable clamp of the transfer set and the clamp on the patient’s line.',
                    '8.10 Wrap transfer sets with gauze and plaster properly.',
                    '8.11 Press the green button twice and wait until “Initial Drain” appears on the screen.',
                    '8.12 The treatment program is started.',

                ],
            ],
             [
                'text' => 'Documentation',
                'steps' => [
                    '	
9.1 The amount of Initial Drain will be recorded in the patient’s treatment book.',
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
        return view('livewire.forms.f1-apd-commence');
    }
}
