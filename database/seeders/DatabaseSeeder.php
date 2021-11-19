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
    }
}
