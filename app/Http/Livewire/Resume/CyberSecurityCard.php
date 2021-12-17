<?php

namespace App\Http\Livewire\Resume;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * CyberSecurityCard is a livewire modal that provides
 * the ability to display cybersecurity data.
 */
class CyberSecurityCard extends Component
{
    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     * @var
     */
    public $page_module;

    /**
     * the value that stores the body data.
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
            // set the body based on module examples
            $this->body = $module->examples['body'];
        }
        else
        {
            // set the body based on module parameters
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
        return view('livewire.resume.cyber-security-card');
    }
}
