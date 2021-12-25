<?php

namespace App\Http\Livewire\Framework\Banner;

use App\Models\Page;
use App\Models\PageModule;
use App\Models\PageNavigation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class RemovePage extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    public $page;

    public $pages;

    public function rules()
    {
        return [
            'page' => 'required|numeric|exists:pages,id'
        ];
    }

    public function mount()
    {
        $this->pages = Page::all()->sortBy('name');
        $this->page = $this->pages->first()->id;
    }

    public function save()
    {
        // verify authorization
        $this->authorize('delete page');

        // validate the request
        $this->validate();

        // first delete any menu references
        PageNavigation::where('page_id', '=', $this->page)->delete();

        // delete all the modules from the page.
        PageModule::where('page_id', '=', $this->page)->delete();

        // delete the page.
        Page::where('id', '=', $this->page)->delete();

        // fresh the page.
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.framework.banner.remove-page');
    }
}
