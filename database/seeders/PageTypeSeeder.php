<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageType;

class PageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // standard
        $standard = PageType::firstOrNew([
            'name' => 'standard',
        ]);
        $standard->save();

        // gallery
        $gallery = PageType::firstOrNew([
            'name' => 'gallery'
        ]);
        $gallery->save();

        // resume
        $resume = PageType::firstOrNew([
            'name' => 'resume'
        ]);
        $resume->save();
    }
}
