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
        foreach($project->parameters as $key => $value) 
        {
            $param = ModuleParameter::firstOrNew([
                'module_id' => $project->id,
                'parameter' => $key,
            ]);
            $param->value = json_encode($project->examples[$key]);
            $param->save();
        }

        // quote card
        foreach($quote->parameters as $key => $value) 
        {
            $param = ModuleParameter::firstOrNew([
                'module_id' => $quote->id,
                'parameter' => $key,
            ]);
            $param->value = json_encode($quote->examples[$key]);
            $param->save();
        }

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

        // photo grid
        $param = ModuleParameter::firstOrNew([
            'module_id' => $grid->id,
            'parameter' => 'photos',
        ]);
        $param->value = json_encode($grid->examples['photos']);
        $param->save();

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

    }
}
