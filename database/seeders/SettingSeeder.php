<?php

namespace Database\Seeders;

use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $footer_copyright = Setting::firstOrNew([
            'key' => 'footer.copyright'
        ]);
        $footer_copyright->value = 'ryan gurnick';
        $footer_copyright->save();

        $footer_links = Setting::firstOrNew([
            'key' => 'footer.links'
        ]);
        $footer_links->value = [
            [
                'type' => 'github',
                'link' => 'https://github.com/ryangurn'
            ],
            [
                'type' => 'instagram',
                'link' => 'https://www.instagram.com/ryangurnick/'
            ]
        ];
        $footer_links->save();

        $sitename = Setting::firstOrNew([
            'key' => 'sitename'
        ]);
        $sitename->value = 'ryan gurnick';
        $sitename->save();

        $contact_email = Setting::firstOrNew([
            'key' => 'contact.from'
        ]);
        $contact_email->value = 'ryangurnick@gmail.com';
        $contact_email->save();

        $contact_subject = Setting::firstOrNew([
            'key' => 'contact.subject'
        ]);
        $contact_subject->value = 'new contact';
        $contact_subject->save();

        $maintenance = Setting::firstOrNew([
            'key' => 'maintenance'
        ]);
        $maintenance->value = false;
        $maintenance->save();
    }
}
