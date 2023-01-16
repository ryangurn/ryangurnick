<?php

namespace Database\Seeders;

use App\Models\PageType;
use Illuminate\Database\Seeder;

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
        $standard->view = 'page';
        $standard->save();

        // blog
        $blog = PageType::firstOrNew([
            'name' => 'blog',
        ]);
        $blog->view = 'blog';
        $blog->save();

        // post
        $post = PageType::firstOrNew([
            'name' => 'post',
        ]);
        $post->view = 'post';
        $post->save();
    }
}
