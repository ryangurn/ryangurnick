<?php

namespace Database\Seeders;

use App\Models\Setting;
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
    }
}
