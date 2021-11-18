<?php

namespace App\Http\Livewire\Resume;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditSoftware extends ModalComponent
{
    public $page_module;

    public $body;

    public $module;

    public function mount()
    {
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
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
        return view('livewire.resume.edit-software');
    }
}
