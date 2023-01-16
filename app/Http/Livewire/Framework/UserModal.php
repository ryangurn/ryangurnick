<?php

namespace App\Http\Livewire\Framework;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

/**
 * UserModal is a livewire modal component that
 * provides the ability to manage a users
 * parameters, including but not limited to
 * access controls.
 */
class UserModal extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * the value that is used to initialize the
     * user model
     *
     * @var
     */
    public $user_id;

    /**
     * the value that is used to store the user
     * model
     *
     * @var
     */
    public $user;

    /**
     * the value that stores the modified role
     * array from the modal.
     *
     * @var
     */
    public $role;

    /**
     * the list of all roles that can be associated
     * to each user.
     *
     * @var
     */
    public $roles;

    /**
     * validation rules that will be checked when the
     * user modal is saved.
     *
     * @return string[]
     */
    public function rules()
    {
        return [
            'user.name' => 'required|string',
            'user.email' => 'required|email',
            'role' => 'required|array',
        ];
    }

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->user = User::where('id', $this->user_id)->first();
        $this->roles = Role::all();
        $this->role = $this->user->roles->pluck('id');
    }

    /**
     * function that when called will save the user
     * modal.
     *
     * @return void
     *
     * @throws AuthorizationException
     */
    public function save()
    {
        // verify authorization
        $this->authorize('associate permissions');

        // save the updated user params
        $this->user->save();

        $this->user->syncRoles($this->role);

        // redirect to show updated changes
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
        return view('livewire.framework.user-modal');
    }
}
