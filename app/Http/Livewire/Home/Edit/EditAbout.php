<?php

namespace App\Http\Livewire\Home\Edit;

use App\Models\Image;
use App\Models\ModuleParameter;
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

/**
 * EditAbout is a livewire modal component that
 * provides the ability to edit the about component
 * parameters.
 */
class EditAbout extends ModalComponent
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
     * @var
     */
    public $page_module;

    /**
     * the value that stores changes to the name
     * parameter.
     * @var
     */
    public $name;

    /**
     * the value that stores changes to the body
     * parameter.
     * @var
     */
    public $body;

    /**
     * the value that stores changes to the link
     * parameter. this is the URL that the button
     * will point to not the text on the button.
     * @var
     */
    public $link;

    /**
     * the value that stores changes to the link
     * text parameter. this is the button text.
     * @var
     */
    public $link_text;

    /**
     * the value that stores the file uploaded
     * class to allow for uploading files.
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
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
    }

    /**
     * validation rules that will be checked when the
     * edit about modal is saved.
     * @return string[]
     */
    public function rules()
    {
        return $this->module->parameters;
    }

    /**
     * the function that when called will save the new
     * values in the about component.
     * @return void
     * @throws AuthorizationException
     */
    public function save()
    {
        // verify authorization
        $this->authorize($this->module->permissions['edit']);

        // validate the request
        $this->validate();
        // grab module parameters and update
        $name = $this->module->module_parameters->where('parameter', '=', 'name')->first();
        $body = $this->module->module_parameters->where('parameter', '=', 'body')->first();
        $image = $this->module->module_parameters->where('parameter', '=', 'image')->first();
        $link = $this->module->module_parameters->where('parameter', '=', 'link')->first();
        $linkText = $this->module->module_parameters->where('parameter', '=', 'link_text')->first();

        // ensure the image is not null, (ie: an image has been uploaded)
        if ($this->image != null)
        {
            // get original filename and extract extension
            $filename = explode(".", $this->image->getFilename());
            $ext = $filename[count($filename)-1];

            // save the file
            $output = $this->image->storePubliclyAs('avatar', md5(time()).'.'.$ext, 'public');

            // add image
            $img = new Image();
            $img->disk = 'public';
            $img->file = $output;
            $img->hash = md5(time());
            $img->save();

            // save the asset path
            $image->value = $img->id;
            $image->save();
        }

        // update the name value
        $name->value = $this->name;
        $name->save();

        // update the body value
        $body->value = $this->body;
        $body->save();

        // create a new module parameter if the link is null
        if ($link == null)
        {
            $linkParam = new ModuleParameter();
            $linkParam->module_id = $this->module->id;
            $linkParam->parameter = 'link';
            $linkParam->value = $this->link;
            $linkParam->save();
        }
        else
        {
            // update the module parameter
            $link->value = $this->link;
            $link->save();
        }

        // create a new module parameter if the link_text is null
        if ($linkText == null)
        {
            $linkTextParam = new ModuleParameter();
            $linkTextParam->module_id = $this->module->id;
            $linkTextParam->parameter = 'link_text';
            $linkTextParam->value = $this->link_text;
            $linkTextParam->save();
        }
        else
        {
            // update the module parameter
            $linkText->value = $this->link_text;
            $linkText->save();
        }

        // set the new updated_at timestamp for the module
        $this->module->updated_at = Carbon::now();
        $this->module->save();

        // close the modal and refresh
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
        return view('livewire.home.edit.edit-about');
    }
}
