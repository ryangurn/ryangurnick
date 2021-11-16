<?php

namespace App\Http\Livewire\Core;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
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

    public $page_module;

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

    public function enable()
    {
        $this->page_module->enabled = true;
        $this->page_module->save();

        $this->redirect(URL::previous());
    }

    public function disable()
    {
        $this->page_module->enabled = false;
        $this->page_module->save();

        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.core.card-footer');
    }
}
