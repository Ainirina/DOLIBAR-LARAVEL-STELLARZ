<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $header;
    public $title;
    public $subtitle;
    public $content;
    public $footer;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($header = null, $title = null, $subtitle = null, $content = null, $footer = null)
    {
        $this->header = $header;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->$content = $content;
        $this->footer = $footer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.card');
    }
}
