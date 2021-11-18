<?php

namespace App\Http\Livewire\Resume;

use Livewire\Component;

class EventServicesExperienceCard extends Component
{
    public $page_module;

    public $roles;

    public function mount()
    {
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->roles = collect($module->examples['roles']);
        }
        else
        {
            $this->roles = collect(json_decode($module->module_parameters->where('parameter', '=', 'roles')->first()->value, true));
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.resume.event-services-experience-card');
    }
}
