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
 * EditText is a livewire modal component that
 * provides a method for modifying the parameters
 * for the TextCard.
 */
class EditText extends ModalComponent
{
    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     * @var
     */
    public $page_module;

    /**
     * the value to display on the body of the module.
     * @var
     */
    public $body;

    /**
     * the value to display on the header of the module.
     * @var
     */
    public $header;

    /**
     * the location in which the page module is stored to
     * for local use within the component.
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
     * edit text modal is saved.
     * @return string[]
     */
    public function rules()
    {
        return $this->module->parameters;
    }

    /**
     * the function when called that will save the new
     * values for the text card.
     * @return void
     */
    public function save()
    {
        // validate the request
        $this->validate();
        // grab module parameters and update
        $header = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'header')->first();
        $body = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'body')->first();

        // update the header value
        $header->value = $this->header;
        $header->save();

        // update the body value
        $body->value = $this->body;
        $body->save();

        // set the new updated_at timestamp for the module
        $this->module->updated_at = Carbon::now();
        $this->module->save();

        // close modal and redirect
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
        return view('livewire.core.edit.edit-text');
    }
}
