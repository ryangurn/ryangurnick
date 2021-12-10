<?php

namespace App\Http\Livewire\Framework;

use Livewire\Component;

class ConfigurationSlideover extends Component
{
    protected $listeners = ['show' => 'show', 'hide' => 'hide'];

    public $show = false;

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
        return view('livewire.framework.configuration-slideover');
    }
}
