<?php

namespace App\Http\Livewire\Core\Edit;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

/**
 * EditHero is a livewire modal component that
 * provides a method for modifying the parameters
 * for the hero component.
 */
class EditHero extends ModalComponent
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
     * the value that stores the changes to the header
     * parameter.
     * @var
     */
    public $header;

    /**
     * the value that stores the changes to the body
     * parameter.
     * @var
     */
    public $body;

    /**
     * the array that stores the changes to the various
     * links that can be added.
     * @var
     */
    public $links;

    /**
     * the value that stores the changes to the image,
     * this is generally a special file upload type.
     * @var
     */
    public $image;

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
     * edit hero modal is saved.
     * @return string[]
     */
    public function rules()
    {
        $rules = $this->module->parameters;
        $rules['links.*.value'] = 'required|string';
        $rules['links.*.link'] = 'required|url';
        return $rules;
    }

    /**
     * messages to display when validation errors
     * occur.
     * @return string[]
     */
    public function messages()
    {
        $arr = [
            'header.required' => 'header is required',
            'header.string' => 'header must be a string',
            'body.string' => 'body must be a string',
            'image.image' => 'image uploaded must be a jpg, jpeg, png, bmp, gif, svg, or webp file',
        ];

        for ($i = 0; $i < count($this->links); $i++)
        {
            $arr['links.'.$i.'.value.required'] = 'Link Value #'.($i+1).' cannot be blank.';
            $arr['links.'.$i.'.value.string'] = 'Link Value #'.($i+1).' must be a string.';
            $arr['links.'.$i.'.link.required'] = 'Link Location #'.($i+1).' cannot be blank.';
            $arr['links.'.$i.'.link.url'] = 'Link Location #'.($i+1).' must be a url.';
        }

        return $arr;
    }

    /**
     * the function that when called will update the validation messages
     * and ensure that there is at least one link
     * @return void
     */
    public function check()
    {
        $this->messages();
        if (count($this->links) == 0)
        {
            $this->add();
        }
    }

    /**
     * the function that when called will add a new sub array
     * into the links array.
     * @return void
     */
    public function add()
    {
        $this->messages();
        $this->links[] = ['value' => '', 'link' => ''];
    }

    /**
     * Given an index, this function will remove a sub array
     * from the links array. It will ensure that there is at
     * least one sub array in the links array.
     * @param $i
     * @return void
     */
    public function remove($i)
    {
        unset($this->links[$i]);
        $this->check();
    }

    /**
     * method that is called when the user is ready
     * to have the value changed.
     * @return void
     */
    public function save()
    {
        // validate the request
        $this->validate();

        // grab all the values for the local variabled
        $header = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'header')->first();
        $body = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'body')->first();
        $links = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'links')->first();
        $image = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'image')->first();

        // ensure the image is not null, ie: the user has uploaded an image.
        if ($this->image != null)
        {
            // get original filename and extract extension
            $filename = explode(".", $this->image->getFilename());
            $ext = $filename[count($filename)-1];

            // save the file
            $output = $this->image->storePubliclyAs('img', md5(time()).'.'.$ext, 'public');

            // save the asset path
            $image->value = $output;
            $image->save();
        }

        // update the header value
        $header->value = $this->header;
        $header->save();

        // update the body value
        $body->value = $this->body;
        $body->save();

        // update the links array
        $links->value = json_encode($this->links);
        $links->save();

        // set the new updated_at timestamp for the module
        $this->module->updated_at = Carbon::now();
        $this->module->save();

        // close the modal and redirect
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
        $this->links = collect($this->links);
        return view('livewire.core.edit.edit-hero');
    }
}
