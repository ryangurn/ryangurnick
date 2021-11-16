<?php

namespace App\Http\Livewire\Resume;

use Livewire\Component;
use App\Models\Module;

class ComputerSkillsCard extends Component
{
    public $page_module;

    public $skills;

    public function mount()
    {
        $module = Module::where('component', '=', 'resume.computer-skills-card')->first();

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
        return view('livewire.resume.computer-skills-card');
    }
}
