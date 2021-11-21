<?php

namespace App\Http\Livewire\Core;

use Livewire\Component;

class Header extends Component
{
    public $page_module;

    public $header;

    public $color;

    public $description;

    public function mount()
    {
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->header = $module->examples['header'];
            $this->color = $module->examples['color'];
            $this->description = $module->examples['description'];
        }
        else
        {
            $this->header = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'header')->first()->value;
            $this->color = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'color')->first()->value;
            $this->description = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'description')->first()->value;
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.core.header');
    }
}
