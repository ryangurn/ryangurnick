<?php

namespace App\Http\Livewire\Home;

use App\Models\Module;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditQuote extends ModalComponent
{
    public $quotes;

    public $module;

    public function mount()
    {
        $this->module = Module::where('component', '=', 'home.quote-card')->first();
    }

    public function rules()
    {
        return $this->module->parameters;
    }

    public function messages()
    {
        $arr = [];
        for ($i = 0; $i < count($this->quotes); $i++)
        {
            $arr['quotes.'.$i.'.quote.required'] = 'Quote #'.($i+1).' cannot be blank.';
            $arr['quotes.'.$i.'.quote.string'] = 'Quote #'.($i+1).' must be a string.';
            $arr['quotes.'.$i.'.author.required'] = 'Author #'.($i+1).' cannot be blank.';
            $arr['quotes.'.$i.'.author.string'] = 'Author #'.($i+1).' must be a string.';
        }

        return $arr;
    }

    public function check()
    {
        $this->messages();
        if (count($this->quotes) == 0)
        {
            $this->add();
        }
    }

    public function add()
    {
        $this->messages();
        $this->quotes[] = ['quote' => '', 'author' => ''];
    }

    public function remove($i)
    {
        unset($this->quotes[$i]);
        $this->check();
    }

    public function save()
    {
        $this->validate();

        $quotes = $this->module->module_parameters->where('parameter', '=', 'quotes')->first();

        // check for empty quotes
        foreach ($this->quotes as $key => $quote)
        {
            if ($quote['quote'] == null && $quote['author'] == null) {
                unset($this->quotes[$key]);
            }
        }

        $quotes->value = $this->quotes;
        $quotes->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        $this->check();
        $this->quotes = collect($this->quotes);
        return view('livewire.home.edit-quote');
    }
}
