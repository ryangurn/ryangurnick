<?php

namespace App\Http\Livewire\Core\Edit;

use App\Models\PageModule;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class EditHero extends ModalComponent
{
    use WithFileUploads;

    public $page_module;

    public $header;

    public $body;

    public $links;

    public $image;

    public function mount()
    {
        $this->module = PageModule::where('id', '=', $this->page_module['id'])->first()->module;
    }

    public function rules()
    {
        $rules = $this->module->parameters;
        $rules['links.*.value'] = 'required|string';
        $rules['links.*.link'] = 'required|url';
        return $rules;
    }

    public function messages()
    {
        $arr = [
            'header.required' => 'header is required',
            'header.string' => 'header must be a string',
            'body.string' => 'body must be a string',
            'image.image' => 'image uploaded must be a jpg, jpeg, png, bmp, gif, svg, or webp file',
        ];

        for ($i = 0; $i < count($this->links); $i++)
        {
            $arr['links.'.$i.'.value.required'] = 'Link Value #'.($i+1).' cannot be blank.';
            $arr['links.'.$i.'.value.string'] = 'Link Value #'.($i+1).' must be a string.';
            $arr['links.'.$i.'.link.required'] = 'Link Location #'.($i+1).' cannot be blank.';
            $arr['links.'.$i.'.link.url'] = 'Link Location #'.($i+1).' must be a url.';
        }

        return $arr;
    }

    public function check()
    {
        $this->messages();
        if (count($this->links) == 0)
        {
            $this->add();
        }
    }

    public function add()
    {
        $this->messages();
        $this->links[] = ['value' => '', 'link' => ''];
    }

    public function remove($i)
    {
        unset($this->links[$i]);
        $this->check();
    }

    public function save()
    {
        $this->validate();

        $header = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'header')->first();
        $body = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'body')->first();
        $links = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'links')->first();
        $image = $this->module->module_parameters->where('hash', '=', $this->page_module['hash'])->where('parameter', '=', 'image')->first();

        if ($this->image != null)
        {
            // get original filename and extract extension
            $filename = explode(".", $this->image->getFilename());
            $ext = $filename[count($filename)-1];

            // save the file
            $output = $this->image->storePubliclyAs('img', md5(time()).'.'.$ext, 'public');

            // save the asset path
            $image->value = $output;
            $image->save();
        }

        $header->value = $this->header;
        $header->save();

        $body->value = $this->body;
        $body->save();

        $links->value = json_encode($this->links);
        $links->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        $this->links = collect($this->links);
        return view('livewire.core.edit.edit-hero');
    }
}
