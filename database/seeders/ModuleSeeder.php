<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use Carbon\Carbon;

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
        // gallery card
        $gallery = Module::firstOrNew([
            'name' => 'Gallery Card',
            'component' => 'photo.gallery-card'
        ]);
        $gallery->parameters = [
            'body' => 'required|string'
        ];
        $gallery->examples = [
            'body' => '<p class="pb-2">This has been a long time coming. Sharing photos is quite important to me, and in a world in which social networks treat their users as the product not the customer it is time to take that control back.</p>

                <p class="pb-2">This photos page is meant to provide some freedom from advertisements, data theft and monitoring from social networks. I hope you will value both the pictures posted here. In addition to the ability to look at my photos without being tracked by anyone. This page is in chronological order with the newest pictures at the top and oldest at the bottom, with no special algorithms.</p>

                <p class="pb-2">This page is a continual work in progress. Please bare with me as I shake out the method to this madness. Once this page is complete, so is my time with instagram.</p>

                <p class="pb-2">I hope you enjoy!</p>'
        ];
        $gallery->save();
        
        // photo grid
        $grid = Module::firstOrNew([
            'name' => 'Photo Grid',
            'component' => 'photo.photo-grid',
        ]);
        $grid->parameters = [
            'photos' => 'required|array',
            'photos.image' => 'required|mimes:jpg,bmp,png',
            'photos.description' => 'nullable|string',
            'photos.location' => 'nullable|string',
            'photos.date' => 'nullable|string',
        ];
        $grid->examples = [
            'photos' => [ 
                [
                    'image' => 'img/1.jpg',
                    'description' => 'this is a testing description for a testing image',
                    'location' => 'a location, california',
                    'date' => Carbon::now()->addDays(-800)
                ]
            ],
        ];
        $grid->save();

        // resume page
        // goals card
        $goals = Module::firstOrNew([
            'name' => 'Goals Card',
            'component' => 'resume.goals-card'
        ]);
        $goals->parameters = [
            'body' => 'required|string'
        ];
        $goals->examples = [
            'body' => 'i am working to further my knowledge in computer science and other computer-related areas in preparation for a career in software development, computer information systems, cybersecurity. over the past couple of years, i have strived to learn the more formal side to computer science, and i wish to continue developing new technologies that find truth in the fundamentals.'
        ];
        $goals->save();

        // skills card
        $skills = Module::firstOrNew([
            'name' => 'Skills Card',
            'component' => 'resume.skills-card'
        ]);
        $skills->parameters = [
            'skills' => 'required|array',
            'skills.skill' => 'required|string',
            'skills.level' => 'required|string',
        ];
        $skills->examples = [
            'skills' => [
                [
                    'skill' => 'html, css, javascript',
                    'level' => 'advanced'
                ],
                [
                    'skill' => 'php',
                    'level' => 'advanced'
                ],
                [
                    'skill' => 'sql based languages',
                    'level' => 'proficient'
                ],
                [
                    'skill' => 'golang',
                    'level' => 'advanced'
                ],
                [
                    'skill' => 'python',
                    'level' => 'advanced'
                ],
                [
                    'skill' => 'c',
                    'level' => 'moderate'
                ],
                [
                    'skill' => 'c#',
                    'level' => 'moderate'
                ],
                [
                    'skill' => 'c++',
                    'level' => 'proficient'
                ],
                [
                    'skill' => 'java',
                    'level' => 'basic'
                ],
                [
                    'skill' => 'ruby',
                    'level' => 'basic'
                ],
                [
                    'skill' => 'powershell & shell scripting',
                    'level' => 'moderate'
                ],
                [
                    'skill' => 'cyber security consulting',
                    'level' => 'advanced'
                ],
                [
                    'skill' => 'wordpress',
                    'level' => 'moderate'
                ],
            ]
        ];
        $skills->save();

        // computer skills card
        $computer_skills = Module::firstOrNew([
            'name' => 'Computer Skills Card',
            'component' => 'resume.computer-skills-card'
        ]);
        $computer_skills->parameters = [
            'skills' => 'required|array',
            'skills.*' => 'required|string'
        ];
        $computer_skills->examples = [
            'skills' => [
                'web design',
                'database development & management',
                'cyber security',
                'penetration testing',
                'continuous integration & implementation automation',
                'setting up and operating sound systems',
            ]
        ];
        $computer_skills->save();
    
        // software card
        $software = Module::firstOrNew([
            'name' => 'Software Card',
            'component' => 'resume.software-card'
        ]);
        $software->parameters = [
            'body' => 'required|string'
        ];
        $software->examples = [
            'body' => 'most development tools for programming, and devops tools.'
        ];
        $software->save();
    }
}
