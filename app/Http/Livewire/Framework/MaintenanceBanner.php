<?php

namespace App\Http\Livewire\Framework;

use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * MaintenanceBanner is a livewire ocmponent that provides
 * a banner on the top of the website, to notify authenticated
 * users that they are current in maintenance mode. Seeing this
 * means that unauthenticated users will not be able to view
 * any content on the website, instead they will see the 503
 * page.
 */
class MaintenanceBanner extends Component
{
    /**
     * this variable stores a boolean that determines if the application
     * is in maintenance mode. it is used within the view to show the
     * banner.
     *
     * @var
     */
    public $maintenance_mode;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->maintenance_mode = Setting::where('key', 'application.maintenance')->first()->value && auth()->check();
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.maintenance-banner');
    }
}
