<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InputText extends Component
{
    public $label;
    public $name;
    public $value = '';
    public $placeholder;
    public $required = false;
    public $maxlength = 255;
    public $disabled = false; // Ajout de l'option pour désactiver l'input

    protected $rules = [
        'value' => 'required',
    ];

    public function updatedValue()
    {
        $this->validate();
    }

    public function mount($name, $value = '', $placeholder = '', $required = false, $disabled = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('livewire.input-text');
    }
}
