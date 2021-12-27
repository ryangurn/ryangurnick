<?php

namespace App\Http\Livewire\Framework\Banner;

use App\Models\Page;
use App\Models\PageNavigation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

/**
 * AddMenu is a livewire modal component that
 * allows for a user with the correct permissions
 * to add a menubar item.
 */
class AddMenu extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * the array that stores the pages
     * that are not already in the menu
     * @var
     */
    public $menu_options;

    /**
     * the value that stores the page to add
     * to the menubar
     * @var
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
            'menu_id' => 'required|numeric|exists:pages,id|unique:page_navigations,id'
        ];
    }

    /**
     * the function that when called will add a page to the
     * menu using $menu_id
     * @return void
     * @throws AuthorizationException
     */
    public function save()
    {
        // verify authorization
        $this->authorize('edit menu');

        // validate the request
        $this->validate();

        // add the page to the menu
        PageNavigation::create([
            'page_id' => $this->menu_id,
            'enabled' => true
        ]);

        // refresh the page
        $this->redirect(URL::previous());
    }

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        $in_menu = PageNavigation::all()->pluck('page_id');
        $this->menu_options = Page::whereNotIn('id', $in_menu)->where('name', '<>', 'post')->get();

        if (!$this->menu_options->isEmpty())
        {
            $this->menu_id = $this->menu_options->first()->id;
        }
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.banner.add-menu');
    }
}
