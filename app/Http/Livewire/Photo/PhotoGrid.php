<?php

namespace App\Http\Livewire\Photo;

use Livewire\Component;
use App\Models\Module;

class PhotoGrid extends Component
{
    public $page_module;

    public $photos;

    public function mount()
    {
        $module = Module::where('component', '=', 'photo.photo-grid')->first();

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->photos = collect($module->examples['photos']);
        }
        else
        {
            $this->photos = collect(json_decode($module->module_parameters->where('parameter', '=', 'photos')->first()->value, true));
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.photo.photo-grid');
    }
}
