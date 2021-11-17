<?php

namespace App\Http\Livewire\Resume;

use App\Models\Module;
use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditOperatingSystem extends ModalComponent
{
    public $page_module;

    public $module;

    public $systems;

    public $modals;

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
        for ($i = 0; $i < count($this->systems); $i++)
        {
            $arr['systems.'.$i.'.required'] = 'Operating System #'.($i+1).' cannot be blank.';
            $arr['systems.'.$i.'.string'] = 'Operating System #'.($i+1).' must be a string.';
        }

        return $arr;
    }

    public function check()
    {
        $this->messages();
        if (count($this->systems) == 0)
        {
            $this->add();
        }
    }

    public function add()
    {
        $this->messages();
        $this->systems[] = '';
    }

    public function remove($i)
    {
        unset($this->systems[$i]);
        $this->check();
    }

    public function save()
    {
        $this->validate();

        $systems = $this->module->module_parameters->where('parameter', '=', 'systems')->first();

        $systems->value = $this->systems;
        $systems->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        $this->check();
        $this->systems = collect($this->systems);
        return view('livewire.resume.edit-operating-system');
    }
}
