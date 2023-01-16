<?php

namespace App\Http\Livewire\Core\Add;

use App\Models\Gallery;
use App\Models\Module;
use App\Models\ModuleParameter;
use App\Models\PageModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;
use function view;

/**
 * AddGallery is a livewire modal component that
 * provides an interface to create a new gallery
 * or add a previous gallery to a specific page.
 * Its aim is to provide a simple method for adding
 * galleries to pages.
 */
class AddGallery extends ModalComponent
{
    /**
     * the variable that stores the current page
     * for use when the gallery is added.
     *
     * @var
     */
    public $page_id;

    /**
     * the variable that stores the module that
     * will be added.
     *
     * @var
     */
    public $module;

    /**
     * the variable that stores all the gallery
     * models used in the view.
     *
     * @var
     */
    public $galleries;

    /**
     * the variable that the selected gallery will
     * be stored to.
     *
     * @var
     */
    public $gallery_id;

    /**
     * the variable that a new gallery name is
     * stored to
     *
     * @var
     */
    public $name;

    /**
     * the variable that a new gallery description
     * is stored to.
     *
     * @var
     */
    public $description;

    /**
     * the toggle that stores if the user wants to
     * create a new one or utilizing a previous
     * gallery.
     *
     * @var bool
     */
    public $new = false;

    /**
     * validation rules that will be checked when the
     * add gallery modal is saved.
     *
     * @return string[]
     */
    public function rules()
    {
        if (! $this->new) {
            return [
                'name' => 'required|string',
                'description' => 'required|string|min:3',
            ];
        } else {
            return [
                'gallery_id' => 'required|numeric|exists:galleries,id',
            ];
        }
    }

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        $this->galleries = Gallery::all()->sortBy('name');
        $this->module = Module::where('component', '=', 'photo.photo-grid')->first();
    }

    /**
     * the function that when called will
     * add the gallery to a page.
     *
     * @return void
     */
    public function save()
    {
        // validate the data for saving
        $this->validate();

        // if the gallery is new
        if (! $this->new) { // todo: fix the new boolean to be properly handled.
            // add the new gallery.
            $gallery = new Gallery();
            $gallery->name = $this->name;
            $gallery->description = $this->description;
            $gallery->save();
        } else {
            // use the gallery that already exists
            $gallery = Gallery::where('id', '=', $this->gallery_id)->first();
        }

        // determine the order for the new module based on all other modules on the page.
        $order = PageModule::where('page_id', '=', $this->page_id)->orderBy('order', 'desc')->first();
        $new_order = (($order != null) ? $order->order : 0) + 10;

        // add the page module.
        $page_module = new PageModule();
        $page_module->module_id = $this->module->id;
        $page_module->page_id = $this->page_id;
        $page_module->order = $new_order;
        // handle the dynamic nature of the gallery module parameters
        if ($this->module->dynamic) {
            $hash = md5(time());
            $page_module->hash = $hash;

            $param = new ModuleParameter();
            $param->module_id = $this->module->id;
            $param->parameter = 'gallery_id';
            $param->hash = $hash;
            $param->value = $gallery->id;
            $param->save();
        }
        $page_module->save();

        // close and redirect the modal.
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
        return view('livewire.core.add.add-gallery');
    }
}
