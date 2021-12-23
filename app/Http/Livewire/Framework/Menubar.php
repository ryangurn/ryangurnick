<?php

namespace App\Http\Livewire\Framework;

use App\Models\PageNavigation;
use Livewire\Component;

class Menubar extends Component
{
    public $menu;

    public function mount()
    {
        // get the main menu
        $this->menu = PageNavigation::all();
    }

    public function render()
    {
        return view('livewire.framework.menubar');
    }
}
