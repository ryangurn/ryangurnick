<?php

namespace App\Http\Livewire\Photo\Edit;

use App\Models\GalleryImage;
use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

/**
 * EditGrid is a livewire modal component that provides
 * the ability to edit an image on the photo grid.
 */
class EditGrid extends ModalComponent
{
    /**
     * Allowing for file uploads within the modal
     */
    use WithFileUploads;

    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     * @var
     */
    public $page_module;

    /**
     * the array that stores parameters for the specific
     * image on the grid that is being updated.
     * @var
     */
    public $photo;

    /**
     * the value that stores the photo model.
     * @var
     */
    public $photo_model;

    /**
     * the value that stores the photo identifier.
     * @var
     */
    public $photo_id;

    /**
     * the value that stores the newly uploaded image.
     * @var
     */
    public $image;

    /**
     * the value that stores the module model.
     * @var
     */
    public $module;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        // grab the photo model and initialize the photo array
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

    /**
     * validation rules that will be checked when the
     * edit grid modal is saved.
     * @return string[]
     */
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

    /**
     * the function that when called will save the new
     * values in the about component.
     * @return void
     */
    public function save()
    {
        // validate the request
        $this->validate();

        // ensure there is an uploaded image.
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

        // update the parameters of the photo.
        $this->photo_model->caption = $this->photo['description'];
        $this->photo_model->location = $this->photo['location'];
        $this->photo_model->date = new Carbon($this->photo['date']);
        $this->photo_model->save();

        // set the new updated_at timestamp on the module.
        $this->module->updated_at = Carbon::now();
        $this->module->save();

        // close modal and refresh
        $this->closeModal();
        $this->redirect(URL::previous());
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.photo.edit.edit-grid');
    }
}
