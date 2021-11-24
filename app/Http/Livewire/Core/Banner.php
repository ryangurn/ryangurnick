<?php

namespace App\Http\Livewire\Core;

use App\Models\Gallery;
use App\Models\Module;
use App\Models\ModuleParameter;
use App\Models\Page;
use App\Models\PageModule;
use App\Models\PageNavigation;
use App\Models\PageType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Component;

class Banner extends Component
{
    public $auth_required = true;

    public $auth = false;

    public $modules;

    public $page_name;

    public $page;

    public $pages;

    public $page_id;

    public $menu_id;

    public $menu_options;

    public $module_id;

    public $galleries;

    public function mount()
    {
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

    public function refresh()
    {
        $this->redirect(URL::previous());
    }

    public function add_page()
    {
        $standard = PageType::where('name', '=', 'standard')->first();

        $page = Page::create([
            'type_id' => $standard->id,
            'title' => $this->page_name,
            'slug' => '/'.Str::slug($this->page_name),
            'name' => Str::slug($this->page_name),
            'controller' => 'App\Http\Controllers\PageController',
            'method' => 'index',
            'publish_date' => Carbon::now()
        ]);

        $this->refresh();
    }

    public function add_module()
    {
        $module = Module::where('id', '=', $this->module_id)->first();

        $order = PageModule::where('page_id', '=', $this->page->id)->orderBy('order', 'desc')->first();
        $new_order = (($order != null) ? $order->order : 0) + 10;

        $page_module = new PageModule();
        $page_module->module_id = $module->id;
        $page_module->page_id = $this->page->id;
        $page_module->order = $new_order;
        if ($module->dynamic) {
            $hash = md5(time());
            $page_module->hash = $hash;

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

        $this->refresh();
    }

    public function add_menu()
    {
        PageNavigation::create([
            'page_id' => $this->menu_id,
            'enabled' => true
        ]);

        $this->refresh();
    }

    public function add_gallery()
    {

    }

    public function delete_page()
    {
        PageNavigation::where('page_id', '=', $this->page_id)->delete();

        PageModule::where('page_id', '=', $this->page_id)->delete();

        Page::where('id', '=', $this->page_id)->first()->delete();

        $this->refresh();
    }

    public function render()
    {
        return view('livewire.core.banner');
    }
}
