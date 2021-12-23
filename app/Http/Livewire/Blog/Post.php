<?php

namespace App\Http\Livewire\Blog;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Post extends Component
{
    /**
     * the page module model that is passed throughout
     * the application to identify modals and page
     * information
     * @var
     */
    public $page_module;

    /**
     * the value to pass through to the card footer
     * as the last time it was modified.
     * @var
     */
    public $updated_at;

    /**
     * the value that stores the post title for display
     * on the card
     * @var
     */
    public $title;

    /**
     * the value that stores the post body for display
     * in part on the card.
     * @var
     */
    public $body;

    /**
     * the value that stores the page module hash to
     * route to the post.
     * @var
     */
    public $hash;

    /**
     * the value that stores the hash from the URI
     * as passed through the view.
     * @var
     */
    public $identifier;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        // grab the module
        $module = $this->page_module->module;

        // grab the hash, if the identifier is not null use that, otherwise use the page_module hash.
        // this is to allow for the post view to be rendered dynamically.
        $this->hash = ($this->identifier != null) ? $this->identifier : $this->page_module->hash;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            // populate the variables with the modules examples
            $this->title = $module->examples['title'];
            $this->body = $module->examples['body'];
        }
        else
        {
            // populate the variables with dynamic parameters (using hash)
            $this->title = $module->module_parameters->where('hash', '=', $this->hash)->where('parameter', '=', 'title')->first()->value;
            $this->body = $module->module_parameters->where('hash', '=', $this->hash)->where('parameter', '=', 'body')->first()->value;
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.blog.post');
    }
}
