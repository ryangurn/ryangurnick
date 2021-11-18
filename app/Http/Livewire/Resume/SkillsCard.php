<?php

namespace App\Http\Livewire\Resume;

use Livewire\Component;

class SkillsCard extends Component
{
    public $page_module;

    public $skills;

    public function mount()
    {
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->skills = collect($module->examples['skills']);
        }
        else
        {
            $this->skills = collect(json_decode($module->module_parameters->where('parameter', '=', 'skills')->first()->value, true));
        }

        // sort skills
        $this->skills = $this->skills->sortBy([
            ['skill', 'asc']
        ]);

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.resume.skills-card');
    }
}
