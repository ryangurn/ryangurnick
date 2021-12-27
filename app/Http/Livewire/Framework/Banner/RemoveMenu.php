<?php

namespace App\Http\Livewire\Framework\Banner;

use App\Models\Page;
use App\Models\PageNavigation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

/**
 * RemoveMenu is a livewire modal component that 
 * provides the functionality to remove a menu
 * option.
 */
class RemoveMenu extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * The array that stores the pages which can be added
     * to the menu.
     */
    public $menu_options;

    /**
     * The value that stores the currently selected menu
     * option from the form.
     */
    public $menu_id;

    /**
     * validation rules that will be checked when the
     * modal is saved.
     * @return string[]
     */
    public function rules()
    {
        return [
            'menu_id' => 'required|numeric|exists:page_navigations,id'
        ];
    }

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        // grab the pages currently on the menu.
        $in_menu = PageNavigation::all()->pluck('page_id');

        // get the other pages in the menu already
        $this->menu_options = Page::whereIn('id', $in_menu)->where('name', '<>', 'post')->get();

        // set the default value for the form.
        if (!$this->menu_options->isEmpty())
        {
            $this->menu_id = $this->menu_options->first()->id;
        }
    }

    /**
     * the function that when called will
     * remove a menu item.
     * @return void
     * @throws AuthorizationException
     */
    public function save()
    {
        // ensure the request is authorized
        $this->authorize('delete menu');

        // validate the request
        $this->validate();

        // delete the menu item
        PageNavigation::where('page_id', $this->menu_id)->delete();

        // refresh the page
        $this->redirect(URL::previous());
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.banner.remove-menu');
    }
}
