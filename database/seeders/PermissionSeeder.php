<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // grid
        Permission::firstOrCreate([
            'name' => 'add photo',
        ]);

        Permission::firstOrCreate([
            'name' => 'edit photo',
        ]);

        Permission::firstOrCreate([
            'name' => 'delete photo',
        ]);

        Permission::firstOrCreate([
            'name' => 'react to photo',
        ]);

        Permission::firstOrCreate([
            'name' => 'comment on photo',
        ]);

        Permission::firstOrCreate([
            'name' => 'view photo analytics',
        ]);

        // modules
        $modules = Module::all();

        foreach ($modules as $module) {
            Permission::firstOrCreate([
                'name' => 'edit '.strtolower($module->name),
            ]);

            Permission::firstOrCreate([
                'name' => 'delete '.strtolower($module->name),
            ]);

            Permission::firstOrCreate([
                'name' => 'view '.strtolower($module->name),
            ]);

            Permission::firstOrCreate([
                'name' => 'reorder '.strtolower($module->name),
            ]);
        }

        // framework
        // analytics
        Permission::firstOrCreate([
            'name' => 'view site analytics',
        ]);

        // slideovers
        // configuration
        $configuration_sections = ['application', 'logging', 'database', 'driver', 'memcached', 'redis', 'mail', 'misc', 'file system'];

        foreach ($configuration_sections as $section) {
            Permission::firstOrCreate([
                'name' => 'view '.$section.' information',
            ]);
        }

        // email
        Permission::firstOrCreate([
            'name' => 'view emails',
        ]);

        Permission::firstOrCreate([
            'name' => 'read emails',
        ]);

        // settings
        $configuration_sections = ['maintenance', 'logo', 'name', 'contact', 'gallery', 'footer', 'indexing'];

        foreach ($configuration_sections as $section) {
            Permission::firstOrCreate([
                'name' => 'view '.$section.' settings',
            ]);

            Permission::firstOrCreate([
                'name' => 'update '.$section.' settings',
            ]);
        }

        // moderation
        // comments
        Permission::firstOrCreate([
            'name' => 'remove comment',
        ]);

        Permission::firstOrCreate([
            'name' => 'update comment',
        ]);

        // telescope
        Permission::firstOrCreate([
            'name' => 'access telescope',
        ]);

        // access controls
        Permission::firstOrCreate([
            'name' => 'view access controls',
        ]);

        Permission::firstOrCreate([
            'name' => 'add roles',
        ]);

        Permission::firstOrCreate([
            'name' => 'delete roles',
        ]);

        Permission::firstOrCreate([
            'name' => 'update roles',
        ]);

        Permission::firstOrCreate([
            'name' => 'associate permissions',
        ]);

        // banner
        // page
        Permission::firstOrCreate([
            'name' => 'add page',
        ]);

        Permission::firstOrCreate([
            'name' => 'delete page',
        ]);

        // menu
        Permission::firstOrCreate([
            'name' => 'edit menu',
        ]);

        Permission::firstOrCreate([
            'name' => 'delete menu',
        ]);

        // module
        Permission::firstOrCreate([
            'name' => 'add module',
        ]);

        // gallery
        Permission::firstOrCreate([
            'name' => 'add gallery',
        ]);
    }
}
