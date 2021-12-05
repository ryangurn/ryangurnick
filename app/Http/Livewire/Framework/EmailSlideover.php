<?php

namespace App\Http\Livewire\Framework;

use App\Models\Email;
use Livewire\Component;

class EmailSlideover extends Component
{
    protected $listeners = ['show' => 'show', 'hide' => 'hide'];

    public $show = false;

    public $emails;

    public function mount()
    {
        $this->emails = Email::where('read', '<>', true)->get();
    }

    public function show()
    {
        $this->show = true;
    }

    public function hide()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.framework.email-slideover');
    }
}
