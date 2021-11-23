<?php

namespace App\Http\Livewire\Core;

use App\Models\Gallery;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class AddGallery extends ModalComponent
{
    public $page_id;

    public $galleries;

    public $gallery_id;

    public $name;

    public $description;

    public $new = false;

    public function rules()
    {
        if (!$this->new) {
            return [
                'name' => 'required|string',
                'description' => 'required|string|min:3'
            ];
        }
        else
        {
            return [
                'gallery_id' => 'required|numeric|exists:galleries,id'
            ];
        }
    }

    public function mount()
    {
        $this->galleries = Gallery::all()->sortBy('name');
    }

    public function save()
    {
        $this->validate();

        $gallery = new Gallery();
        $gallery->name = $this->name;
        $gallery->description = $this->description;
        $gallery->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.core.add-gallery');
    }
}
