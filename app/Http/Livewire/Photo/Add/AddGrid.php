<?php

namespace App\Http\Livewire\Photo\Add;

use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Image;
use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use function view;

/**
 * AddGrid is a livewire modal component that provides
 * the ability to add an image to a specific gallery.
 */
class AddGrid extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * Allowing for file uploads within the modal
     */
    use WithFileUploads;

    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     *
     * @var
     */
    public $page_module;

    /**
     * this variable stores the gallery identifier to
     * add the image to.
     *
     * @var
     */
    public $gallery_id;

    /**
     * this variable stores the gallery model that
     * the image is associated to.
     *
     * @var
     */
    public $gallery;

    /**
     * this variable stores the parameters of the
     * uploaded photo.
     *
     * @var
     */
    public $photo;

    /**
     * this variable stores the uploaded image.
     *
     * @var
     */
    public $image;

    /**
     * the value that stores the module model.
     *
     * @var
     */
    public $module;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        // grab module
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
        $this->gallery = Gallery::where('id', '=', $this->gallery_id)->first();
    }

    /**
     * validation rules that will be checked when the
     * add grid modal is saved.
     *
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
     * values in the photo grid component.
     *
     * @return void
     *
     * @throws AuthorizationException
     */
    public function save()
    {
        // verify authorization
        $this->authorize('add photo');

        // validate the request
        $this->validate();

        // get original filename and extract extension
        // todo: add support for storing images in the database
        $filename = explode('.', $this->image->getFilename());
        $ext = $filename[count($filename) - 1];

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
        $gallery_image->caption = (array_key_exists('description', $this->photo)) ? $this->photo['description'] : '';
        $gallery_image->date = new Carbon($this->photo['date']);
        $gallery_image->location = $this->photo['location'];
        $gallery_image->visible = true;
        $gallery_image->save();

        // set the new updated_at timestamp on the module.
        $this->module->updated_at = Carbon::now();
        $this->module->save();

        // close modal and redirect
        $this->closeModal();
        $this->redirect(URL::previous());
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.photo.add.add-grid');
    }
}
