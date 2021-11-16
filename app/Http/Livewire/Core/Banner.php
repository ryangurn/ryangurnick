<?php

namespace App\Http\Livewire\Core;

use App\Models\Module;
use App\Models\Page;
use App\Models\PageModule;
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

    public $module_id;

    public function mount()
    {
        $this->auth = Auth::check();
        $this->modules = Module::all();

        $this->module_id = Module::first()->id;
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
            'slug' => Str::slug($this->page_name),
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
        $new_order = $order->order + 10;

        PageModule::create([
            'module_id' => $module->id,
            'page_id' => $this->page->id,
            'order' => $new_order
        ]);

        $this->refresh();
    }

    public function render()
    {
        return view('livewire.core.banner');
    }
}
