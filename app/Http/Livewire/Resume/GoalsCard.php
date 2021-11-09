<?php

namespace App\Http\Livewire\Resume;

use Livewire\Component;
use App\Models\Module;

class GoalsCard extends Component
{
    public $body;

    public function mount()
    {
        $module = Module::where('component', '=', 'resume.goals-card')->first();

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->body = $module->examples['body'];
        }
        else
        {
            $this->body = json_decode($module->module_parameters->where('parameter', '=', 'body')->first()->value);
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.resume.goals-card');
    }
}
