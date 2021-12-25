<?php

namespace App\Http\Livewire\Framework\Banner;

use App\Models\Page;
use App\Models\PageNavigation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class RemoveMenu extends ModalComponent
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
            'menu_id' => 'required|numeric|exists:page_navigations,id'
        ];
    }

    public function mount()
    {
        $in_menu = PageNavigation::all()->pluck('page_id');
        $this->menu_options = Page::whereIn('id', $in_menu)->where('name', '<>', 'post')->get();

        if (!$this->menu_options->isEmpty())
        {
            $this->menu_id = $this->menu_options->first()->id;
        }
    }

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

    public function render()
    {
        return view('livewire.framework.banner.remove-menu');
    }
}
