<?php

namespace App\Http\Livewire\Core\Edit;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

class EditStats extends ModalComponent
{
    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     *
     * @var
     */
    public $page_module;

    /**
     * the location in which the page module is stored to
     * for local use within the component.
     *
     * @var
     */
    public $module;

    /**
     * the value to display on the header of the module.
     *
     * @var
     */
    public $header;

    /**
     * the value in which all changes are store for the
     * statistics card.
     *
     * @var
     */
    public $cards;

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
     * validation rules that will be checked when the
     * edit stats modal is saved.
     *
     * @return string[]
     */
    public function rules()
    {
        return [
            'cards.*.item' => 'required|string',
            'cards.*.number' => 'required|numeric',
            'cards.*.percentage' => 'required|boolean',
        ];
    }

    /**
     * messages to display when validation errors
     * occur.
     *
     * @return string[]
     */
    public function messages()
    {
        $arr = [];
        for ($i = 0; $i < count($this->cards); $i++) {
            $arr['cards.'.$i.'.item.required'] = 'Item #'.($i + 1).' cannot be blank.';
            $arr['cards.'.$i.'.item.string'] = 'Item #'.($i + 1).' must be a string.';
            $arr['cards.'.$i.'.number.required'] = 'Number #'.($i + 1).' cannot be blank.';
            $arr['cards.'.$i.'.number.numeric'] = 'Number #'.($i + 1).' format invalid.';
            $arr['cards.'.$i.'.percentage.required'] = 'Percentage #'.($i + 1).' cannot be blank.';
            $arr['cards.'.$i.'.percentage.boolean'] = 'Percentage #'.($i + 1).' is invalid.';
        }

        return $arr;
    }

    /**
     * the function when called, will recalculate
     * the validation messages and ensure that there
     * is at least one card.
     *
     * @return void
     */
    public function check()
    {
        // recalc validation messages
        $this->messages();
        if (count($this->cards) == 0) {
            // add a new card if there are zero
            $this->add();
        }
    }

    /**
     * this function when called will recalculate
     * the validation messages and add a new card.
     * this includes some predefined defaults when
     * needed.
     *
     * @return void
     */
    public function add()
    {
        // recalc messages and add new card
        $this->messages();
        $this->cards[] = [
            'item' => '',
            'number' => '',
            'percentage' => '1',
        ];
    }

    /**
     * given an index $i, this will
     * remove a specific card from the
     * cards array and ensure at least one card
     * exists.
     *
     * @param $i
     * @return void
     */
    public function remove($i)
    {
        unset($this->cards[$i]);
        $this->check();
    }

    /**
     * this function when called will save all the
     * statistics information.
     *
     * @return void
     */
    public function save()
    {
        // validate the request
        $this->validate();

        // get the dynamic values for the local variables
        $header = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'header')->first();
        $cards = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'cards')->first();

        // update the header value
        $header->value = $this->header;
        $header->save();

        // update the card values
        $cards->value = $this->cards;
        $cards->save();

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
        $this->check();
        $this->cards = collect($this->cards);

        return view('livewire.core.edit.edit-stats');
    }
}
