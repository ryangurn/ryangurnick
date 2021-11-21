<?php

namespace App\Http\Livewire\Core\Edit;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditStats extends ModalComponent
{
    public $page_module;

    public $module;

    public $header;

    public $cards;

    public function mount()
    {
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
    }

    public function rules()
    {
        return [
            'cards.*.item' => 'required|string',
            'cards.*.number' => 'required|numeric',
            'cards.*.percentage' => 'required|boolean'
        ];
    }

    public function messages()
    {
        $arr = [];
        for ($i = 0; $i < count($this->cards); $i++)
        {
            $arr['cards.'.$i.'.item.required'] = 'Item #'.($i+1).' cannot be blank.';
            $arr['cards.'.$i.'.item.string'] = 'Item #'.($i+1).' must be a string.';
            $arr['cards.'.$i.'.number.required'] = 'Number #'.($i+1).' cannot be blank.';
            $arr['cards.'.$i.'.number.numeric'] = 'Number #'.($i+1).' format invalid.';
            $arr['cards.'.$i.'.percentage.required'] = 'Percentage #'.($i+1).' cannot be blank.';
            $arr['cards.'.$i.'.percentage.boolean'] = 'Percentage #'.($i+1).' is invalid.';
        }

        return $arr;
    }

    public function check()
    {
        $this->messages();
        if (count($this->cards) == 0)
        {
            $this->add();
        }
    }

    public function add()
    {
        $this->messages();
        $this->cards[] = [
            'item' => '',
            'number' => '',
            'percentage' => '1',
        ];
    }

    public function remove($i)
    {
        unset($this->cards[$i]);
        $this->check();
    }

    public function save()
    {
        $this->validate();

        $header = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'header')->first();
        $cards = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'cards')->first();

        $header->value = $this->header;
        $header->save();

        $cards->value = $this->cards;
        $cards->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        $this->check();
        $this->cards = collect($this->cards);
        return view('livewire.core.edit.edit-stats');
    }
}
