<?php

namespace App\Http\Livewire\Core;

use App\Models\Module;
use App\Models\PageModule;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

/**
 * ChangeOrder is a livewire component that allows
 * for changing the order of the module within the
 * page that it is linked to. Its aim is to provide
 * flexibility on re-ordering modules on a specific
 * page.
 */
class ChangeOrder extends ModalComponent
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
     * @var
     */
    public $page_module;

    /**
     * validation rules that will be checked when the
     * change order modal is saved.
     * @return string[]
     */
    public function rules()
    {
        // require the order value and ensure it is numeric
        return [
            'page_module.order' => 'required|numeric',
        ];
    }

    /**
     * messages to display when validation errors
     * occur.
     * @return string[]
     */
    public function messages()
    {
        // provide human-readable messages for the user when an error is detected.
        return [
            'page_module.order.required' => 'An order is required',
            'page_module.order.numeric' => 'The order must be numeric',
        ];
    }

    /**
     * method that is called when the user is ready
     * to have the value changed.
     * @return void
     * @throws AuthorizationException
     */
    public function save()
    {
        // get the module
        $module = Module::where('id', $this->page_module['module_id'])->first();

        // verify authorization
        $this->authorize($module->permissions['reorder']);

        // validate the request first.
        $this->validate();

        // get the page module model and update the order parameter.
        $page_module = PageModule::where('id', '=', $this->page_module['id'])->first();
        $page_module->order = $this->page_module['order'];
        $page_module->save();

        // close the modal and redirect the user.
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
        return view('livewire.core.change-order');
    }
}
