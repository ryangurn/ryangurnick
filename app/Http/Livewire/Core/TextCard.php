<?php

namespace App\Http\Livewire\Core;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * TextCard is a livewire component that provides
 * a method to put text on the website easily.
 */
class TextCard extends Component
{
    /**
     * the page module model that is passed throughout
     * the application to identify modals and page
     * information
     *
     * @var
     */
    public $page_module;

    /**
     * the value to display on the header of the module.
     *
     * @var
     */
    public $header;

    /**
     * the value to store the text for the body of the module.
     *
     * @var
     */
    public $body;

    /**
     * the value to pass through to the card footer
     * as the last time it was modified.
     *
     * @var
     */
    public $updated_at;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        // get the module
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0) {
            // set the variables using the module examples
            $this->body = $module->examples['body'];
            $this->header = $module->examples['header'];
        } else {
            // set the variables using the module parameters (using the hash)
            $this->body = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'body')->first()->value;
            $this->header = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'header')->first()->value;
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.core.text-card');
    }
}
