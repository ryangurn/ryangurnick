<?php

namespace App\Http\Livewire\Resume;

use Livewire\Component;
use App\Models\Module;

class OperatingSystemCard extends Component
{
    public $page_module;

    public $systems;

    public function mount()
    {
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->systems = collect($module->examples['systems']);
        }
        else
        {
            $this->systems = collect(json_decode($module->module_parameters->where('parameter', '=', 'systems')->first()->value, true));
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.resume.operating-system-card');
    }
}
