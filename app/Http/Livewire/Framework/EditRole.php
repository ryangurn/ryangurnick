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
 * UpdateRole is a livewire modal component
 * which provides the ability to update the
 * name of a role.
 */
class EditRole extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * the value that allows for the role to be pulled
     * from the database based on the identifier
     * @var
     */
    public $role_id;

    /**
     * the value that stores the role modal that is being
     * updated.
     * @var
     */
    public $role;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        $this->role = Role::where('id', $this->role_id)->first();
    }

    /**
     * validation rules that will be checked when the
     * update role modal is saved.
     * @return string[]
     */
    public function rules()
    {
        return ['role.name' => 'required|string|unique:roles,name'];
    }

    /**
     * the function that when called will save the role name.
     * @return void
     * @throws AuthorizationException
     */
    public function save()
    {
        // verify authorization
        $this->authorize('update roles');

        // validate the request
        $this->validate();

        // save the updated role name
        $this->role->save();

        // redirect to show updated changes
        $this->redirect(URL::previous());
    }

    /**
     * the function that when called will delete the role.
     * @return void
     * @throws AuthorizationException
     */
    public function delete()
    {
        // verify authorization
        $this->authorize('delete roles');

        // save the updated role name
        $this->role->delete();

        // redirect to show updated changes
        $this->redirect(URL::previous());
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.edit-role');
    }
}
