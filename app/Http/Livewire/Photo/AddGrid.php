<?php

namespace App\Http\Livewire\Photo;

use App\Models\Module;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddGrid extends ModalComponent
{
    use WithFileUploads;

    public $photo;

    public $image;

    public $module;

    public function mount()
    {
        // grab module
        $this->module = Module::where('component', '=', 'photo.photo-grid')->first();
    }

    public function rules()
    {
        return $this->module->parameters;
    }

    public function save()
    {
        $this->validate();

        $photo = $this->module->module_parameters->where('parameter', '=', 'photos')->first();

        $value = json_decode($photo->value, true);
        $new_position = count($value) + 1;
        $value[$new_position] = [];

        // get original filename and extract extension
        $filename = explode(".", $this->image->getFilename());
        $ext = $filename[count($filename)-1];

        // save the file
        $output = $this->image->storePubliclyAs('img', md5(time()).'.'.$ext, 'public');

        $value[$new_position]['image'] = $output;
        $value[$new_position]['description'] = $this->photo['description'];
        $value[$new_position]['location'] = $this->photo['location'];
        $value[$new_position]['date'] = new Carbon($this->photo['date']);

        $photo->value = $value;
        $photo->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.photo.add-grid');
    }
}
