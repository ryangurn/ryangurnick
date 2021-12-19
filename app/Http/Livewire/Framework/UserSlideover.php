<?php

namespace App\Http\Livewire\Framework;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * UserSlideover is a livewire component that
 * provides a list of users that have access
 * to the application. Additionally, it allows
 * for access control assignment to each user.
 */
class UserSlideover extends Component
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
     * the array that stores all the users models.
     * @var
     */
    public $users;

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
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        $this->users = User::all();
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.user-slideover');
    }
}
