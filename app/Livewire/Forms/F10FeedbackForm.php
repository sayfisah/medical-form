<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class F10FeedbackForm extends Component
{
    public bool $isSubmitted = false;

    public array $form = [
        // We have 8 questions: q1 … q8
        'responses' => [], // store values
    ];

    protected function rules(): array
    {
        $rules = [];
        for ($i = 1; $i <= 8; $i++) {
            $rules["form.responses.$i"] = 'required|in:1,2,3,4,5,6';
        }
        return $rules;
    }

    protected function messages(): array
    {
        $msgs = [];
        for ($i = 1; $i <= 8; $i++) {
            $msgs["form.responses.$i.required"] = "Please provide a response for Question $i.";
            $msgs["form.responses.$i.in"] = "Invalid selection for Question $i.";
        }
        return $msgs;
    }

    public function submit()
    {
        $this->validate();
        // You can persist $this->form['responses'] to database here

        $this->isSubmitted = true;
        session()->flash('success', 'Thank you! Your feedback has been submitted.');
    }

    public function render()
    {
        $questions = [
            "Kebersihan persekitaran kawasan (ruang menunggu, bilik rawatan, tandas, dll)",
            "Kemudahan dan keselesaan pelanggan (bahan bacaan, ruang menunggu)",
            "Tempoh berurusan cepat dan tepat",
            "Layanan petugas di kaunter (sopan, berbudi bahasa)",
            "Petugas mendengar dengan teliti dan memahami masalah pelanggan serta sedia membantu",
            "Berkebolehan untuk menjawab pertanyaan /masalah dengan jelas dan tepat",
            "Pelanggan yakin dan percaya kepada pasukan kami (pasukan CKD/PD) dalam menyelesaikan masalah yang dihadapi/ dirujuk",
            "Pelanggan berpuas hati dengan perkhidmatan yang diberikan",
        ];

        return view('livewire.forms.f10-feedback-form', compact('questions'));
    }
}
