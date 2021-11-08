<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // home modules
        // about card
        $about = Module::firstOrNew([
            'name' => 'About Card',
            'component' => 'home.about-card'
        ]);
        $about->parameters = [
            'name' => 'required|string',
            'body' => 'required|string',
            'image' => 'required|mimes:jpg,bmp,png'
        ];
        $about->examples = [
            'name' => 'ryan gurnick',
            'body' => 'I am a technologist who sees the dreams of the world as an opportunity for innovation through machines. Over many years I have worked in various areas to improve my understanding of how technology functions and impacts the world in a meaningful way. I have received a bachelor’s degree in computer information science and computer information technologies while also following my passion for cybersecurity, theatrical productions, and much more. I hope you enjoy my website and learn something new in the process that will spark joy and intrigue in your life.',
            'image' => 'https://ryangurnick.com/wp-content/uploads/2018/12/EJB2a6T9_400x400.jpg'
        ];
        $about->save();

        // project card
        $project = Module::firstOrNew([
            'name' => 'Projects Card',
            'component' => 'home.project-card'
        ]);
        $project->parameters = [
            'projects' => 'required|array:*.project,*.status'
        ];
        $project->examples = [
            'projects' => [
                ['project' => 'cste', 'status' => 'current'],
                ['project' => 'trackerjacker', 'status' => 'current'],
                ['project' => 'fakebank', 'status' => 'current'],
                ['project' => 'regtools', 'status' => 'archive'],
                ['project' => 'minicasty', 'status' => 'archive'],
                ['project' => 'emu visitor estimate', 'status' => 'archive'],
            ]
        ];
        $project->save();

        // quotes card
        $quotes = Module::firstOrNew([
            'name' => 'Quotes Card',
            'component' => 'home.quote-card'
        ]);
        $quotes->parameters = [
            'quotes' => 'required|array:*.quote,*.author'
        ];
        $quotes->examples = [
            'quotes' => [
                ['quote' => 'Stay hungry, stay foolish', 'author' => 'steve jobs'],
                ['quote' => 'Just Watch', 'author' => 'ryan gurnick'],
            ]
        ];
        $quotes->save();

        // photos page
        
    }
}
