<?php

namespace App\Http\Livewire\Framework;

use App\Models\Page;
use Livewire\Component;

class AuthTemplate extends Component
{
    public $page;

    public $page_id;

    public function mount()
    {
        $this->page = Page::where('id', $this->page_id)->first();
    }

    public function render()
    {
        return view('livewire.framework.auth-template');
    }
}
