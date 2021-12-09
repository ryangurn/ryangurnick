<?php

namespace App\Http\Livewire\Framework;

use App\Models\Image;
use App\Models\Setting;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingsSlideover extends Component
{
    use WithFileUploads;

    protected $listeners = ['show' => 'show', 'hide' => 'hide'];

    public $show = false;

    public $sitename;

    public $sitelogo;

    public $contact_subject;

    public $contact_from;

    public $footer_copyright;

    public $footer_links;

    public $maintenance;

    public function mount()
    {
        $this->sitename = Setting::where('key', '=', 'sitename')->first()->value;
        $this->sitelogo = Setting::where('key', '=', 'application.logo')->first()->value;

        $this->contact_subject = Setting::where('key', '=', 'contact.subject')->first()->value;
        $this->contact_from = Setting::where('key', '=', 'contact.from')->first()->value;

        $this->footer_copyright = Setting::where('key', '=', 'footer.copyright')->first()->value;
        $this->footer_links = collect(Setting::where('key', '=', 'footer.links')->first()->value);

        $this->maintenance = (Setting::where('key', '=', 'maintenance')->first() != null) ? Setting::where('key', '=', 'maintenance')->first()->value : false;
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

    public function check_footer()
    {
        if (count($this->footer_links) == 0)
        {
            $this->add_footer();
        }
    }

    public function add_footer()
    {
        $this->footer_links[] = [
            'type' => 'github',
            'link' => '',
        ];
    }

    public function remove_footer($i)
    {
        unset($this->footer_links[$i]);
        $this->check_footer();
    }

    public function save_footer()
    {
        foreach($this->footer_links as $key => $links)
        {
            if ($links['type'] == '' || $links['link'] == '')
            {
                $this->remove_footer($key);
            }
        }

        $copyright = Setting::where('key', '=', 'footer.copyright')->first();
        $copyright->value = $this->footer_copyright;
        $copyright->save();

        $links = Setting::where('key', '=', 'footer.links')->first();
        $links->value = $this->footer_links;
        $links->save();

        $this->redirect(URL::previous());
    }

    public function save_maintenance()
    {
        $maintenance = Setting::firstOrNew(['key' => 'maintenance']);
        $maintenance->value = $this->maintenance;
        $maintenance->save();

        $this->redirect(URL::previous());
    }

    public function save_sitelogo()
    {
        if ($this->sitelogo != null)
        {
            // get original filename and extract extension
            $filename = explode(".", $this->sitelogo->getFilename());
            $ext = $filename[count($filename)-1];

            // save the file
            $output = $this->sitelogo->storePubliclyAs('img', md5(time()).'.'.$ext, 'public');

            $image = new Image();
            $image->disk = 'public';
            $image->file = $output;
            $image->hash = md5(time());
            $image->save();

            $logo = Setting::where('key', '=', 'application.logo')->first();
            $logo->value = $image->id;
            $logo->save();
        }
        $this->redirect(URL::previous());
    }

    public function render()
    {
        return view('livewire.framework.settings-slideover');
    }
}
