<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Card is a livewire component that handles
 * the default card layout for many other
 * modules.
 */
class Card extends Component
{
    /**
     * The value that stores the page module
     * model for use in the view. Mainly used 
     * to pass the model to other modules.
     */
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
