<?php

namespace App\Http\Livewire\Home;

use App\Models\Module;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditProject extends ModalComponent
{
    public $projects;

    public $module;

    public function mount()
    {
        $this->module = Module::where('component', '=', 'home.project-card')->first();
    }

    public function rules()
    {
        return $this->module->parameters;
    }

    public function messages()
    {
        $arr = [];
        for ($i = 0; $i < count($this->projects); $i++)
        {
            $arr['projects.'.$i.'.project.required'] = 'Project #'.($i+1).' cannot be blank.';
            $arr['projects.'.$i.'.project.string'] = 'Project #'.($i+1).' must be a string.';
            $arr['projects.'.$i.'.status.required'] = 'Status #'.($i+1).' cannot be blank.';
            $arr['projects.'.$i.'.status.string'] = 'Status #'.($i+1).' must be a string.';
        }

        return $arr;
    }

    public function check()
    {
        $this->messages();
        if (count($this->projects) == 0)
        {
            $this->add();
        }
    }

    public function add()
    {
        $this->messages();
        $this->projects[] = ['project' => '', 'status' => 'archived'];
    }

    public function remove($i)
    {
        unset($this->projects[$i]);
        $this->check();
    }

    public function save()
    {
        $this->validate();

        $projects = $this->module->module_parameters->where('parameter', '=', 'projects')->first();

        $projects->value = $this->projects;
        $projects->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        $this->check();
        $this->projects = collect($this->projects);
        return view('livewire.home.edit-project');
    }
}
