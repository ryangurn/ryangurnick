<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $page_module;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pm)
    {
        $this->page_module = $pm;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}