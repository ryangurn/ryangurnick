<?php

namespace App\Http\Livewire\Photo\Edit;

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
 * EditGallery is a livewire modal component that provides
 * the ability to modify gallery card parameters.
 */
class EditGallery extends ModalComponent
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
     * the variable that stores modifications to the
     * body parameter.
     *
     * @var
     */
    public $body;

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
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
    }

    /**
     * validation rules that will be checked when the
     * edit gallery modal is saved.
     *
     * @return string[]
     */
    public function rules()
    {
        return $this->module->parameters;
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

        // get the parameter for the body
        $body = $this->module->module_parameters->where('parameter', '=', 'body')->first();

        // update the body parameter
        $body->value = json_encode($this->body);
        $body->save();

        // set the new updated_at timestamp for the module.
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
        return view('livewire.photo.edit.edit-gallery');
    }
}
