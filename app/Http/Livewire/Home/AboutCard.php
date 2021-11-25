<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class AboutCard extends Component
{
    public $page_module;

    public $name;

    public $image;

    public $body;

    public $link;

    public $linkText;

    public $updated_at;

    public function mount()
    {
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->name = $module->examples['name'];
            $this->body = $module->examples['body'];
            $this->image = $module->examples['image'];
            $this->link = $module->examples['link'];
            $this->linkText = $module->examples['link_text'];
        }
        else
        {
            $this->name = $module->module_parameters->where('parameter', '=', 'name')->first()->value;
            $this->body = $module->module_parameters->where('parameter', '=', 'body')->first()->value;
            $this->image = $module->module_parameters->where('parameter', '=', 'image')->first()->value;
            $this->link = ($module->module_parameters->where('parameter', '=', 'link')->first() != null) ? $module->module_parameters->where('parameter', '=', 'link')->first()->value : null ;
            $this->linkText = ($module->module_parameters->where('parameter', '=', 'link_text')->first() != null) ? $module->module_parameters->where('parameter', '=', 'link_text')->first()->value : null ;
        }

        // updated at
        $this->updated_at = $module->updated_at;

    }

    public function render()
    {
        return view('livewire.home.about-card');
    }
}
