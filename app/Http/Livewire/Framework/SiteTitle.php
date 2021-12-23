<?php

namespace App\Http\Livewire\Framework;

use App\Models\Page;
use App\Models\Setting;
use Livewire\Component;

class SiteTitle extends Component
{
    public $page;

    public $sitename;

    public function mount(Page $page)
    {
        $this->page = $page;
        $this->sitename = Setting::where('key', 'application.sitename')->first();
    }

    public function render()
    {
        return view('livewire.framework.site-title');
    }
}
