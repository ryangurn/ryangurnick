<?php

namespace App\Http\Livewire\Resume;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * ComputerScienceExperienceCard is a livewire modal that provides
 * the ability to display computer science work experience data.
 */
class ComputerScienceExperienceCard extends Component
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
     * the array that stores the roles data.
     *
     * @var
     */
    public $roles;

    /**
     * the value that stores the last time the module was
     * updated.
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
            // set the roles based on module examples
            $this->roles = collect($module->examples['roles']);
        } else {
            // set the roles based on module parameters
            $this->roles = collect(json_decode($module->module_parameters->where('parameter', '=', 'roles')->first()->value, true));
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
        return view('livewire.resume.computer-science-experience-card');
    }
}
