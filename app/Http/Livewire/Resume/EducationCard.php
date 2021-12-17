<?php

namespace App\Http\Livewire\Resume;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * EducationCard is a livewire modal that provides
 * the ability to display educational data.
 */
class EducationCard extends Component
{
    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     * @var
     */
    public $page_module;

    /**
     * the array that stores the institution's data.
     * @var
     */
    public $institutions;

    /**
     * the value that stores the last time the module was
     * updated.
     * @var
     */
    public $updated_at;

    public function mount()
    {
        // grab the module
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            // set the institutions based on module examples
            $this->institutions = collect($module->examples['institutions']);
        }
        else
        {
            // set the institutions based on module parameters
            $this->institutions = collect(json_decode($module->module_parameters->where('parameter', '=', 'institutions')->first()->value, true));
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
        return view('livewire.resume.education-card');
    }
}
