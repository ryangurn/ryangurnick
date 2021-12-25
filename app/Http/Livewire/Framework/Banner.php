<?php

namespace App\Http\Livewire\Framework;

use App\Models\Gallery;
use App\Models\Module;
use App\Models\ModuleParameter;
use App\Models\Page;
use App\Models\PageModule;
use App\Models\PageNavigation;
use App\Models\PageType;
use App\Models\PageTypeModule;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Component;
use function view;

/**
 * Banner is a livewire component that provides
 * administrative functionality to an authorized
 * user. Its aim is to prevent the need for a
 * dashboard in which content can be modified.
 */
class Banner extends Component
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * the toggle to determine if the banner shows
     * when a user is logged in or not.
     * @var bool
     */
    public $auth_required = true;

    /**
     * the toggle that is populated with the current
     * authentication status. (ie: is the user logged
     * in or not.)
     * @var bool
     */
    public $auth = false;

    /**
     * the variable that stores all pages that can be
     * added to the menu.
     * @var
     */
    public $menu_options;

    /**
     * the array that stores all the allowed
     * modules for a page type.
     * @var
     */
    public $allowed_modules = [];

    /**
     * the value that stores the current page model.
     * @var
     */
    public $page;

    public $navigations;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        // populate all the variables
        $this->auth = Auth::check();
        $in_menu = PageNavigation::all()->pluck('page_id');
        $this->menu_options = Page::whereNotIn('id', $in_menu)->where('name', '<>', 'post')->get();

        // grab the modules for the page type
        $type_modules = PageTypeModule::where('type_id', $this->page->type_id)->get();
        foreach($type_modules as $module)
        {
            $this->allowed_modules[] = $module->module->component;
        }

        $this->navigations = PageNavigation::all();
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.banner');
    }
}
