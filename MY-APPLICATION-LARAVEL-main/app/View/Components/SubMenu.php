<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubMenu extends Component
{
    /**
     * Les données du menu.
     *
     * @var array
     */
    public $menu;

    /**
     * Crée une nouvelle instance du composant.
     *
     * @param  array  $menu
     * @return void
     */
    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    /**
     * Récupère la vue qui représente le composant.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.SubMenu');
    }
}
