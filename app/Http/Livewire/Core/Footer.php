<?php

namespace App\Http\Livewire\Core;

use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * Footer is a livewire component that is displayed
 * at the bottom of each page and displays
 * copyright information along with social links.
 */
class Footer extends Component
{
    /**
     * the variable that stores the copyright information
     * for use in the view.
     *
     * @var
     */
    public $copyright;

    /**
     * the variable that stores the links information
     * for use in the view.
     *
     * @var
     */
    public $links;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->copyright = Setting::where('key', '=', 'footer.copyright')->first();
        $this->links = collect(Setting::where('key', '=', 'footer.links')->first()->value);
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.core.footer');
    }
}
