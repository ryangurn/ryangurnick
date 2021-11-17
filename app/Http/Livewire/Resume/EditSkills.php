<?php

namespace App\Http\Livewire\Resume;

use App\Models\Module;
use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditSkills extends ModalComponent
{
    public $page_module;

    public $skills;

    public $module;

    public function mount()
    {
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
    }

    public function rules()
    {
        return $this->module->parameters;
    }

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

    public function check()
    {
        $this->messages();
        if (count($this->skills) == 0)
        {
            $this->add();
        }
    }

    public function add()
    {
        $this->messages();
        $this->skills[] = ['skill' => '', 'level' => 'moderate'];
    }

    public function remove($i)
    {
        unset($this->skills[$i]);
        $this->check();
    }

    public function save()
    {
        $this->validate();

        $skills = $this->module->module_parameters->where('parameter', '=', 'skills')->first();

        $skills->value = $this->skills;
        $skills->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        $this->check();
        $this->skills = collect($this->skills);
        return view('livewire.resume.edit-skills');
    }
}
