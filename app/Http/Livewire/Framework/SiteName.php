<?php

namespace App\Http\Livewire\Framework;

use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * SiteName is a livewire component that
 * provides a standardized method for grabbing
 * the site name.
 */
class SiteName extends Component
{
    /**
     * The value that stores the current application
     * site name.
     */
    public $sitename;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->sitename = Setting::where('key', 'application.sitename')->first();
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.site-name');
    }
}
