<?php

namespace App\Http\Livewire\Photo;

use App\Models\Gallery;
use App\Models\GalleryReaction;
use App\Models\Setting;
use Livewire\Component;

class PhotoGrid extends Component
{
    public $page_module;

    public $gallery_id;

    public $gallery;

    public $photos;

    public $user_reactions;

    public $allow_reactions;

    public function mount()
    {
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->gallery = Gallery::where('id', '=', $module->examples['gallery_id'])->first();
            $this->photos = $this->gallery->gallery_images;
            $this->gallery_id = $this->gallery->id;
        }
        else
        {
            $this->gallery = Gallery::where('id', '=', $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'gallery_id')->first()->value)->first();
            $this->photos = $this->gallery->gallery_images;
            $this->gallery_id = $this->gallery->id;
        }

        // updated at
        $this->updated_at = $module->updated_at;

        $this->user_reactions = GalleryReaction::where('active', true)
            ->orderBy('updated_at', 'desc')
            ->get();
        $this->allow_reactions = Setting::where('key', 'gallery.allow_reactions')->first()->value;
    }

    public function render()
    {
        return view('livewire.photo.photo-grid');
    }
}
