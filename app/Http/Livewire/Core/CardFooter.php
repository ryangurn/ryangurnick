<?php

namespace App\Http\Livewire\Core;

use App\Models\ModuleParameter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

/**
 * CardFooter is a livewire component that provides
 * buttons and information about each card. It's aim
 * is to standardize the administrative controls that
 * are accessible on each module.
 */
class CardFooter extends Component
{
    /**
     * determine if authentication is required
     * for the card footer to show, by default
     * authentication is required.
     * @var bool
     */
    public $auth_required = true;

    /**
     * determine if there is an authenticated
     * user.
     * @var bool
     */
    public $auth = false;

    /**
     * determine if timestamp should be shown
     * on a specific module.
     * @var bool
     */
    public $show_timestamp = true;

    /**
     * the text that will show on the main button
     * @var string
     */
    public $button_text = 'edit';

    /**
     * parameters to send through to a linked modal
     * that will __generally__ be for content editing
     * or modification
     * @var array
     */
    public $modal_parameters = [];

    /**
     * when toggled determines if the button with three
     * dots will be displayed on a specific module.
     * @var bool
     */
    public $show_menu = false;

    /**
     * used to add menu options to the dropdown menu
     * can be either a link or a modal.
     * @var array
     */
    public $menu_options = [];

    /**
     * the page module model that is passed throughout
     * the application to identify modals and page
     * information
     * @var
     */
    public $page_module;

    /**
     * the duration that will be passed along to the footer
     * metadata component to display the human-readable difference.
     * @var
     */
    public $duration;

    /**
     * determines if the dropdown is shown or not shown at any
     * given point, generally is only for internal use by this
     * component.
     * @var bool
     */
    public $show = false;

    /**
     * the modal component that should be called when clicking
     * the button that uses $button_text to display.
     * @var
     */
    public $modal;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        $this->auth = Auth::check();
    }

    /**
     * method that will hide the dropdown menu when called.
     * @return void
     */
    public function hidePopup()
    {
        $this->show = false;
    }

    /**
     * method that will show the dropdown menu when called.
     * @return void
     */
    public function showPopup()
    {
        $this->show = true;
    }

    /**
     * method that is called to enable the module on a
     * specific page.
     * @return void
     */
    public function enable()
    {
        // change the enabled value to true & save.
        $this->page_module->enabled = true;
        $this->page_module->save();

        // redirect to the previous page, previous
        // is relative since it's generally the same
        // page they are currently on.
        $this->redirect(URL::previous());
    }

    /**
     * method that is called to disable the module on a
     * specific page.
     * @return void
     */
    public function disable()
    {
        // change the enabled value to false & save.
        $this->page_module->enabled = false;
        $this->page_module->save();

        // redirect to the previous page, previous
        // is relative since it's generally the same
        // page they are currently on.
        $this->redirect(URL::previous());
    }

    /**
     * method that is called to delete a module from
     * a specific page, this will permanently remove
     * the module from the page_modules table.
     * @return void
     */
    public function delete()
    {
        // check if the module is dynamic
        if ($this->page_module->module->dynamic)
        {
            // delete dynamic parameters
            ModuleParameter::where('module_id', '=', $this->page_module->module_id)->where('hash', '=', $this->page_module->hash)->delete();
        }

        // delete the page_modules row
        $this->page_module->delete();

        // redirect to the previous page, previous
        // is relative since it's generally the same
        // page they are currently on.
        $this->redirect(URL::previous());
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        // view to display.
        return view('livewire.core.card-footer');
    }
}
