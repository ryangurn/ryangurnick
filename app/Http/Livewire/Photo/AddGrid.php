<?php

namespace App\Http\Livewire\Photo;

use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Image;
use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddGrid extends ModalComponent
{
    use WithFileUploads;

    public $page_module;

    public $gallery_id;

    public $gallery;

    public $photo;

    public $image;

    public $module;

    public function mount()
    {
        // grab module
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
        $this->gallery = Gallery::where('id', '=', $this->gallery_id)->first();
    }

    public function rules()
    {
        return [
            'photo' => 'required|array',
            'image' => 'nullable|image|max:1024',
            'photo.description' => 'nullable|string',
            'photo.location' => 'nullable|string',
            'photo.date' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();

        // get original filename and extract extension
        $filename = explode(".", $this->image->getFilename());
        $ext = $filename[count($filename)-1];

        // save the file
        $output = $this->image->storePubliclyAs('img', md5(time()).'.'.$ext, 'public');

        // add image
        $image = new Image();
        $image->disk = 'public';
        $image->file = $output;
        $image->hash = md5(time());
        $image->save();

        // add gallery image
        $gallery_image = new GalleryImage();
        $gallery_image->gallery_id = $this->gallery->id;
        $gallery_image->image_id = $image->id;
        $gallery_image->caption = $this->photo['description'];
        $gallery_image->date = new Carbon($this->photo['date']);
        $gallery_image->location = $this->photo['location'];
        $gallery_image->visible = true;
        $gallery_image->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.photo.add-grid');
    }
}
