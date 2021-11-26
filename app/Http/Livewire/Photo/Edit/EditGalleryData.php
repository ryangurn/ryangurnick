<?php

namespace App\Http\Livewire\Photo\Edit;

use App\Models\Gallery;
use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditGalleryData extends ModalComponent
{
    public $page_module;

    public $module;

    public $gallery_id;

    public $gallery;

    public $name;

    public $description;

    public function mount()
    {
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
        $this->gallery = Gallery::where('id', '=', $this->gallery_id)->first();
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string|min:5'
        ];
    }

    public function save()
    {
        $this->validate();

        $this->gallery->name = $this->name;
        $this->gallery->description = $this->description;
        $this->gallery->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.photo.edit.edit-gallery-data');
    }
}
