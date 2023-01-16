<?php

namespace App\Http\Livewire\Home\Edit;

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
 * EditProject is a livewire modal component that
 * allows for editing the projects that will be
 * displayed on the ProjectsCard.
 */
class EditProject extends ModalComponent
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
     * the value that stores the list of projects models.
     *
     * @var
     */
    public $projects;

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
     * edit about modal is saved.
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
        for ($i = 0; $i < count($this->projects); $i++) {
            $arr['projects.'.$i.'.project.required'] = 'Project #'.($i + 1).' cannot be blank.';
            $arr['projects.'.$i.'.project.string'] = 'Project #'.($i + 1).' must be a string.';
            $arr['projects.'.$i.'.status.required'] = 'Status #'.($i + 1).' cannot be blank.';
            $arr['projects.'.$i.'.status.string'] = 'Status #'.($i + 1).' must be a string.';
            $arr['projects.'.$i.'.link.url'] = 'Link #'.($i + 1).' must be a url.';
            $arr['projects.'.$i.'.link.string'] = 'Link #'.($i + 1).' must be a url.';
        }

        return $arr;
    }

    /**
     * the function that when called will recalculate the validation
     * messages and ensure that at least one project exists
     *
     * @return void
     */
    public function check()
    {
        $this->messages();
        if (count($this->projects) == 0) {
            $this->add();
        }
    }

    /**
     * this function when called will recalculate the validation
     * messages and add a project with some default values.
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
        $this->projects[] = ['project' => '', 'status' => 'archived'];
    }

    /**
     * Given an index, $i, this function will remove the project sub array
     * within the projects array. this function will also ensure there is at
     * least one project.
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

        unset($this->projects[$i]);
        $this->check();
    }

    /**
     * the function that when called will save the new
     * values in the about component.
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

        // get the projects as stored in module parameters
        $projects = $this->module->module_parameters->where('parameter', '=', 'projects')->first();

        // update the projects array
        $projects->value = $this->projects;
        $projects->save();

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
        $this->projects = collect($this->projects);

        return view('livewire.home.edit.edit-project');
    }
}
