<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Module;

class ProjectCard extends Component
{
    public $projects;

    public function mount()
    {
        $module = Module::where('component', '=', 'home.project-card')->first();

        if ($module->module_parameters->count() == 0)
        {
            $this->projects = collect($module->examples['projects']);
        }
        else
        {
            $this->projects = collect(json_decode($module->module_parameters->where('parameter', '=', 'projects')->first()->value, true));
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.home.project-card');
    }
}
