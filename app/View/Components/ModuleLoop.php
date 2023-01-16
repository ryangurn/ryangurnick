<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * ModuleLoop is a livewire component that
 * handles the addition of the modules
 * to a specific page.
 */
class ModuleLoop extends Component
{
    /**
     * The value that stores the modules that
     * should be linked on a given page.
     */
    public $modules;

    /**
     * The value that stores the identifier
     * to be passed to the module.
     */
    public $identifier;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Page $page, $identifier = '')
    {
        // get modules on page
        $this->modules = $page->page_modules->sortBy('order');
        $this->identifier = $identifier;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.module-loop');
    }
}
