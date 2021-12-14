<?php

namespace App\Http\Livewire\Core;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

/**
 * FooterMetadata is a livewire component that provides
 * metadata on each module card. Its aim is to standardize
 * the information that is shown to authenticated users
 * about each module that it is on.
 */
class FooterMetadata extends Component
{
    /**
     * the variable that stores the duration
     * for use in the view.
     * @var
     */
    public $duration;

    /**
     * the variable that stores the page name
     * for use in the view.
     * @var
     */
    public $page;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        // ensure the duration is not null and calculate the human-readable diff
        // or unknown if the duration provided is null
        $this->duration = ($this->duration != null) ? $this->duration->diffForHumans() : 'Unknown';

        // get the current route name for the page the module is on.
        $this->page = Route::currentRouteName();
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.core.footer-metadata');
    }
}
