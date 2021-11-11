<?php

namespace App\Http\Livewire\Resume;

use App\Models\Module;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditComputerScienceExperience extends ModalComponent
{
    public $roles;

    public $module;

    public function mount()
    {
        $this->module = Module::where('component', '=', 'resume.computer-science-experience-card')->first();
    }

    public function rules()
    {
        return $this->module->parameters;
    }

    public function messages()
    {
        $arr = [];
        for ($i = 0; $i < count($this->roles); $i++)
        {
            $arr['roles.'.$i.'.duration.required'] = 'Duration #'.($i+1).' cannot be blank.';
            $arr['roles.'.$i.'.location.required'] = 'Location #'.($i+1).' cannot be blank.';
            $arr['roles.'.$i.'.role.required'] = 'Role #'.($i+1).' cannot be blank.';
            $arr['roles.'.$i.'.company.required'] = 'Company #'.($i+1).' cannot be blank.';
            $arr['roles.'.$i.'.duration.string'] = 'Duration #'.($i+1).' must be a string.';
            $arr['roles.'.$i.'.location.string'] = 'Location #'.($i+1).' must be a string.';
            $arr['roles.'.$i.'.role.string'] = 'Role #'.($i+1).' must be a string.';
            $arr['roles.'.$i.'.company.string'] = 'Company #'.($i+1).' must be a string.';
            $arr['roles.'.$i.'.body.string'] = 'Body #'.($i+1).' must be a string.';
        }

        return $arr;
    }

    public function check()
    {
        $this->messages();
        if (count($this->roles) == 0)
        {
            $this->add();
        }
    }

    public function add()
    {
        $this->messages();
        $this->roles[] = [
            'duration' => '',
            'location' => '',
            'role' => '',
            'company' => '',
            'body' => '',
        ];
    }

    public function remove($i)
    {
        unset($this->roles[$i]);
        $this->check();
    }

    public function save()
    {
        $this->validate();

        $experience = $this->module->module_parameters->where('parameter', '=', 'roles')->first();

        $experience->value = $this->roles;
        $experience->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        $this->check();
        $this->roles = collect($this->roles);
        return view('livewire.resume.edit-computer-science-experience');
    }
}
