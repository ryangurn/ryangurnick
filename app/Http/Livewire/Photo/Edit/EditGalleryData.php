<?php

namespace App\Http\Livewire\Photo\Edit;

use App\Models\Gallery;
use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

/**
 * EditGalleryData is a livewire modal component that provides
 * the ability to modify photo grid card parameters.
 */
class EditGalleryData extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     *
     * @var
     */
    public $page_module;

    /**
     * the value that stores the module model.
     *
     * @var
     */
    public $module;

    /**
     * the value that stores the gallery identifier
     *
     * @var
     */
    public $gallery_id;

    /**
     * the value that stores the gallery model.
     *
     * @var
     */
    public $gallery;

    /**
     * the value that stores the modified name.
     *
     * @var
     */
    public $name;

    /**
     * the value that stores the modified description.
     *
     * @var
     */
    public $description;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
        $this->gallery = Gallery::where('id', '=', $this->gallery_id)->first();
    }

    /**
     * validation rules that will be checked when the
     * edit gallery data modal is saved.
     *
     * @return string[]
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string|min:5',
        ];
    }

    /**
     * the function that when called will save the new
     * values in the gallery component.
     *
     * @return void
     *
     * @throws AuthorizationException
     */
    public function save()
    {
        // verify authorization
        $this->authorize($this->module->permissions['edit']);

        // validate the request
        $this->validate();

        // update the name and description
        $this->gallery->name = $this->name;
        $this->gallery->description = $this->description;
        $this->gallery->save();

        // set the new updated_at timestamp on the model
        $this->module->updated_at = Carbon::now();
        $this->module->save();

        // close the modal and refresh
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
        return view('livewire.photo.edit.edit-gallery-data');
    }
}
