<?php

namespace App\Http\Livewire\Framework;

use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * SiteMeta is a livewire component that exists
 * to provide meta tags that optimize for SEO.
 */
class SiteMeta extends Component
{
    /**
     * the variable stores the current indexing
     * options.
     *
     * @var
     */
    public $indexing;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->indexing = (Setting::where('key', 'application.index')->first() != null) ? Setting::where('key', 'application.index')->first()->value : 'none';
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.site-meta');
    }
}
