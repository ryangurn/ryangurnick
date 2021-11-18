<?php

namespace App\Http\Livewire\Core;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditTextCard extends ModalComponent
{
    public $page_module;

    public $body;

    public $header;

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
        // grab module parameters and update
        $header = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'header')->first();
        $body = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'body')->first();

        $header->value = $this->header;
        $header->save();

        $body->value = $this->body;
        $body->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.core.edit-text-card');
    }
}
