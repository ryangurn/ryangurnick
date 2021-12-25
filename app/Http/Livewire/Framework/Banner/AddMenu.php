<?php

namespace App\Http\Livewire\Framework\Banner;

use App\Models\Page;
use App\Models\PageNavigation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class AddMenu extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    public $menu_options;

    public $menu_id;

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

    public function mount()
    {
        $in_menu = PageNavigation::all()->pluck('page_id');
        $this->menu_options = Page::whereNotIn('id', $in_menu)->where('name', '<>', 'post')->get();

        if (!$this->menu_options->isEmpty())
        {
            $this->menu_id = $this->menu_options->first()->id;
        }
    }

    public function render()
    {
        return view('livewire.framework.banner.add-menu');
    }
}
