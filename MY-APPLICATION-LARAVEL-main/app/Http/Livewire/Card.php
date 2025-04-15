<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Card extends Component
{
    public $header;
    public $title;
    public $subtitle;
    public $content;
    public $footer;

    public function render()
    {
        return view('livewire.card'); // Rendre la vue du composant
    }
}

