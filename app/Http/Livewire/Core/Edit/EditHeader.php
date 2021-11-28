<?php

namespace App\Http\Livewire\Core\Edit;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditHeader extends ModalComponent
{
    public $page_module;

    public $module;

    public $header;

    public $description;

    public $color;

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

        $header = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'header')->first();
        $color = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'color')->first();
        $description = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'description')->first();

        $header->value = $this->header;
        $header->save();

        $color->value = $this->color;
        $color->save();

        $description->value = $this->description;
        $description->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());

    }

    public function render()
    {
        return view('livewire.core.edit.edit-header');
    }
}
