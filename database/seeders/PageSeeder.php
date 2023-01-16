<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

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
        $home->controller = 'App\Http\Controllers\PageController';
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
        $gallery->controller = 'App\Http\Controllers\PageController';
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
        $resume->controller = 'App\Http\Controllers\PageController';
        $resume->method = 'index';
        $resume->publish_date = Carbon::now();
        $resume->save();
    }
}
