<?php

namespace App\Http\Livewire\Photo\Edit;

use App\Models\GalleryImage;
use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class EditGrid extends ModalComponent
{
    use WithFileUploads;

    public $page_module;

    public $photo;

    public $photo_model;

    public $photo_id;

    public $index;

    public $image;

    public $module;

    public function mount()
    {
        $this->photo_model = GalleryImage::where('id', '=', $this->photo_id)->first();
        $this->photo = [
            'date' => $this->photo_model->date,
            'description' => $this->photo_model->caption,
            'location' => $this->photo_model->location
        ];

        // set date formatting
        $this->photo['date'] = Carbon::create($this->photo_model->date)->toDateString();

        // grab module
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
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

        if ($this->image != null)
        {
            // get original filename and extract extension
            $filename = explode(".", $this->image->getFilename());
            $ext = $filename[count($filename)-1];

            // save the file
            $output = $this->image->storePubliclyAs('img', md5(time()).'.'.$ext, 'public');

            $this->photo_model->image->file = $output;
            $this->photo_model->image->hash = md5(time());
            $this->photo_model->image->save();
        }

        $this->photo_model->caption = $this->photo['description'];
        $this->photo_model->location = $this->photo['location'];
        $this->photo_model->date = new Carbon($this->photo['date']);
        $this->photo_model->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.photo.edit.edit-grid');
    }
}
