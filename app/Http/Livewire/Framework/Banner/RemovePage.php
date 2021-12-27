<?php

namespace App\Http\Livewire\Framework\Banner;

use App\Models\Page;
use App\Models\PageModule;
use App\Models\PageNavigation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * RemovePage is a livewire modal component that provides
 * the functionality to remove a page. It also removes 
 * the menu option for the selected page.
 */
class RemovePage extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * The value that stores the page identifier that will
     * be removed.
     */
    public $page;

    /**
     * The array that stores all of the page models.
     */
    public $pages;

    /**
     * validation rules that will be checked when the
     * modal is saved.
     * @return string[]
     */
    public function rules()
    {
        return [
            'page' => 'required|numeric|exists:pages,id'
        ];
    }

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        $this->pages = Page::all()->sortBy('name');
        $this->page = $this->pages->first()->id;
    }

    /**
     * the function that when called will
     * remove a page.
     * @return void
     * @throws AuthorizationException
     */
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

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.banner.remove-page');
    }
}
