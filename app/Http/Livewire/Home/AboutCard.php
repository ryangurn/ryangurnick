<?php

namespace App\Http\Livewire\Home;

use App\Models\Image;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * AboutCard is a livewire component that
 * shows information about the person or
 * institution. This includes a name, image,
 * body, & link.
 */
class AboutCard extends Component
{
    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     *
     * @var
     */
    public $page_module;

    /**
     * the variable that stores the name
     *
     * @var
     */
    public $name;

    /**
     * the variable that stores the image path
     *
     * @var
     */
    public $image;

    /**
     * the variable that stores the body text
     *
     * @var
     */
    public $body;

    /**
     * the variable that stores the url link
     *
     * @var
     */
    public $link;

    /**
     * the variable that stores the link text.
     *
     * @var
     */
    public $linkText;

    /**
     * the variable that stores the last time
     * the module was updated.
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
        // grab the module
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0) {
            // store off to the local variables using the module examples.
            $this->name = $module->examples['name'];
            $this->body = $module->examples['body'];
            $this->image = $module->examples['image'];
            $this->link = $module->examples['link'];
            $this->linkText = $module->examples['link_text'];
        } else {
            // store off to the local variables using module parameters.
            $this->name = $module->module_parameters->where('parameter', '=', 'name')->first()->value;
            $this->body = $module->module_parameters->where('parameter', '=', 'body')->first()->value;
            $this->image = Image::where('id', $module->module_parameters->where('parameter', '=', 'image')->first()->value)->first();
            $this->link = ($module->module_parameters->where('parameter', '=', 'link')->first() != null) ? $module->module_parameters->where('parameter', '=', 'link')->first()->value : null;
            $this->linkText = ($module->module_parameters->where('parameter', '=', 'link_text')->first() != null) ? $module->module_parameters->where('parameter', '=', 'link_text')->first()->value : null;
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
        return view('livewire.home.about-card');
    }
}
