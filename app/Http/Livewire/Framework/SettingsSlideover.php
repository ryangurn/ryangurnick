<?php

namespace App\Http\Livewire\Framework;

use App\Models\Setting;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class SettingsSlideover extends Component
{
    protected $listeners = ['show' => 'show', 'hide' => 'hide'];

    public $show = false;

    public $sitename;

    public $contact_subject;

    public $contact_from;

    public function mount()
    {
        $this->sitename = Setting::where('key', '=', 'sitename')->first()->value;
        $this->contact_subject = Setting::where('key', '=', 'contact.subject')->first()->value;
        $this->contact_from = Setting::where('key', '=', 'contact.from')->first()->value;
    }

    public function show()
    {
        $this->show = true;
    }

    public function hide()
    {
        $this->show = false;
    }

    public function save_sitename()
    {
        $sitename = Setting::where('key', '=', 'sitename')->first();
        $sitename->value = $this->sitename;
        $sitename->save();

        $this->redirect(URL::previous());
    }

    public function save_contact()
    {
        $subject = Setting::where('key', '=', 'contact.subject')->first();
        $subject->value = $this->contact_subject;
        $subject->save();

        $from = Setting::where('key', '=', 'contact.from')->first();
        $from->value = $this->contact_from;
        $from->save();

        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.framework.settings-slideover');
    }
}
