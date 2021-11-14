<?php

namespace App\Http\Livewire\Core;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CardFooter extends Component
{
    public $auth_required = true;

    public $auth = false;

    public $show_timestamp = true;

    public $button_text = 'edit';

    public $modal_parameters = [];

    public $show_menu = false;

    public $menu_options = [];

    public $duration;

    public $show = false;

    public $modal;

    public function mount()
    {
        $this->auth = Auth::check();
    }

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
