<?php

namespace App\Http\Livewire\Resume;

use App\Models\Module;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditGoals extends ModalComponent
{
    public $body;

    public $module;

    public function mount()
    {
        $this->module = Module::where('component', '=', 'resume.goals-card')->first();
    }

    public function rules()
    {
        return $this->module->parameters;
    }

    public function save()
    {
        $this->validate();

        $body = $this->module->module_parameters->where('parameter', '=', 'body')->first();

        $body->value = json_encode($this->body);
        $body->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.resume.edit-goals');
    }
}
