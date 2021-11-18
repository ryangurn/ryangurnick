<?php

namespace App\Http\Livewire\Core;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class FooterMetadata extends Component
{
    public $duration;

    public $page;

    public function mount()
    {
        $this->duration = ($this->duration != null) ? $this->duration->diffForHumans() : 'Unknown';

        $this->page = Route::currentRouteName();
    }

    public function render()
    {
        return view('livewire.core.footer-metadata');
    }
}
