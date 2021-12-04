<?php

namespace App\Http\Livewire\Photo;

use App\Models\GalleryImage;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ViewPhoto extends ModalComponent
{
    public $page_module;

    public $photo_id;

    public $photo;

    public $updated_at;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function mount()
    {
        $this->photo = GalleryImage::where('id', '=', $this->photo_id)->first();
        $this->updated_at = $this->photo->updated_at;
    }

    public function render()
    {
        return view('livewire.photo.view-photo');
    }
}
