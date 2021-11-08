<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Module;

class QuoteCard extends Component
{
    public $quotes;

    public function mount()
    {
        $module = Module::where('component', '=', 'home.quote-card')->first();

        if ($module->module_parameters->count() == 0)
        {
            $this->quotes = collect($module->examples['quotes']);
        }
        else
        {
            $this->quotes = collect(json_decode($module->module_parameters->where('parameter', '=', 'quotes')->first()->value, true));
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.home.quote-card');
    }
}
