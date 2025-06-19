<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf;

class F2ApdTermination extends Component
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
    'text' => 'Prepare trolley before procedure',
    'steps' => [
        '1.1 Clean trolley/work surface',
        '1.2 Identify and gather supplies for termination procedure',
    ],
],

            [
    'text' => 'Preparation of Home Choice automated PD machine for termination procedure',
    'steps' => [
        '2.1 Start the procedure when <b>End Therapy</b> appears on the screen.',
        '2.2 Press the green button.',
        '2.3 Wait until <b>Close All Clamps</b> appears on the machine screen. <br><br>
        2.4 Close all clamps.',
    ],
],
[
    'text' => 'Disconnect patient line from the transfer set',
    'steps' => [
        '3.1 Read <b>Total UF</b> and document in the APD treatment book.',
        '3.2 Wait for <b>Disconnect Yourself</b> to appear on the screen.',
        '3.3 Wear face mask and perform hand washing.',
        '3.4 Loosen gauze wrap on the transfer set.',
        '3.5 Tighten the roller clamp.',
        '3.6 Open new mini cap from packaging.',
        '3.7 Perform hand rub.',
        '3.8 Disconnect patient line from the transfer set.',
    ],
],
[
    'text' => 'Remove Home Choice and tubing from the machine tray',
    'steps' => [
        '4.1 Press the green button and wait for <b>Turn Me Off</b> to appear on the screen.',
        '4.2 Remove the cassette from the machine.',
    ],
],
[
    'text' => 'Switch Off HomeChoice automated PD machine',
    'steps' => [
        '5.1 Switch off the machine by pressing the button at the back of the machine.',
        '5.2 Clean the machine.',
        '5.3 Place discarded tubing into a plastic bag and dispose into clinical waste bin.',
    ],
],
[
    'text' => 'Documentation',
    'steps' => [
        '6.1 Record patient’s body weight.',
        '6.2 Take BP reading.',
        '6.3 Record all parameters in the APD treatment record book.',
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
        return view('livewire.forms.f2-apd-termination');
    }
}
