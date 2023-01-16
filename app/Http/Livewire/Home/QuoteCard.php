<?php

namespace App\Http\Livewire\Home;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * QuoteCard is a livewire component that
 * shows a list of quotes.
 */
class QuoteCard extends Component
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
     * the variable that stores an array of all
     * quotes and their parameters.
     *
     * @var
     */
    public $quotes;

    /**
     * the variable that stores the last time
     * the module was updated.
     *
     * @var
     */
    public $updated_at;

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        // grab the module
        $module = $this->page_module->module;

        // determine if there are any parameters
        if ($module->module_parameters->count() == 0) {
            // populate quotes with module examples
            $this->quotes = collect($module->examples['quotes']);
        } else {
            // populate quotes with module parameters
            $this->quotes = collect(json_decode($module->module_parameters->where('parameter', '=', 'quotes')->first()->value, true));
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.home.quote-card');
    }
}
