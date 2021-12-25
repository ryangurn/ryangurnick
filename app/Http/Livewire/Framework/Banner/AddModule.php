<?php

namespace App\Http\Livewire\Framework\Banner;

use App\Models\Module;
use App\Models\ModuleParameter;
use App\Models\Page;
use App\Models\PageModule;
use App\Models\PageType;
use App\Models\PageTypeModule;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class AddModule extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    public $modules;

    public $module_id;

    public $allowed_modules;

    public $page;

    public $page_id;

    public function mount()
    {
        $this->page = Page::where('id', $this->page_id)->first();

        // grab the modules for the page type
        $type_modules = PageTypeModule::where('type_id', $this->page->type_id)->get();
        foreach($type_modules as $module)
        {
            $this->allowed_modules[] = $module->module->component;
        }

        $this->modules = Module::whereIn('component', $this->allowed_modules)->where('component', '!=', 'photo.photo-grid')->get()->sortBy('name');
    }

    /**
     * the function that when called will
     * add a module to the current page.
     * @return void
     * @throws AuthorizationException
     */
    public function save()
    {
        // verify authorization
        $this->authorize('add module');

        // get the module using the id
        $module = Module::where('id', '=', $this->module_id)->first();

        // determine the new order number
        $order = PageModule::where('page_id', '=', $this->page->id)->orderBy('order', 'desc')->first();
        $new_order = (($order != null) ? $order->order : 0) + 10;

        // setup a dynamic module hash
        $hash = md5(time());

        // add post page if a post is added and there is not already a post page.
        $post_check = Page::where('name', 'post')->count();
        if ($module->component == "blog.post" && $post_check == 0)
        {
            $post_type = PageType::where('name', '=', 'post')->first();
            $post = Page::firstOrCreate([
                'type_id' => $post_type->id,
                'title' => 'post',
                'slug' => '/post/{page_module:hash}',
                'name' => 'post',
                'controller' => 'App\Http\Controllers\PageController',
                'method' => 'index',
                'publish_date' => Carbon::now()
            ]);

            $post_module = new PageModule();
            $post_module->module_id = $module->id;
            $post_module->page_id = $post->id;
            $post_module->order = $new_order;
            $post_module->hash = $hash;
            $post_module->enabled = true;
            $post_module->save();
        }

        // add the module to a page.
        $page_module = new PageModule();
        $page_module->module_id = $module->id;
        $page_module->page_id = $this->page->id;
        $page_module->order = $new_order;
        // handle dynamic modules
        if ($module->dynamic) {
            // generate a hash and store it
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
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.framework.banner.add-module');
    }
}
