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
        $about = Module::where('component', '=', 'home.about-card')->first();
        $project = Module::where('component', '=', 'home.project-card')->first();
        $quote = Module::where('component', '=', 'home.quote-card')->first();
        $gallery = Module::where('component', '=', 'photo.gallery-card')->first();
        $grid = Module::where('component', '=', 'photo.photo-grid')->first();

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
    }
}
