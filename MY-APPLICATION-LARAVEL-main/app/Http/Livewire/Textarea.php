<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Textarea extends Component
{
    public $name;
    public $label;
    public $value;
    public $placeholder;
    public $rows;
    public $required;
    public $disabled;

    protected $rules = [
        'value' => 'required|max:255',
    ];

    public function updatedValue()
    {
        $this->validate();
    }

    public function mount($name, $label = null, $value = '', $placeholder = '', $rows = 4, $required = false, $disabled = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
        $this->required = $required;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('livewire.textarea');
    }
}