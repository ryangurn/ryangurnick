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
 * EditOperatingSystem is a livewire modal that provides
 * the ability to modify operating system component data.
 */
class EditOperatingSystem extends ModalComponent
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
     * the array that stores the operating system
     * data and associated parameters.
     *
     * @var
     */
    public $systems;

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
     * edited data is saved.
     *
     * @return string[]
     */
    public function rules()
    {
        return $this->module->parameters;
    }

    /**
     * messages to display when validation errors
     * occur.
     *
     * @return string[]
     */
    public function messages()
    {
        $arr = [];
        for ($i = 0; $i < count($this->systems); $i++) {
            $arr['systems.'.$i.'.required'] = 'Operating System #'.($i + 1).' cannot be blank.';
            $arr['systems.'.$i.'.string'] = 'Operating System #'.($i + 1).' must be a string.';
        }

        return $arr;
    }

    /**
     * the function that when called will recalculate
     * the validation messages. it will also ensure
     * that there is at least one value.
     *
     * @return void
     */
    public function check()
    {
        $this->messages();
        if (count($this->systems) == 0) {
            $this->add();
        }
    }

    /**
     * the function that when called will recalculate
     * validation messages and add a new sub array
     * with default values.
     *
     * @return void
     *
     * @throws AuthorizationException
     */
    public function add()
    {
        // verify authorization
        $this->authorize($this->module->permissions['edit']);

        $this->messages();
        $this->systems[] = '';
    }

    /**
     * given an index, $i, this function will remove
     * a specific sub array and verify that
     * at least one row exists.
     *
     * @param $i
     * @return void
     *
     * @throws AuthorizationException
     */
    public function remove($i)
    {
        // verify authorization
        $this->authorize($this->module->permissions['edit']);

        unset($this->systems[$i]);
        $this->check();
    }

    /**
     * the function that when called will save the new
     * values in the component.
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

        // grab the systems data
        $systems = $this->module->module_parameters->where('parameter', '=', 'systems')->first();

        // save the systems data
        $systems->value = $this->systems;
        $systems->save();

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
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        $this->check();
        $this->systems = collect($this->systems);

        return view('livewire.resume.edit.edit-operating-system');
    }
}
