<?php

namespace App\Http\Livewire\Core\Edit;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

/**
 * EditHeader is a livewire modal that provides
 * the ability to edit the header values. Its aim
 * is to provide a simple method for updating the
 * header and its associated values.
 */
class EditHeader extends ModalComponent
{
    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     * @var
     */
    public $page_module;

    /**
     * the location in which the page module is stored to
     * for local use within the component.
     * @var
     */
    public $module;

    /**
     * the value that stores changes to the header of the
     * module
     * @var
     */
    public $header;

    /**
     * the value that stores changes to the description
     * of the module
     * @var
     */
    public $description;

    /**
     * the value that stores changes to the color of
     * the module.
     * @var
     */
    public $color;

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
     * change order modal is saved.
     * @return string[]
     */
    public function rules()
    {
        return $this->module->parameters;
    }

    /**
     * the function that when called will save changes
     * to the Header component.
     * @return void
     */
    public function save()
    {
        // validate the request
        $this->validate();

        // get local variable values using hashes.
        $header = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'header')->first();
        $color = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'color')->first();
        $description = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'description')->first();

        // update the header value
        $header->value = $this->header;
        $header->save();

        // update the color value
        $color->value = $this->color;
        $color->save();

        // update the description value
        $description->value = $this->description;
        $description->save();

        // set the updated_at timestamp for the module
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
        return view('livewire.core.edit.edit-header');
    }
}
