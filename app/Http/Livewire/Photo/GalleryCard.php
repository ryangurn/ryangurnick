<?php

namespace App\Http\Livewire\Photo;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * GalleryCard is a livewire component that provides
 * the ability to setup a gallery description.
 *
 * This module is not dynamic.
 * TODO: update this component to be dynamic
 */
class GalleryCard extends Component
{
    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     * @var
     */
    public $page_module;

    /**
     * the value that stores the body of the gallery card.
     * @var
     */
    public $body;

    /**
     * the value that stores the last time the module was
     * updated.
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
            // populate the body with module examples
            $this->body = $module->examples['body'];
        }
        else
        {
            // populate the body using module parameters
            $this->body = json_decode($module->module_parameters->where('parameter', '=', 'body')->first()->value);
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
        return view('livewire.photo.gallery-card');
    }
}
