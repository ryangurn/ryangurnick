<?php

namespace App\Http\Livewire\Framework;

use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * AuthTemplate is a livewire component that
 * acts as a singular include for the various
 * slideovers and menus provided to a user
 * with the proper permissions.
 */
class AuthTemplate extends Component
{
    /**
     * the value that stores the page model
     *
     * @var
     */
    public $page;

    /**
     * the page identifier used to get the
     * page model.
     *
     * @var
     */
    public $page_id;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->page = Page::where('id', $this->page_id)->first();
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.auth-template');
    }
}
