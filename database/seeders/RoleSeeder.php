<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // administrator
        $administrator = Role::firstOrCreate([
            'name' => 'Administrator'
        ]);
        $administrator->givePermissionTo(Permission::all());

        // editor
        $editor = Role::firstOrCreate([
            'name' => 'Editor'
        ]);
        $editor->givePermissionTo(Permission::where('name', 'NOT LIKE', '%settings')
            ->where('name', 'NOT LIKE', '%information')
            ->where('name', 'NOT LIKE', '%emails')
            ->where('name', 'NOT LIKE', '%analytics')
            ->where('name', 'NOT LIKE', '%comment')
            ->get());

        // moderator
        $moderator = Role::firstOrCreate([
            'name' => 'Moderator'
        ]);
        $moderator->givePermissionTo(Permission::where('name', 'LIKE', '%comment')
            ->get());

        // photographer
        $photographer = Role::firstOrCreate([
            'name' => 'Photographer'
        ]);
        $photographer->givePermissionTo(Permission::where('name', 'LIKE', '%photo%')
            ->orWhere('name', 'LIKE', '%gallery%')
            ->get());

        // blogger
        $blogger = Role::firstOrCreate([
            'name' => 'Blogger'
        ]);
    }
}
