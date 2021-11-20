<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageNavigation;
use Illuminate\Database\Seeder;

class PageNavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // pages
        $home_page = Page::where('name', '=', 'home')->first();
        $photo_page = Page::where('name', '=', 'photos')->first();
        $resume_page = Page::where('name', '=', 'resume')->first();

        // add navigation menus
        $home = PageNavigation::firstOrNew([
            'page_id' => $home_page->id,
            'name' => null,
        ]);
        $home->enabled = true;
        $home->save();

        $photo = PageNavigation::firstOrNew([
            'page_id' => $photo_page->id,
            'name' => null,
        ]);
        $photo->enabled = true;
        $photo->save();

        $resume = PageNavigation::firstOrNew([
            'page_id' => $resume_page->id,
            'name' => null,
        ]);
        $resume->enabled = true;
        $resume->save();
    }
}
