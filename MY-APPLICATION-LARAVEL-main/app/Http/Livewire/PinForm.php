<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PinForm extends Component
{
    public $pin_code = '';
    public $input = ["", "", "", ""];
    public $message = '';

    protected $rules = [
        'pin_code' => 'required|digits:4|numeric',
    ];

    protected $messages = [
        'pin_code.required' => 'Le code PIN est requis.',
        'pin_code.digits' => 'Le code PIN doit contenir exactement 4 chiffres.',
        'pin_code.numeric' => 'Le code PIN ne doit contenir que des chiffres.',
    ];

    public function updatePin($index, $value)
    {
        if (ctype_digit($value)) {
            $this->input[$index] = $value;

            if ($value !== "" && $index < 3) {
                $this->dispatchBrowserEvent('focusNextInput', ['index' => $index + 1]);
            }
        } else {
            $this->input[$index] = "";

            if ($index > 0) {
                $this->dispatchBrowserEvent('focusPreviousInput', ['index' => $index - 1]);
            }
        }

        $this->pin_code = implode('', $this->input);

        if (strlen($this->pin_code) === 4) {
            $this->submitForm();
        }
    }

    public function submitForm()
    {
        $this->validate();
        $this->dispatchBrowserEvent('submitPIN');
    }

    public function resetForm()
    {
        $this->input = ["", "", "", ""];
        $this->pin_code = '';
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.pin-form');
    }
}