<?php

namespace App\Http\Livewire\Framework;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

/**
 * AddRole is a livewire modal component that
 * provides the ability to add new roles to
 * the access control system.
 */
class AddRole extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * the value that stores the role name that will be
     * saved to the database.
     * @var
     */
    public $role;

    /**
     * validation rules that will be checked when the
     * add role modal is saved.
     * @return string[]
     */
    public function rules()
    {
        return ['role' => 'required|string|unique:roles,name'];
    }

    /**
     * the function that when called will associate a
     * permission to a role.
     * @return void
     * @throws AuthorizationException
     */
    public function save()
    {
        // verify authorization
        $this->authorize('add roles');

        // validate the request
        $this->validate();

        // create the new role
        $role = new Role();
        $role->name = $this->role;
        $role->save();

        // close the modal and redirect
        $this->closeModal();
        $this->redirect(URL::previous());
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.add-role');
    }
}
