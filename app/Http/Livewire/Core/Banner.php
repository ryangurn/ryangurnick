<?php

namespace App\Http\Livewire\Core;

use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Banner extends Component
{
    public $auth_required = true;

    public $auth = false;

    public $modules;

    public function mount()
    {
        $this->auth = Auth::check();
        $this->modules = Module::all();
    }

    public function render()
    {
        return view('livewire.core.banner');
    }
}
