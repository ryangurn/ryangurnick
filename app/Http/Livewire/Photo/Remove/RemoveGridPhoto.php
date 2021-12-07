<?php

namespace App\Http\Livewire\Photo\Remove;


use App\Models\GalleryImage;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;
use function view;

class RemoveGridPhoto extends ModalComponent
{
    public $page_module;

    public $photo_id;

    public function delete()
    {
        GalleryImage::where('id', '=', $this->photo_id)->delete();

        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.photo.remove.remove-grid-photo');
    }
}