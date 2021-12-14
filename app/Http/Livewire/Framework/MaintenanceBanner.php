<?php

namespace App\Http\Livewire\Framework;

use App\Models\Setting;
use Livewire\Component;

class MaintenanceBanner extends Component
{
    public $maintenance_mode;

    public function mount()
    {
        $this->maintenance_mode = Setting::where('key', 'application.maintenance')->first()->value && auth()->check();
    }

    public function render()
    {
        return view('livewire.framework.maintenance-banner');
    }
}
