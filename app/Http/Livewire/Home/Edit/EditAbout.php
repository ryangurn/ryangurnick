<?php

namespace App\Http\Livewire\Home\Edit;

use App\Models\Module;
use App\Models\ModuleParameter;
use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class EditAbout extends ModalComponent
{
    use WithFileUploads;

    public $page_module;

    public $name;

    public $body;

    public $link;

    public $link_text;

    public $image;

    public $module;

    public function mount()
    {
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
    }

    public function rules()
    {
        return $this->module->parameters;
    }

    public function save()
    {
        $this->validate();
        // grab module parameters and update
        $name = $this->module->module_parameters->where('parameter', '=', 'name')->first();
        $body = $this->module->module_parameters->where('parameter', '=', 'body')->first();
        $image = $this->module->module_parameters->where('parameter', '=', 'image')->first();
        $link = $this->module->module_parameters->where('parameter', '=', 'link')->first();
        $linkText = $this->module->module_parameters->where('parameter', '=', 'link_text')->first();

        if ($this->image != null)
        {
            // get original filename and extract extension
            $filename = explode(".", $this->image->getFilename());
            $ext = $filename[count($filename)-1];

            // save the file
            $output = $this->image->storePubliclyAs('avatar', md5(time()).'.'.$ext, 'public');

            // save the asset path
            $image->value = $output;
            $image->save();
        }

        $name->value = $this->name;
        $name->save();

        $body->value = $this->body;
        $body->save();

        if ($link == null)
        {
            $linkParam = new ModuleParameter();
            $linkParam->module_id = $this->module->id;
            $linkParam->parameter = 'link';
            $linkParam->value = $this->link;
            $linkParam->save();
        }
        else
        {
            $link->value = $this->link;
            $link->save();
        }

        if ($linkText == null)
        {
            $linkTextParam = new ModuleParameter();
            $linkTextParam->module_id = $this->module->id;
            $linkTextParam->parameter = 'link_text';
            $linkTextParam->value = $this->link_text;
            $linkTextParam->save();
        }
        else
        {
            $linkText->value = $this->link_text;
            $linkText->save();
        }

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.home.edit.edit-about');
    }
}
