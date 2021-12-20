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
        $standard = PageType::firstOrCreate([
            'name' => 'standard',
        ]);

        foreach(Module::where('component', 'NOT LIKE', 'blog.%')->get() as $module)
        {
            PageTypeModule::firstOrCreate([
                'type_id' => $standard->id,
                'module_id' => $module->id
            ]);
        }


        // blog
        $blog = PageType::firstOrCreate([
            'name' => 'blog'
        ]);

        foreach(Module::where('component', 'LIKE', 'blog.%')->orWhere('component', 'LIKE', 'core.%')->get() as $module)
        {
            PageTypeModule::firstOrCreate([
                'type_id' => $blog->id,
                'module_id' => $module->id
            ]);
        }
    }
}
