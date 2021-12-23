<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\PageTypeModule;
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
        $standard->view = 'page';
        $standard->save();

        foreach(Module::where('component', 'NOT LIKE', 'blog.%')->get() as $module)
        {
            PageTypeModule::firstOrCreate([
                'type_id' => $standard->id,
                'module_id' => $module->id
            ]);
        }

        // blog
        $blog = PageType::firstOrNew([
            'name' => 'blog'
        ]);
        $blog->view = 'blog';
        $blog->save();

        foreach(Module::where('component', 'LIKE', 'blog.%')->orWhere('component', 'LIKE', 'core.%')->get() as $module)
        {
            PageTypeModule::firstOrCreate([
                'type_id' => $blog->id,
                'module_id' => $module->id
            ]);
        }

        // post
        $post = PageType::firstOrNew([
            'name' => 'post'
        ]);
        $post->view = 'post';
        $post->save();

        foreach(Module::where('component', 'LIKE', 'core.%')->get() as $module)
        {
            PageTypeModule::firstOrCreate([
                'type_id' => $post->id,
                'module_id' => $module->id
            ]);
        }
    }
}
