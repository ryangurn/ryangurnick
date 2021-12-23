<?php

namespace App\Http\Livewire\Framework;

use App\Models\Setting;
use Livewire\Component;

class SiteName extends Component
{
    public $sitename;

    public function mount()
    {
        $this->sitename = Setting::where('key', 'application.sitename')->first();
    }

    public function render()
    {
        return view('livewire.framework.site-name');
    }
}
