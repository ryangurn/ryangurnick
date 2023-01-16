<?php

namespace App\Http\Livewire\Framework;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * AddPermission is a livewire modal component that
 * provides the ability to associate a permission to
 * a specific role.
 */
class AddPermission extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * the value that allows for the role to be pulled
     * from the database based on the identifier
     *
     * @var
     */
    public $role_id;

    /**
     * the value that stores the role modal that is being
     * updated.
     *
     * @var
     */
    public $role;

    /**
     * the array that stores all the permissions models.
     *
     * @var
     */
    public $permissions;

    /**
     * the value that stores the permission to associate
     * to the role.
     *
     * @var
     */
    public $permission;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->role = Role::where('id', $this->role_id)->first();
        $this->permissions = Permission::whereNotIn('id', $this->role->permissions->pluck('id'))->get();
    }

    /**
     * validation rules that will be checked when the
     * update role modal is saved.
     *
     * @return string[]
     */
    public function rules()
    {
        return ['permission' => 'required|numeric|exists:permissions,id'];
    }

    /**
     * the function that when called will associate a
     * permission to a role.
     *
     * @return void
     *
     * @throws AuthorizationException
     */
    public function save()
    {
        // verify authorization
        $this->authorize('associate permissions');

        // validate the request
        $this->validate();

        // associate the permission to the role
        $this->role->givePermissionTo($this->permission);

        // close the modal and redirect
        $this->closeModal();
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
        return view('livewire.framework.add-permission');
    }
}
