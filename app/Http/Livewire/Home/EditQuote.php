<?php

namespace App\Http\Livewire\Home;

use App\Models\Module;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditQuote extends ModalComponent
{
    public $quotes;

    public function check()
    {
        if (count($this->quotes) == 0)
        {
            $this->add();
        }
    }

    public function add()
    {
        $this->quotes[] = ['quote' => '', 'author' => ''];
    }

    public function remove($i)
    {
        unset($this->quotes[$i]);
        $this->check();
    }

    public function save()
    {
        $module = Module::where('component', '=', 'home.quote-card')->first();
        $quotes = $module->module_parameters->where('parameter', '=', 'quotes')->first();

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
