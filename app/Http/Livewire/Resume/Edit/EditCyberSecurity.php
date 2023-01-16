<?php

namespace App\Http\Livewire\Resume\Edit;

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
 * EditCyberSecurity is a livewire modal that provides
 * the ability to modify cyber security component data.
 */
class EditCyberSecurity extends ModalComponent
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
     * the value that stores the body data.
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
     * edit cyber security modal is saved.
     *
     * @return string[]
     */
    public function rules()
    {
        return $this->module->parameters;
    }

    /**
     * the function that when called will save the new
     * values in the cyber security component.
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

        // grab body data
        $body = $this->module->module_parameters->where('parameter', '=', 'body')->first();

        // update the body data
        $body->value = json_encode($this->body);
        $body->save();

        // set the new updated_at timestamp for the module.
        $this->module->updated_at = Carbon::now();
        $this->module->save();

        // close modal and refresh
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
        return view('livewire.resume.edit.edit-cyber-security');
    }
}
