<?php

namespace App\Http\Livewire\Photo\Remove;


use App\Models\GalleryImage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;
use function view;

/**
 * RemoveGridPhoto is a livewire modal component that
 * provides the ability to remove a photo.
 */
class RemoveGridPhoto extends ModalComponent
{
    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     * @var
     */
    public $page_module;

    /**
     * the value that store the photo identifier to
     * delete.
     * @var
     */
    public $photo_id;

    /**
     * the function that when called will delete
     * the photo from the gallery
     * @return void
     */
    public function delete()
    {
        // delete the image
        GalleryImage::where('id', '=', $this->photo_id)->delete();

        // todo: remove the image.

        // redirect
        $this->redirect(URL::previous());
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.photo.remove.remove-grid-photo');
    }
}
