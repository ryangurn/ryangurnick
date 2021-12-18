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
class EditSkills extends ModalComponent
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
     * the array that stores the skill
     * data and associated parameters.
     * @var
     */
    public $skills;

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
     * edited data is saved.
     * @return string[]
     */
    public function rules()
    {
        return $this->module->parameters;
    }

    /**
     * messages to display when validation errors
     * occur.
     * @return string[]
     */
    public function messages()
    {
        $arr = [];
        for ($i = 0; $i < count($this->skills); $i++)
        {
            $arr['skills.'.$i.'.skill.required'] = 'Skill #'.($i+1).' cannot be blank.';
            $arr['skills.'.$i.'.skill.string'] = 'Skill #'.($i+1).' must be a string.';
            $arr['skills.'.$i.'.level.required'] = 'Level #'.($i+1).' cannot be blank.';
            $arr['skills.'.$i.'.level.string'] = 'Level #'.($i+1).' must be a string.';
            $arr['skills.'.$i.'.level.in'] = 'Level #'.($i+1).' must be one of the values in the select.';
        }

        return $arr;
    }

    /**
     * the function that when called will recalculate
     * the validation messages. it will also ensure
     * that there is at least one value.
     * @return void
     */
    public function check()
    {
        $this->messages();
        if (count($this->skills) == 0)
        {
            $this->add();
        }
    }

    /**
     * the function that when called will recalculate
     * validation messages and add a new sub array
     * with default values.
     * @return void
     * @throws AuthorizationException
     */
    public function add()
    {
        // verify authorization
        $this->authorize($this->module->permissions['edit']);

        $this->messages();
        $this->skills[] = ['skill' => '', 'level' => 'moderate'];
    }

    /**
     * given an index, $i, this function will remove
     * a specific sub array and verify that
     * at least one row exists.
     * @param $i
     * @return void
     * @throws AuthorizationException
     */
    public function remove($i)
    {
        // verify authorization
        $this->authorize($this->module->permissions['edit']);

        unset($this->skills[$i]);
        $this->check();
    }

    /**
     * the function that when called will save the new
     * values in the component.
     * @return void
     * @throws AuthorizationException
     */
    public function save()
    {
        // verify authorization
        $this->authorize($this->module->permissions['edit']);

        // validate the request
        $this->validate();

        // get the skills data
        $skills = $this->module->module_parameters->where('parameter', '=', 'skills')->first();

        // save the new skills data
        $skills->value = $this->skills;
        $skills->save();

        // set the new updated_at timestamp for the module.
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
        $this->check();
        $this->skills = collect($this->skills);
        return view('livewire.resume.edit.edit-skills');
    }
}
