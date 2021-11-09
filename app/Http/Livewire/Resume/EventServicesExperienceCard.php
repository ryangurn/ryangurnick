<?php

namespace App\Http\Livewire\Resume;

use Livewire\Component;
use App\Models\Module;

class EventServicesExperienceCard extends Component
{
    public $roles;

    public function mount()
    {
        $module = Module::where('component', '=', 'resume.event-services-experience-card')->first();

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
