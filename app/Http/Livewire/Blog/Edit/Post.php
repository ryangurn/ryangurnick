<?php

namespace App\Http\Livewire\Blog\Edit;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class Post extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     *
     * @var
     */
    public $page_module;

    /**
     * the value to display on the body of the module.
     *
     * @var
     */
    public $body;

    /**
     * the value to display on the title of the module.
     *
     * @var
     */
    public $title;

    /**
     * the location in which the page module is stored to
     * for local use within the component.
     *
     * @var
     */
    public $module;

    /**
     * validation rules that will be checked when the
     * edit text modal is saved.
     *
     * @return string[]
     */
    public function rules()
    {
        return $this->module->parameters;
    }

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
    }

    /**
     * the function when called that will save the new
     * values for the post.
     *
     * @return void
     *
     * @throws AuthorizationException
     */
    public function save()
    {
        $this->authorize('edit post');

        // validate the request
        $this->validate();

        // grab the previous values
        $title = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'title')->first();
        $body = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'body')->first();

        // update the title
        $title->value = $this->title;
        $title->save();

        // update the body
        $body->value = $this->body;
        $body->save();

        // set the new updated_at timestamp for the module
        $this->module->updated_at = Carbon::now();
        $this->module->save();

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
        return view('livewire.blog.edit.post');
    }
}
