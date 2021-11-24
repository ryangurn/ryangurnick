<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\ModuleParameter;

class ModuleParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get modules
        // home page
        $about = Module::where('component', '=', 'home.about-card')->first();
        $project = Module::where('component', '=', 'home.project-card')->first();
        $quote = Module::where('component', '=', 'home.quote-card')->first();

        // photos page
        $gallery = Module::where('component', '=', 'photo.gallery-card')->first();
        $grid = Module::where('component', '=', 'photo.photo-grid')->first();

        // resume page
        $goals = Module::where('component', '=', 'resume.goals-card')->first();
        $skills = Module::where('component', '=', 'resume.skills-card')->first();
        $computer_skills = Module::where('component', '=', 'resume.computer-skills-card')->first();
        $software = Module::where('component', '=', 'resume.software-card')->first();
        $operating = Module::where('component', '=', 'resume.operating-system-card')->first();
        $cyber = Module::where('component', '=', 'resume.cyber-security-card')->first();
        $cs_experience = Module::where('component', '=', 'resume.computer-science-experience-card')->first();
        $es_experience = Module::where('component', '=', 'resume.event-services-experience-card')->first();
        $edu = Module::where('component', '=', 'resume.education-card')->first();
        $com = Module::where('component', '=', 'resume.committee-work-card')->first();

        // about card
        foreach($about->parameters as $key => $value)
        {
            $param = ModuleParameter::firstOrNew([
                'module_id' => $about->id,
                'parameter' => $key,
            ]);
            $param->value = $about->examples[$key];
            $param->save();
        }

        // project card
        $projects = ModuleParameter::firstOrNew([
            'module_id' => $project->id,
            'parameter' => 'projects',
        ]);
        $projects->value = json_encode($project->examples['projects']);
        $projects->save();

        // quote card
        $quute = ModuleParameter::firstOrNew([
            'module_id' => $quote->id,
            'parameter' => 'quotes',
        ]);
        $quute->value = json_encode($quote->examples['quotes']);
        $quute->save();


        // gallery card
        foreach($gallery->parameters as $key => $value)
        {
            $param = ModuleParameter::firstOrNew([
                'module_id' => $gallery->id,
                'parameter' => $key,
            ]);
            $param->value = json_encode($gallery->examples[$key]);
            $param->save();
        }

        // goals card
        foreach($goals->parameters as $key => $value)
        {
            $param = ModuleParameter::firstOrNew([
                'module_id' => $goals->id,
                'parameter' => $key,
            ]);
            $param->value = json_encode($goals->examples[$key]);
            $param->save();
        }

        // skills card
        $skill = ModuleParameter::firstOrNew([
            'module_id' => $skills->id,
            'parameter' => 'skills',
        ]);
        $skill->value = json_encode($skills->examples['skills']);
        $skill->save();

        // computer skills card
        $computer_skill = ModuleParameter::firstOrNew([
            'module_id' => $computer_skills->id,
            'parameter' => 'skills',
        ]);
        $computer_skill->value = json_encode($computer_skills->examples['skills']);
        $computer_skill->save();

        // software card
        foreach($goals->parameters as $key => $value)
        {
            $param = ModuleParameter::firstOrNew([
                'module_id' => $software->id,
                'parameter' => $key,
            ]);
            $param->value = json_encode($software->examples[$key]);
            $param->save();
        }

        // operating system card
        $system = ModuleParameter::firstOrNew([
            'module_id' => $operating->id,
            'parameter' => 'systems',
        ]);
        $system->value = json_encode($operating->examples['systems']);
        $system->save();

        // cyber security card
        foreach($cyber->parameters as $key => $value)
        {
            $param = ModuleParameter::firstOrNew([
                'module_id' => $cyber->id,
                'parameter' => $key,
            ]);
            $param->value = json_encode($cyber->examples[$key]);
            $param->save();
        }

        // computer science experience card
        $cs_exp = ModuleParameter::firstOrNew([
            'module_id' => $cs_experience->id,
            'parameter' => 'roles',
        ]);
        $cs_exp->value = json_encode($cs_experience->examples['roles']);
        $cs_exp->save();

        // event services experience card
        $es_exp = ModuleParameter::firstOrNew([
            'module_id' => $es_experience->id,
            'parameter' => 'roles',
        ]);
        $es_exp->value = json_encode($es_experience->examples['roles']);
        $es_exp->save();

        // event services experience card
        $education = ModuleParameter::firstOrNew([
            'module_id' => $edu->id,
            'parameter' => 'institutions',
        ]);
        $education->value = json_encode($edu->examples['institutions']);
        $education->save();

        // event services experience card
        $committee = ModuleParameter::firstOrNew([
            'module_id' => $com->id,
            'parameter' => 'institutions',
        ]);
        $committee->value = json_encode($com->examples['institutions']);
        $committee->save();
    }
}
