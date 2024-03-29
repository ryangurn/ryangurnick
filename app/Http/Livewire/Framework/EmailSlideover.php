<?php

namespace App\Http\Livewire\Framework;

use App\Models\Email;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

/**
 * EmailSlideover is a livewire component that
 * provides a slideover interface for the user
 * to view emails submitted through the contact
 * module. Its aim is to provide a web interface
 * to review contact submissions with ease.
 */
class EmailSlideover extends Component
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * the listeners variable is the livewire method
     * for binding events to a function for use within
     * other livewire components.
     *
     * @var string[]
     */
    protected $listeners = ['show' => 'show', 'hide' => 'hide'];

    /**
     * the variable that when toggled shows and hides the
     * slide over. This variable is entangled with alpine
     * to provide transitions
     *
     * @var bool
     */
    public $show = false;

    /**
     * the variable that stores all records from the emails
     * model.
     *
     * @var
     */
    public $emails;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->emails = Email::where('read', '<>', true)->get();
    }

    /**
     * this function when called will show the slideover
     *
     * @return void
     */
    public function show()
    {
        $this->show = true;
    }

    /**
     * this function when called will hide the slideover.
     *
     * @return void
     */
    public function hide()
    {
        $this->show = false;
    }

    /**
     * this function when called will mark an email model as
     * read, thus hiding it from the slideover.
     *
     * @param  Email  $email
     * @return void
     */
    public function read(Email $email)
    {
        // verify authorization
        $this->authorize('read emails');

        $email->read = true;
        $email->save();

        $this->redirect(URL::previous());
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.email-slideover');
    }
}
