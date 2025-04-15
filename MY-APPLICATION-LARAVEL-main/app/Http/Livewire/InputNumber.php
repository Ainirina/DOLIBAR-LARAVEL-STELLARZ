<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InputNumber extends Component
{
    public $name;
    public $inputId;
    public $label = 'Nom'; // Libellé par défaut
    public $required = false; // Champ obligatoire
    public $placeholder = ''; // Placeholder
    public $disabled = false; // Champ désactivé
    public $min;
    public $max;
    public $suffix = '';
    public $prefix = '';
    public $thousandsSeparator = ',';
    public $decimalSeparator = '.';
    public $fluid = false;
    public $value;
    public $displayValue;
    public $message;

    protected $rules = [
        'value' => 'required|numeric',
    ];

    public function updatedDisplayValue($displayValue)
    {
        $rawValue = $this->extractRawValue($displayValue);

        $this->value = $rawValue;
        $this->validate();

        $this->displayValue = $this->formatValue($this->value);
    }

    protected function extractRawValue($displayValue)
    {
        $rawValue = str_replace([$this->prefix, $this->suffix, $this->thousandsSeparator], '', $displayValue);

        $rawValue = str_replace($this->decimalSeparator, '.', $rawValue);

        return (float) $rawValue;
    }

    protected function formatValue($value)
    {
        $formattedValue = number_format(
            $value,
            2,
            $this->decimalSeparator,
            $this->thousandsSeparator
        );

        if ($this->suffix) {
            $formattedValue = $formattedValue . ' ' . $this->suffix;
        }

        if ($this->prefix) {
            $formattedValue = $this->prefix . ' ' . $formattedValue;
        }

        return $formattedValue;
    }

    public function render()
    {
        return view('livewire.input-number');
    }
}