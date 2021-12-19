<?php

namespace App\Http\Livewire\Framework;

use App\Models\Gallery;
use App\Models\Module;
use App\Models\ModuleParameter;
use App\Models\Page;
use App\Models\PageModule;
use App\Models\PageNavigation;
use App\Models\PageType;
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
     * the value that stores all the module models.
     * @var
     */
    public $modules;

    /**
     * the value populated when adding a page.
     * @var
     */
    public $page_name;

    /**
     * the value that stores the current page model.
     * @var
     */
    public $page;

    /**
     * the value that stores all the pages models.
     * @var
     */
    public $pages;

    /**
     * the value that stores the current page id.
     * @var
     */
    public $page_id;

    /**
     * the value populated when adding a page to the
     * menu.
     * @var
     */
    public $menu_id;

    /**
     * the variable that stores all pages that can be
     * added to the menu.
     * @var
     */
    public $menu_options;

    /**
     * the value that is populated when selecting a module
     * to add to a page.
     * @var
     */
    public $module_id;

    /**
     * the value that stores all the gallery models.
     * @var
     */
    public $galleries;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        // populate all the variables
        $this->auth = Auth::check();
        $this->modules = Module::where('component', '!=', 'photo.photo-grid')->get()->sortBy('name');
        $this->pages = Page::all()->sortBy('name');
        $this->galleries = Gallery::all()->sortBy('name');

        $in_menu = PageNavigation::all()->pluck('page_id');
        $this->menu_options = Page::whereNotIn('id', $in_menu)->get();

        $this->module_id = Module::first()->id;
        $this->module_id = $this->pages->first()->id;
        if (!$this->menu_options->isEmpty())
        {
            $this->menu_id = $this->menu_options->first()->id;
        }

    }

    /**
     * a function that will refresh the page.
     * @return void
     */
    public function refresh()
    {
        $this->redirect(URL::previous());
    }

    /**
     * the function that when called will add
     * a new page using the $page variable.
     * @return void
     * @throws AuthorizationException
     */
    public function add_page()
    {
        // verify authorization
        $this->authorize('add page');

        // get the standard page type
        $standard = PageType::where('name', '=', 'standard')->first();

        // add the page
        $page = Page::create([
            'type_id' => $standard->id,
            'title' => $this->page_name,
            'slug' => '/'.Str::slug($this->page_name),
            'name' => Str::slug($this->page_name),
            'controller' => 'App\Http\Controllers\PageController',
            'method' => 'index',
            'publish_date' => Carbon::now()
        ]);

        // refresh the current page.
        $this->refresh();
    }

    /**
     * the function that when called will
     * add a module to the current page.
     * @return void
     * @throws AuthorizationException
     */
    public function add_module()
    {
        // verify authorization
        $this->authorize('add module');

        // get the module using the id
        $module = Module::where('id', '=', $this->module_id)->first();

        // determine the new order number
        $order = PageModule::where('page_id', '=', $this->page->id)->orderBy('order', 'desc')->first();
        $new_order = (($order != null) ? $order->order : 0) + 10;

        // add the module to a page.
        $page_module = new PageModule();
        $page_module->module_id = $module->id;
        $page_module->page_id = $this->page->id;
        $page_module->order = $new_order;
        // handle dynamic modules
        if ($module->dynamic) {
            // generate a hash and store it
            $hash = md5(time());
            $page_module->hash = $hash;

            // loop through all the parameters and create rows for them
            foreach ($module->parameters as $parameter => $rule)
            {
                $param = new ModuleParameter();
                $param->module_id = $module->id;
                $param->parameter = $parameter;
                $param->hash = $hash;
                $param->value = (is_array($module->examples[$parameter])) ? json_encode($module->examples[$parameter]) : $module->examples[$parameter];
                $param->save();
            }
        }
        $page_module->save();

        // refresh the page.
        $this->refresh();
    }

    /**
     * the function that when called will add a page to the
     * menu using $menu_id
     * @return void
     * @throws AuthorizationException
     */
    public function add_menu()
    {
        // verify authorization
        $this->authorize('edit menu');

        // add the page to the menu
        PageNavigation::create([
            'page_id' => $this->menu_id,
            'enabled' => true
        ]);

        // refresh the page
        $this->refresh();
    }

    /**
     * the function that when called will delete a page.
     * @return void
     * @throws AuthorizationException
     */
    public function delete_page()
    {
        // verify authorization
        $this->authorize('delete page');

        // first delete any menu references
        PageNavigation::where('page_id', '=', $this->page_id)->delete();

        // delete all the modules from the page.
        PageModule::where('page_id', '=', $this->page_id)->delete();

        // delete the page.
        Page::where('id', '=', $this->page_id)->delete();

        // fresh the page.
        $this->refresh();
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
