<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\PageType;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get page types
        $standard = PageType::where('name', 'standard')->first();
        $gallery = PageType::where('name', 'gallery')->first();
        $resume = PageType::where('name', 'resume')->first();

        // home
        $home = Page::firstOrNew([
            'type_id' => $standard->id,
            'title' => 'home',
            'slug' => '/',
        ]);
        $home->name = 'home';
        $home->controller = 'App\Http\Controllers\HomeController';
        $home->method = 'index';
        $home->publish_date = Carbon::now();
        $home->save();

        // gallery
        $gallery = Page::firstOrNew([
            'type_id' => $standard->id,
            'title' => 'photos',
            'slug' => '/photos',
        ]);
        $gallery->name = 'photos';
        $gallery->controller = 'App\Http\Controllers\PhotoController';
        $gallery->method = 'index';
        $gallery->publish_date = Carbon::now();
        $gallery->save();

        // resume
        $resume = Page::firstOrNew([
            'type_id' => $standard->id,
            'title' => 'resume',
            'slug' => '/resume',
        ]);
        $resume->name = 'resume';
        $resume->controller = 'App\Http\Controllers\ResumeController';
        $resume->method = 'index';
        $resume->publish_date = Carbon::now();
        $resume->save();
    }
}
