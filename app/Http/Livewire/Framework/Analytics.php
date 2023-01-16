<?php

namespace App\Http\Livewire\Framework;

use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

/**
 * Analytics is a livewire modal component that
 * provides analytics information to a user that
 * has permissions to see view counts for each page.
 * Its aim is to quickly and easily view statistics
 * about the website.
 */
class Analytics extends ModalComponent
{
    /**
     * this is the variable that stores all the page models.
     *
     * @var
     */
    public $pages;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->pages = Page::all();
    }

    /**
     * modalMaxWidth sets the maximum width for the modal
     * this needed to be set for the statistics to display
     * properly.
     *
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.analytics');
    }
}
