<?php

namespace App\Http\Livewire\Core;

use App\Models\Setting;
use Livewire\Component;

class Footer extends Component
{
    public $copyright;

    public $links;

    public function mount()
    {
        $this->copyright = Setting::where('key', '=', 'footer.copyright')->first();
        $this->links = Setting::where('key', '=', 'footer.links')->first();
    }

    public function render()
    {
        return view('livewire.core.footer');
    }
}
