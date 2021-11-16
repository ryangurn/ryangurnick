<?php

namespace App\Http\Livewire\Core;

use App\Models\PageModule;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class ChangeOrder extends ModalComponent
{
    public $page_module;

    public function rules()
    {
        return [
            'page_module.order' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'page_module.order.required' => 'An order is required',
            'page_module.order.numeric' => 'The order must be numeric',
        ];
    }

    public function save()
    {
        $this->validate();

        $page_module = PageModule::where('id', '=', $this->page_module['id'])->first();
        $page_module->order = $this->page_module['order'];
        $page_module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.core.change-order');
    }
}
