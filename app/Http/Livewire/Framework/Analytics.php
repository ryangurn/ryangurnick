<?php

namespace App\Http\Livewire\Framework;

use App\Models\Page;
use LivewireUI\Modal\ModalComponent;

class Analytics extends ModalComponent
{
    public $pages;

    public function mount()
    {
        $this->pages = Page::all();
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function render()
    {
        return view('livewire.framework.analytics');
    }
}
