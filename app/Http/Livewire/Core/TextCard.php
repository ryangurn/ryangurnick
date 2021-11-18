<?php

namespace App\Http\Livewire\Core;

use Livewire\Component;

class TextCard extends Component
{
    public $page_module;

    public $header;

    public $body;

    public $updated_at;

    public function mount()
    {
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->body = $module->examples['body'];
            $this->header = $module->examples['header'];
        }
        else
        {
            $this->body = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'body')->first()->value;
            $this->header = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'header')->first()->value;
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.core.text-card');
    }
}
