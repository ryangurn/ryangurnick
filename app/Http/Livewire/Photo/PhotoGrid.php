<?php

namespace App\Http\Livewire\Photo;

use App\Models\Gallery;
use App\Models\GalleryReaction;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * PhotoGrid is a livewire component that provides
 * the ability to create a photo gallery with a
 * grid layout.
 */
class PhotoGrid extends Component
{
    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     * @var
     */
    public $page_module;

    /**
     * the value that stores the gallery identifier
     * @var
     */
    public $gallery_id;

    /**
     * the value that stores the gallery model
     * @var
     */
    public $gallery;

    /**
     * the value that stores all of the photo
     * models in an array
     * @var
     */
    public $photos;

    /**
     * the value that stores user reactions to
     * the specific gallery.
     *
     * this is later filtered down to be for
     * just one specific image, in the view photo
     * component.
     * @var
     */
    public $user_reactions;

    /**
     * the boolean that denotes if a gallery supports
     * reactions
     * @var
     */
    public $allow_reactions;

    /**
     * the value that stores the last time the module was
     * updated.
     * @var
     */
    public $updated_at;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        // grab the module
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            // populate the local variables with example values
            $this->gallery = Gallery::where('id', '=', $module->examples['gallery_id'])->first();
            $this->photos = $this->gallery->gallery_images;
            $this->gallery_id = $this->gallery->id;
        }
        else
        {
            // populate the local variables with module parameters
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

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.photo.photo-grid');
    }
}
