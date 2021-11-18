<?php

namespace App\Http\Livewire\Resume;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditCommitteeWork extends ModalComponent
{
    public $page_module;

    public $institutions;

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
        for ($i = 0; $i < count($this->institutions); $i++)
        {
            $arr['institutions.'.$i.'.organization.required'] = 'Organization #'.($i+1).' cannot be blank.';
            $arr['institutions.'.$i.'.organization.string'] = 'Organization #'.($i+1).' must be a string.';
            $arr['institutions.'.$i.'.position.required'] = 'Position #'.($i+1).' cannot be blank.';
            $arr['institutions.'.$i.'.position.string'] = 'Position #'.($i+1).' must be a string.';
            $arr['institutions.'.$i.'.duration.required'] = 'Duration #'.($i+1).' cannot be blank.';
            $arr['institutions.'.$i.'.duration.string'] = 'Duration #'.($i+1).' must be a string.';
            $arr['institutions.'.$i.'.location.string'] = 'Location #'.($i+1).' must be a string.';
        }

        return $arr;
    }

    public function check()
    {
        $this->messages();
        if (count($this->institutions) == 0)
        {
            $this->add();
        }
    }

    public function add()
    {
        $this->messages();
        $this->institutions[] = [
                'organization' => '',
                'position' => '',
                'duration' => '',
                'location' => '',
            ];
    }

    public function remove($i)
    {
        unset($this->institutions[$i]);
        $this->check();
    }

    public function save()
    {
        $this->validate();

        $institutions = $this->module->module_parameters->where('parameter', '=', 'institutions')->first();

        $institutions->value = $this->institutions;
        $institutions->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        $this->check();
        $this->institutions = collect($this->institutions);
        return view('livewire.resume.edit-committee-work');
    }
}
