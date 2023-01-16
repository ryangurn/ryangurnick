<?php

namespace App\Http\Livewire\Framework;

use App\Models\ModuleParameter;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * SiteTitle is the livewire component that
 * sets up the title tag for the application.
 */
class SiteTitle extends Component
{
    /**
     * The value that stores the current page name.
     */
    public $page;

    /**
     * The value that store the current post title.
     */
    public $post;

    /**
     * The value that stores the application's site
     * name.
     */
    public $sitename;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount(Page $page, $post = null)
    {
        $this->post = $post != null ? ModuleParameter::where('hash', '=', $post)->where('parameter', '=', 'title')->first()->value : null;
        $this->page = $page;
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
        return view('livewire.framework.site-title');
    }
}
