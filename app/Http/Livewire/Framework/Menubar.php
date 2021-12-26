<?php

namespace App\Http\Livewire\Framework;

use App\Models\PageNavigation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * Menubar is a livewire component that
 * builds the menubar based on the
 * page navigations model information.
 */
class Menubar extends Component
{
    /**
     * the array that stores the various
     * menubar items.
     * @var
     */
    public $menu;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        // get the main menu
        $this->menu = PageNavigation::all();
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.menubar');
    }
}
