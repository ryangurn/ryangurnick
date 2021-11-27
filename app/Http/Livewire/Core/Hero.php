<?php

namespace App\Http\Livewire\Core;

use Livewire\Component;

class Hero extends Component
{
    public $page_module;

    public $header;

    public $body;

    public $links;

    public $image;

    public $updated_at;

    public function mount()
    {
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->header = $module->examples['header'];
            $this->body = $module->examples['body'];
            $this->image = $module->examples['image'];
            $this->links = collect(json_decode($module->examples['links'], true));
        }
        else
        {
            $this->header = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'header')->first()->value;
            $this->body = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'body')->first()->value;
            $this->image = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'image')->first()->value;
            $this->links = collect(json_decode($module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'links')->first()->value, true));
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.core.hero');
    }
}
