<?php

namespace App\Http\Livewire\Core\Add;

use App\Models\Gallery;
use App\Models\Module;
use App\Models\ModuleParameter;
use App\Models\PageModule;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;
use function view;

class AddGallery extends ModalComponent
{
    public $page_id;

    public $module;

    public $galleries;

    public $gallery_id;

    public $name;

    public $description;

    public $new = false;

    public function rules()
    {
        if (!$this->new) {
            return [
                'name' => 'required|string',
                'description' => 'required|string|min:3'
            ];
        }
        else
        {
            return [
                'gallery_id' => 'required|numeric|exists:galleries,id'
            ];
        }
    }

    public function mount()
    {
        $this->galleries = Gallery::all()->sortBy('name');
        $this->module = Module::where('component', '=', 'photo.photo-grid')->first();
    }

    public function save()
    {
        $this->validate();

        if (!$this->new)
        {
            $gallery = new Gallery();
            $gallery->name = $this->name;
            $gallery->description = $this->description;
            $gallery->save();
        }
        else
        {
            $gallery = Gallery::where('id', '=', $this->gallery_id)->first();
        }

        $order = PageModule::where('page_id', '=', $this->page_id)->orderBy('order', 'desc')->first();
        $new_order = (($order != null) ? $order->order : 0) + 10;

        $page_module = new PageModule();
        $page_module->module_id = $this->module->id;
        $page_module->page_id = $this->page_id;
        $page_module->order = $new_order;
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


        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.core.add.add-gallery');
    }
}
