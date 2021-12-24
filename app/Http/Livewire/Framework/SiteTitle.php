<?php

namespace App\Http\Livewire\Framework;

use App\Models\ModuleParameter;
use App\Models\Page;
use App\Models\Setting;
use Livewire\Component;

class SiteTitle extends Component
{
    public $page;

    public $post;

    public $sitename;

    public function mount(Page $page, $post = null)
    {
        $this->post = $post != null ? ModuleParameter::where('hash', '=', $post)->where('parameter', '=', 'title')->first()->value : null;
        $this->page = $page;
        $this->sitename = Setting::where('key', 'application.sitename')->first();
    }

    public function render()
    {
        return view('livewire.framework.site-title');
    }
}
