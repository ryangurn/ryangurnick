<?php

namespace App\Http\Livewire\Resume\Edit;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

/**
 * EditComputerSkills is a livewire modal that provides
 * the ability to modify computer skills component data.
 */
class EditComputerSkills extends ModalComponent
{
    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     * @var
     */
    public $page_module;

    /**
     * the array that stores computer skills
     * data.
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
     * edit computer skills modal is saved.
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
            $arr['skills.'.$i.'.required'] = 'Skill #'.($i+1).' cannot be blank.';
            $arr['skills.'.$i.'.string'] = 'Skill #'.($i+1).' must be a string.';
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
     * validation messages and add a new sub array to
     * skills with default values.
     * @return void
     */
    public function add()
    {
        $this->messages();
        $this->skills[] = '';
    }

    /**
     * given an index, $i, this function will remove
     * a specific institution sub array and verify that
     * at least one skill exists.
     * @param $i
     * @return void
     */
    public function remove($i)
    {
        unset($this->skills[$i]);
        $this->check();
    }

    /**
     * the function that when called will save the new
     * values in the computer skills component.
     * @return void
     */
    public function save()
    {
        // validate the request
        $this->validate();

        // grab skills data
        $skills = $this->module->module_parameters->where('parameter', '=', 'skills')->first();

        // save the updated skills data
        $skills->value = $this->skills;
        $skills->save();

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
        $this->check();
        $this->skills = collect($this->skills);
        return view('livewire.resume.edit.edit-computer-skills');
    }
}
