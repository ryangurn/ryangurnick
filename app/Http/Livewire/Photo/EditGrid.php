<?php

namespace App\Http\Livewire\Photo;

use App\Models\Module;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class EditGrid extends ModalComponent
{
    use WithFileUploads;

    public $photo;

    public $index;

    public $image;

    public $module;

    public function mount()
    {
        // set date formatting
        $this->photo['date'] = Carbon::create($this->photo['date'])->toDateString();

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
        if ($this->image != null)
        {
            // get original filename and extract extension
            $filename = explode(".", $this->image->getFilename());
            $ext = $filename[count($filename)-1];

            // save the file
            $output = $this->image->storePubliclyAs('img', md5(time()).'.'.$ext, 'public');

            $value[$this->index]['image'] = $output;
        }

        $value[$this->index]['description'] = $this->photo['description'];
        $value[$this->index]['location'] = $this->photo['location'];
        $value[$this->index]['date'] = new Carbon($this->photo['date']);

        $photo->value = $value;
        $photo->save();

        $this->module->updated_at = Carbon::now();
        $this->module->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.photo.edit-grid');
    }
}
