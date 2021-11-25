<?php

namespace App\Http\Livewire\Photo;

use App\Models\Gallery;
use Livewire\Component;

class PhotoGrid extends Component
{
    public $page_module;

    public $photos;

    public function mount()
    {
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $gallery = Gallery::where('id', '=', $module->examples['gallery_id'])->first();
            $this->photos = $gallery->gallery_images;
        }
        else
        {
            $gallery = Gallery::where('id', '=', $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'gallery_id')->first()->value)->first();
            $this->photos = $gallery->gallery_images;
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function render()
    {
        return view('livewire.photo.photo-grid');
    }
}
