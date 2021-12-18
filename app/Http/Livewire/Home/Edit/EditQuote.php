<?php

namespace App\Http\Livewire\Home\Edit;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

/**
 * EditQuote is a livewire modal component that
 * provides functionality for modifying the content
 * of the quotes card.
 */
class EditQuote extends ModalComponent
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
     * @var
     */
    public $page_module;

    /**
     * the value that stores quotes in an array.
     * @var
     */
    public $quotes;

    /**
     * the value that stores the module model.
     * @var
     */
    public $module;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
    }

    /**
     * validation rules that will be checked when the
     * edit about modal is saved.
     * @return string[]
     */
    public function rules()
    {
        return $this->module->parameters;
    }

    /**
     * messages to display when validation errors
     * occur.
     * @return string[]
     */
    public function messages()
    {
        $arr = [];
        for ($i = 0; $i < count($this->quotes); $i++)
        {
            $arr['quotes.'.$i.'.quote.required'] = 'Quote #'.($i+1).' cannot be blank.';
            $arr['quotes.'.$i.'.quote.string'] = 'Quote #'.($i+1).' must be a string.';
            $arr['quotes.'.$i.'.author.required'] = 'Author #'.($i+1).' cannot be blank.';
            $arr['quotes.'.$i.'.author.string'] = 'Author #'.($i+1).' must be a string.';
        }

        return $arr;
    }

    /**
     * the function that when called will recalculate the validation
     * messages and ensure that at least one quote exists
     * @return void
     */
    public function check()
    {
        $this->messages();
        if (count($this->quotes) == 0)
        {
            $this->add();
        }
    }

    /**
     * this function when called will recalculate the validation
     * messages and add a quote with some default values.
     * @return void
     */
    public function add()
    {
        // verify authorization
        $this->authorize($this->module->permissions['edit']);

        $this->messages();
        $this->quotes[] = ['quote' => '', 'author' => ''];
    }

    /**
     * Given an index, $i, this function will remove the quote sub array
     * within the quotes array. this function will also ensure there is at
     * least one quote.
     * @param $i
     * @return void
     */
    public function remove($i)
    {
        // verify authorization
        $this->authorize($this->module->permissions['edit']);

        unset($this->quotes[$i]);
        $this->check();
    }

    /**
     * the function that when called will save the new
     * values in the about component.
     * @return void
     */
    public function save()
    {
        // verify authorization
        $this->authorize($this->module->permissions['edit']);

        // validate the request
        $this->validate();

        // populate the component parameter values
        $quotes = $this->module->module_parameters->where('parameter', '=', 'quotes')->first();

        // save the new quotes array
        $quotes->value = $this->quotes;
        $quotes->save();

        // set the new updated_at timestamp for the module.
        $this->module->updated_at = Carbon::now();
        $this->module->save();

        // close modal and redirect
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
        $this->check();
        $this->quotes = collect($this->quotes);
        return view('livewire.home.edit.edit-quote');
    }
}
