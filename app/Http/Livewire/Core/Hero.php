<?php

namespace App\Http\Livewire\Core;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * Hero is a livewire component that provides
 * a hero section that can be added to any page.
 * Its aim is to be a more advanced header with
 * images and links!
 */
class Hero extends Component
{
    /**
     * the page module model that is passed throughout
     * the application to identify modals and page
     * information
     * @var
     */
    public $page_module;

    /**
     * the value to display on the header of the module.
     * @var
     */
    public $header;

    /**
     * the value to display on the body of the module.
     * @var
     */
    public $body;

    /**
     * the value to store the links that go on the module.
     * @var
     */
    public $links;

    /**
     * the value that links to the image that should be displayed
     * on the hero section.
     * @var
     */
    public $image;

    /**
     * the value to pass through to the card footer
     * as the last time it was modified.
     * @var
     */
    public $updated_at;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        // grab the module
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            // populate the variables with the modules examples
            $this->header = $module->examples['header'];
            $this->body = $module->examples['body'];
            $this->image = $module->examples['image'];
            $this->links = collect(json_decode($module->examples['links'], true));
        }
        else
        {
            // populate the variables with dynamic parameters (using hash)
            $this->header = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'header')->first()->value;
            $this->body = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'body')->first()->value;
            $this->image = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'image')->first()->value;
            $this->links = collect(json_decode($module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'links')->first()->value, true));
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.core.hero');
    }
}
