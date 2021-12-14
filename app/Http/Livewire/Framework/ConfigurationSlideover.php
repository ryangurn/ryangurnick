<?php

namespace App\Http\Livewire\Framework;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * ConfigurationSlideover is a livewire component that
 * provides a slideover interface for the user to view
 * configuration information about the application. Its
 * aim is to provide a more visual method for viewing
 * Laravel's config and env data even though it cannot
 * be edited.
 */
class ConfigurationSlideover extends Component
{
    /**
     * the listeners variable is the livewire method
     * for binding events to a function for use within
     * other livewire components.
     * @var string[]
     */
    protected $listeners = ['show' => 'show', 'hide' => 'hide'];

    /**
     * the variable that when toggled shows and hides the
     * slide over. This variable is entangled with alpine
     * to provide transitions
     * @var bool
     */
    public $show = false;

    /**
     * this function when called will show the slideover
     * @return void
     */
    public function show()
    {
        $this->show = true;
    }

    /**
     * this function when called will hide the slideover.
     * @return void
     */
    public function hide()
    {
        $this->show = false;
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.configuration-slideover');
    }
}
