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
 * EditComputerScienceExperience is a livewire modal that provides
 * the ability to modify computer science experience component data.
 */
class EditComputerScienceExperience extends ModalComponent
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
     * the array that stores computer science role
     * data.
     *
     * @var
     */
    public $roles;

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
     * edit computer science experience modal is saved.
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
        for ($i = 0; $i < count($this->roles); $i++) {
            $arr['roles.'.$i.'.duration.required'] = 'Duration #'.($i + 1).' cannot be blank.';
            $arr['roles.'.$i.'.location.required'] = 'Location #'.($i + 1).' cannot be blank.';
            $arr['roles.'.$i.'.role.required'] = 'Role #'.($i + 1).' cannot be blank.';
            $arr['roles.'.$i.'.company.required'] = 'Company #'.($i + 1).' cannot be blank.';
            $arr['roles.'.$i.'.duration.string'] = 'Duration #'.($i + 1).' must be a string.';
            $arr['roles.'.$i.'.location.string'] = 'Location #'.($i + 1).' must be a string.';
            $arr['roles.'.$i.'.role.string'] = 'Role #'.($i + 1).' must be a string.';
            $arr['roles.'.$i.'.company.string'] = 'Company #'.($i + 1).' must be a string.';
            $arr['roles.'.$i.'.body.string'] = 'Body #'.($i + 1).' must be a string.';
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
        if (count($this->roles) == 0) {
            $this->add();
        }
    }

    /**
     * the function that when called will recalculate
     * validation messages and add a new sub array to
     * roles with default values.
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
        $this->roles[] = [
            'duration' => '',
            'location' => '',
            'role' => '',
            'company' => '',
            'body' => '',
        ];
    }

    /**
     * given an index, $i, this function will remove
     * a specific institution sub array and verify that
     * at least one role exists.
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

        unset($this->roles[$i]);
        $this->check();
    }

    /**
     * the function that when called will save the new
     * values in the computer science experience component.
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

        // grab experience data.
        $experience = $this->module->module_parameters->where('parameter', '=', 'roles')->first();

        // save the updated experience data.
        $experience->value = $this->roles;
        $experience->save();

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
        $this->check();
        $this->roles = collect($this->roles);

        return view('livewire.resume.edit.edit-computer-science-experience');
    }
}
