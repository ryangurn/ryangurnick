<?php

namespace App\Http\Livewire\Resume;

use Livewire\Component;
use App\Models\Module;

class CommitteeWorkCard extends Component
{
    public $page_module;

    public $institutions;

    public function mount()
    {
        $module = Module::where('component', '=', 'resume.committee-work-card')->first();

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->institutions = collect($module->examples['institutions']);
        }
        else
        {
            $this->institutions = collect(json_decode($module->module_parameters->where('parameter', '=', 'institutions')->first()->value, true));
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }


    public function render()
    {
        return view('livewire.resume.committee-work-card');
    }
}
