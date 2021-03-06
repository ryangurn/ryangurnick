<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
        * PageTypeSeeder should be first as it is a crucial
        * data point that must exist for pages to be created.
        */
        $this->call(PageTypeSeeder::class);

        /*
        * PageSeeder is next to create the basic pages that
        * need to exist for modules to be associated.
        */
        $this->call(PageSeeder::class);

        /*
         * PageNavigationSeeder will add in the default pages
         * to show them on the main menu of the website.
         */
        $this->call(PageNavigationSeeder::class);

        /*
        * ModuleSeeder needs to be seeded next before adding
        * the modules to a specific page
        */
        $this->call(ModuleSeeder::class);

        /*
         * PageTypeModuleSeeder needs to be seeded in order for
         * the ability to add modules to a page, this is because
         * the form dynamically changes what modules are allowed
         * based on the page type.
         */
        $this->call(PageTypeModuleSeeder::class);

        /*
        * ModuleParameterSeeder sets some parameters before
        * adding modules to pages (mainly for testing purposes)
        */
        $this->call(ModuleParameterSeeder::class);

        /*
         * PageModuleSeeder will generate the associations
         * between pages and modules to seed the relationships.
         */
        $this->call(PageModuleSeeder::class);

        /*
         * SettingSeeder will generate the required settings for
         * the application to properly function.
         */
        $this->call(SettingSeeder::class);

        /*
         * ReactionSeeder will generate the predefined reactions
         * for the gallery to use so users can share their feelings
         * of content.
         */
        $this->call(ReactionSeeder::class);

        /*
         * BadwordSeeder will populate the bad words that are not allowed
         * for use within the system.
         */
        $this->call(BadwordSeeder::class);

        /*
         * PermissionSeeder will populate the permissions that exist for
         * an administrator to assign
         *
         * RoleSeeder will populate the various permission grouping that
         * can be assigned by an administrator
         */
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
