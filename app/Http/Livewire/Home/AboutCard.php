<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Module;

class AboutCard extends Component
{
    public $page_module;

    public $name;

    public $image;

    public $body;

    public $updated_at;

    public function mount()
    {
        $module = Module::where('component', '=', 'home.about-card')->first();

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->name = $module->examples['name'];
            $this->body = $module->examples['body'];
            $this->image = $module->examples['image'];
        }
        else
        {
            $this->name = $module->module_parameters->where('parameter', '=', 'name')->first()->value;
            $this->body = $module->module_parameters->where('parameter', '=', 'body')->first()->value;
            $this->image = $module->module_parameters->where('parameter', '=', 'image')->first()->value;
        }

        // updated at
        $this->updated_at = $module->updated_at;

    }

    public function render()
    {
        return view('livewire.home.about-card');
    }
}
