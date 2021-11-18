<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Page;
use App\Models\PageModule;
use Illuminate\Database\Seeder;

class PageModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // pages
        $home = Page::where('name', '=', 'home')->first();
        $photo = Page::where('name', '=', 'photos')->first();
        $resume = Page::where('name', '=', 'resume')->first();


        // home page modules
        $about_card = Module::where('component', '=', 'home.about-card')->first();
        $project_card = Module::where('component', '=', 'home.project-card')->first();
        $quote_card = Module::where('component', '=', 'home.quote-card')->first();

        // home page create relations
        $about = PageModule::firstOrNew([
            'module_id' => $about_card->id,
            'page_id' => $home->id,
        ]);
        $about->order = 10;
        $about->enabled = true;
        $about->save();

        $project = PageModule::firstOrNew([
            'module_id' => $project_card->id,
            'page_id' => $home->id,
        ]);
        $project->order = 20;
        $project->enabled = true;
        $project->save();

        $quote = PageModule::firstOrNew([
            'module_id' => $quote_card->id,
            'page_id' => $home->id,
        ]);
        $quote->order = 30;
        $quote->enabled = true;
        $quote->save();

        // photo page modules
        $gallery_card = Module::where('component', '=', 'photo.gallery-card')->first();
        $photo_grid = Module::where('component', '=', 'photo.photo-grid')->first();

        // photo page create relations
        $gallery = PageModule::firstOrNew([
            'module_id' => $gallery_card->id,
            'page_id' => $photo->id,
        ]);
        $gallery->order = 10;
        $gallery->enabled = true;
        $gallery->save();

        $photo = PageModule::firstOrNew([
            'module_id' => $photo_grid->id,
            'page_id' => $photo->id,
        ]);
        $photo->order = 20;
        $photo->enabled = true;
        $photo->save();

        // resume page modules
        $goals_card = Module::where('component', '=', 'resume.goals-card')->first();
        $skills_card = Module::where('component', '=', 'resume.skills-card')->first();
        $computer_skills_card = Module::where('component', '=', 'resume.computer-skills-card')->first();
        $software_card = Module::where('component', '=', 'resume.software-card')->first();
        $operating_system_card = Module::where('component', '=', 'resume.operating-system-card')->first();
        $cyber_security_card = Module::where('component', '=', 'resume.cyber-security-card')->first();
        $computer_science_experience_card = Module::where('component', '=', 'resume.computer-science-experience-card')->first();
        $event_services_experience_card = Module::where('component', '=', 'resume.event-services-experience-card')->first();
        $education_card = Module::where('component', '=', 'resume.education-card')->first();
        $committee_work_card = Module::where('component', '=', 'resume.committee-work-card')->first();

        // resume page create relations
        $abt = PageModule::firstOrCreate([
            'module_id' => $about_card->id,
            'page_id' => $resume->id,
        ]);
        $abt->order = 10;
        $abt->enabled = true;
        $abt->save();

        $goals = PageModule::firstOrCreate([
            'module_id' => $goals_card->id,
            'page_id' => $resume->id,
        ]);
        $goals->order = 20;
        $goals->enabled = true;
        $goals->save();

        $skills = PageModule::firstOrCreate([
            'module_id' => $skills_card->id,
            'page_id' => $resume->id,
        ]);
        $skills->order = 30;
        $skills->enabled = true;
        $skills->save();

        $cs_skills = PageModule::firstOrCreate([
            'module_id' => $computer_skills_card->id,
            'page_id' => $resume->id,
        ]);
        $cs_skills->order = 40;
        $cs_skills->enabled = true;
        $cs_skills->save();

        $software = PageModule::firstOrCreate([
            'module_id' => $software_card->id,
            'page_id' => $resume->id,
        ]);
        $software->order = 50;
        $software->enabled = true;
        $software->save();

        $operating = PageModule::firstOrCreate([
            'module_id' => $operating_system_card->id,
            'page_id' => $resume->id,
        ]);
        $operating->order = 60;
        $operating->enabled = true;
        $operating->save();

        $cyber = PageModule::firstOrCreate([
            'module_id' => $cyber_security_card->id,
            'page_id' => $resume->id,
        ]);
        $cyber->order = 70;
        $cyber->enabled = true;
        $cyber->save();

        $cs_experience = PageModule::firstOrCreate([
            'module_id' => $computer_science_experience_card->id,
            'page_id' => $resume->id,
        ]);
        $cs_experience->order = 80;
        $cs_experience->enabled = true;
        $cs_experience->save();

        $es_experience = PageModule::firstOrCreate([
            'module_id' => $event_services_experience_card->id,
            'page_id' => $resume->id,
        ]);
        $es_experience->order = 90;
        $es_experience->enabled = true;
        $es_experience->save();

        $education = PageModule::firstOrCreate([
            'module_id' => $education_card->id,
            'page_id' => $resume->id,
        ]);
        $education->order = 100;
        $education->enabled = true;
        $education->save();

        $committee = PageModule::firstOrCreate([
            'module_id' => $committee_work_card->id,
            'page_id' => $resume->id,
        ]);
        $committee->order = 110;
        $committee->enabled = true;
        $committee->save();
    }
}
