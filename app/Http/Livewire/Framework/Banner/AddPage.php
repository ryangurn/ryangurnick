<?php

namespace App\Http\Livewire\Framework\Banner;

use App\Models\Page;
use App\Models\PageType;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class AddPage extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * The value that stores the current value provided
     * from the form for the new page name.
     */
    public $page_name;

    /**
     * validation rules that will be checked when the
     * modal is saved.
     * @return string[]
     */
    public function rules()
    {
        return [
            'page_name' => [
                'required',
                'string',
                'unique:pages,name',
                Rule::notIn('post')
            ]
        ];
    }

    /**
     * the function that when called will add
     * a new page using the $page variable.
     * @return void
     * @throws AuthorizationException
     */
    public function save()
    {
        // verify authorization
        $this->authorize('add page');

        // validate the request
        $this->validate();

        if ($this->page_name != 'blog')
        {
            // get the standard page type
            $standard = PageType::where('name', '=', 'standard')->first();

            // add the page
            $page = Page::create([
                'type_id' => $standard->id,
                'title' => $this->page_name,
                'slug' => '/'.Str::slug($this->page_name),
                'name' => Str::slug($this->page_name),
                'controller' => 'App\Http\Controllers\PageController',
                'method' => 'index',
                'publish_date' => Carbon::now()
            ]);
        }
        else
        {
            // get the standard page type
            $blog = PageType::where('name', '=', 'blog')->first();

            // add the page
            $page = Page::create([
                'type_id' => $blog->id,
                'title' => $this->page_name,
                'slug' => '/'.Str::slug($this->page_name),
                'name' => Str::slug($this->page_name),
                'controller' => 'App\Http\Controllers\PageController',
                'method' => 'index',
                'publish_date' => Carbon::now()
            ]);
        }

        // refresh the current page.
        $this->redirect(URL::previous());
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.banner.add-page');
    }
}
