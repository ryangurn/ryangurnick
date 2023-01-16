<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\PageType;
use App\Models\PageTypeModule;
use Illuminate\Database\Seeder;

class PageTypeModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $standard = PageType::where('name', 'standard')->first();
        $blog = PageType::where('name', 'blog')->first();
        $post = PageType::where('name', 'post')->first();

        foreach (Module::where('component', 'NOT LIKE', 'blog.%')->get() as $module) {
            PageTypeModule::firstOrCreate([
                'type_id' => $standard->id,
                'module_id' => $module->id,
            ]);
        }

        foreach (Module::where('component', 'LIKE', 'blog.%')->orWhere('component', 'LIKE', 'core.%')->get() as $module) {
            PageTypeModule::firstOrCreate([
                'type_id' => $blog->id,
                'module_id' => $module->id,
            ]);
        }

        foreach (Module::where('component', 'LIKE', 'core.%')->get() as $module) {
            PageTypeModule::firstOrCreate([
                'type_id' => $post->id,
                'module_id' => $module->id,
            ]);
        }
    }
}
