<?php

namespace App\Http\Livewire\Core;

use Livewire\Component;

class CardFooter extends Component
{
    public $show_timestamp = true;

    public $button_text = 'edit';

    public $modal_parameters = [];

    public $show_menu = false;

    public $menu_options = [];

    public $duration;

    public $show = false;

    public $modal;

    public function hidePopup()
    {
        $this->show = false;
    }

    public function showPopup()
    {
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.core.card-footer');
    }
}
