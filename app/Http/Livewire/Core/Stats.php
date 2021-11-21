<?php

namespace App\Http\Livewire\Core;

use Livewire\Component;

class Stats extends Component
{
    public $page_module;

    public $header;

    public $cards;

    public function mount()
    {
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->header = $module->examples['header'];
            $this->cards = collect(json_decode($module->examples['cards'], true));
        }
        else
        {
            $this->header = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'header')->first()->value;
            $this->cards = collect(json_decode($module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'cards')->first()->value, true));
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.core.stats');
    }
}
