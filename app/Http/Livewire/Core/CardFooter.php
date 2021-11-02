<?php

namespace App\Http\Livewire\Core;

use Livewire\Component;

class CardFooter extends Component
{
    public $duration;

    public $show = false;

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
