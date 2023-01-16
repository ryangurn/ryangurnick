<?php

namespace App\Http\Livewire\Framework;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * AccessSlideover is a livewire component that
 * provides a slideover interface for the user to
 * make modifications to the roles and permissions
 * added to the website. Its aim is to provide a
 * simple interface that allows administrators
 * to assign new permissions and create new roles.
 */
class AccessSlideover extends Component
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
     * the array that stores the roles models.
     *
     * @var
     */
    public $roles;

    /**
     * the array that stores the permissions model.
     *
     * @var
     */
    public $permissions;

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
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        // get the roles and permissions data
        $this->roles = Role::all();
        $this->permissions = Permission::all();
    }

    /**
     * function that when called will remove a permission from
     * a specific role.
     *
     * @param  Role  $role
     * @param  Permission  $permission
     * @return void
     *
     * @throws AuthorizationException
     */
    public function remove(Role $role, Permission $permission)
    {
        // verify authorization
        $this->authorize('associate permissions');

        $role->revokePermissionTo($permission);

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
        return view('livewire.framework.access-slideover');
    }
}
