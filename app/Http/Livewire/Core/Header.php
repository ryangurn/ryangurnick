<?php

namespace App\Http\Livewire\Core;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * Header is a livewire component that provides
 * a header module that can be added to any page.
 */
class Header extends Component
{
    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     * @var
     */
    public $page_module;

    /**
     * the value to display on the header of the module.
     * @var
     */
    public $header;

    /**
     * the value that controls if the header is light or dark.
     * @var
     */
    public $color;

    /**
     * the value to display the description of the module.
     * @var
     */
    public $description;

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
            // grab the values using the modules examples
            $this->header = $module->examples['header'];
            $this->color = $module->examples['color'];
            $this->description = $module->examples['description'];
        }
        else
        {
            // grab the values using the module parameters using the dynamic hash
            $this->header = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'header')->first()->value;
            $this->color = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'color')->first()->value;
            $this->description = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'description')->first()->value;
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
        return view('livewire.core.header');
    }
}
