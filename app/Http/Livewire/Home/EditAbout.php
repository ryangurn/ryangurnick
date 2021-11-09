<?php

namespace App\Http\Livewire\Home;

use App\Models\Module;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditAbout extends ModalComponent
{
    public $name;

    public $body;

    public function save()
    {
        // grab module parameters and update
        $module = Module::where('component', '=', 'home.about-card')->first();
        $name = $module->module_parameters->where('parameter', '=', 'name')->first();
        $body = $module->module_parameters->where('parameter', '=', 'body')->first();

        $name->value = $this->name;
        $name->save();

        $body->value = $this->body;
        $body->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.home.edit-about');
    }
}
