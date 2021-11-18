<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class ProjectCard extends Component
{
    public $page_module;

    public $projects;

    public function mount()
    {
        $module = $this->page_module->module;

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
