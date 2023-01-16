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
            'name' => 'Administrator',
        ]);
        $administrator->givePermissionTo(Permission::all());

        // editor
        $editor = Role::firstOrCreate([
            'name' => 'Editor',
        ]);
        $editor->givePermissionTo(Permission::where('name', 'NOT LIKE', '%settings')
            ->where('name', 'NOT LIKE', '%information')
            ->where('name', 'NOT LIKE', '%emails')
            ->where('name', 'NOT LIKE', '%analytics')
            ->where('name', 'NOT LIKE', '%comment')
            ->where('name', 'NOT LIKE', '%access controls')
            ->where('name', 'NOT LIKE', '%roles')
            ->where('name', 'NOT LIKE', '%permissions')
            ->get());

        // moderator
        $moderator = Role::firstOrCreate([
            'name' => 'Moderator',
        ]);
        $moderator->givePermissionTo(Permission::where('name', 'LIKE', '%comment')
            ->get());
        $moderator->givePermissionTo(Permission::where('name', 'react to photo')->get());
        $moderator->givePermissionTo(Permission::where('name', 'comment on photo')->get());

        // photographer
        $photographer = Role::firstOrCreate([
            'name' => 'Photographer',
        ]);
        $photographer->givePermissionTo(Permission::where('name', 'LIKE', '%photo%')
            ->orWhere('name', 'LIKE', '%gallery%')
            ->get());

        // blogger
        $blogger = Role::firstOrCreate([
            'name' => 'Blogger',
        ]);
        $blogger->givePermissionTo(Permission::where('name', 'react to photo')->get());
        $blogger->givePermissionTo(Permission::where('name', 'comment on photo')->get());

        // standard user
        $user = Role::firstOrCreate([
            'name' => 'User',
        ]);
        $user->givePermissionTo(Permission::where('name', 'react to photo')->get());
        $user->givePermissionTo(Permission::where('name', 'comment on photo')->get());
    }
}
