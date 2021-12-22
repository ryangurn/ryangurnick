<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Image;
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
            'component' => 'home.about-card',
            'edit_component' => 'home.edit.edit-about'
        ]);
        $about->parameters = [
            'name' => 'required|string',
            'body' => 'required|string',
            'image' => 'nullable|image|max:1024',
            'link' => 'nullable|url',
            'link_text' => 'nullable|string|min:3'
        ];
        $about->examples = [
            'name' => 'ryan gurnick',
            'body' => 'I am a technologist who sees the dreams of the world as an opportunity for innovation through machines. Over many years I have worked in various areas to improve my understanding of how technology functions and impacts the world in a meaningful way. I have received a bachelor’s degree in computer information science and computer information technologies while also following my passion for cybersecurity, theatrical productions, and much more. I hope you enjoy my website and learn something new in the process that will spark joy and intrigue in your life.',
            'image' => 'avatar/ryangurnick.jpg',
            'link' => '/photos',
            'link_text' => 'checkout my photos!'
        ];
        $about->permissions = [
              'edit' => 'edit about card',
              'delete' => 'delete about card',
              'view' => 'view about card',
              'reorder' => 'reorder about card',
        ];
        $about->save();

        // project card
        $project = Module::firstOrNew([
            'name' => 'Projects Card',
            'component' => 'home.project-card',
            'edit_component' => 'home.edit.edit-project'
        ]);
        $project->parameters = [
            'projects' => 'required|array',
            'projects.*.project' => 'required|string',
            'projects.*.status' => 'required|string|in:archived,current',
            'projects.*.link' => 'nullable|string|url',
        ];
        $project->examples = [
            'projects' => [
                ['project' => 'cste', 'status' => 'current', 'link' => 'https://github.com/ryangurn/cste'],
                ['project' => 'trackerjacker', 'status' => 'current', 'link' => 'https://github.com/ryangurn/trackerjacker'],
                ['project' => 'fakebank', 'status' => 'current', 'link' => 'https://github.com/ryangurn/fakebank'],
                ['project' => 'regtools', 'status' => 'archived', 'link' => 'https://github.com/ryangurn/regtools'],
                ['project' => 'minicasty', 'status' => 'archived', 'link' => 'https://github.com/ryangurn/minicasty'],
                ['project' => 'emu visitor estimate', 'status' => 'archived'],
            ]
        ];
        $project->permissions = [
            'edit' => 'edit projects card',
            'delete' => 'delete projects card',
            'view' => 'view projects card',
            'reorder' => 'reorder projects card',
        ];
        $project->save();

        // quotes card
        $quotes = Module::firstOrNew([
            'name' => 'Quotes Card',
            'component' => 'home.quote-card',
            'edit_component' => 'home.edit.edit-quote'
        ]);
        $quotes->parameters = [
            'quotes' => 'required|array',
            'quotes.*.author' => 'nullable|string',
            'quotes.*.quote' => 'required|string'
        ];
        $quotes->examples = [
            'quotes' => [
                ['quote' => 'Stay hungry, stay foolish', 'author' => 'steve jobs'],
                ['quote' => 'Just Watch', 'author' => 'ryan gurnick'],
            ]
        ];
        $quotes->permissions = [
            'edit' => 'edit quotes card',
            'delete' => 'delete quotes card',
            'view' => 'view quotes card',
            'reorder' => 'reorder quotes card',
        ];
        $quotes->save();

        // photos page
        // gallery card
        $gallery = Module::firstOrNew([
            'name' => 'Gallery Card',
            'component' => 'photo.gallery-card',
            'edit_component' => 'photo.edit.edit-gallery',
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
        $gallery->permissions = [
            'edit' => 'edit gallery card',
            'delete' => 'delete gallery card',
            'view' => 'view gallery card',
            'reorder' => 'reorder gallery card',
        ];
        $gallery->save();

        // photo grid
        $gall = Gallery::firstOrNew([
            'name' => 'Initial Gallery',
        ]);
        $gall->description = 'This is the initial gallery and was created by the seeder as an example.';
        $gall->save();

        $image = Image::firstOrNew([
            'file' => 'img/1.jpg',
            'disk' => 'local',
        ]);
        $image->hash = md5(time());
        $image->save();

        $gall_image = GalleryImage::firstOrNew([
            'gallery_id' => $gall->id,
        ]);
        $gall_image->image_id = $image->id;
        $gall_image->caption = "What a great example photo";
        $gall_image->visible = true;
        $gall_image->location = "woodland hills, ca";
        $gall_image->people = "none";
        $gall_image->save();

        $grid = Module::firstOrNew([
            'name' => 'Photo Grid',
            'component' => 'photo.photo-grid',
            'edit_component' => 'photo.edit.edit-grid',
        ]);
        $grid->dynamic = true;
        $grid->parameters = [
            'gallery_id' => 'required|numeric|exists:galleries,id'
        ];
        $grid->examples = [
            'gallery_id' => $gall->id
        ];
        $grid->permissions = [
            'edit' => 'edit photo grid',
            'delete' => 'delete photo grid',
            'view' => 'view photo grid',
            'reorder' => 'reorder photo grid',
        ];
        $grid->save();

        // resume page
        // goals card
        $goals = Module::firstOrNew([
            'name' => 'Goals Card',
            'component' => 'resume.goals-card',
            'edit_component' => 'resume.edit.edit-goals',
        ]);
        $goals->parameters = [
            'body' => 'required|string'
        ];
        $goals->examples = [
            'body' => 'i am working to further my knowledge in computer science and other computer-related areas in preparation for a career in software development, computer information systems, cybersecurity. over the past couple of years, i have strived to learn the more formal side to computer science, and i wish to continue developing new technologies that find truth in the fundamentals.'
        ];
        $goals->permissions = [
            'edit' => 'edit goals card',
            'delete' => 'delete goals card',
            'view' => 'view goals card',
            'reorder' => 'reorder goals card',
        ];
        $goals->save();

        // skills card
        $skills = Module::firstOrNew([
            'name' => 'Skills Card',
            'component' => 'resume.skills-card',
            'edit_component' => 'resume.edit.edit-skills',
        ]);
        $skills->parameters = [
            'skills' => 'required|array',
            'skills.*.skill' => 'required|string',
            'skills.*.level' => 'required|string|in:moderate,advanced,proficient,basic',
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
        $skills->permissions = [
            'edit' => 'edit skills card',
            'delete' => 'delete skills card',
            'view' => 'view skills card',
            'reorder' => 'reorder skills card',
        ];
        $skills->save();

        // computer skills card
        $computer_skills = Module::firstOrNew([
            'name' => 'Computer Skills Card',
            'component' => 'resume.computer-skills-card',
            'edit_component' => 'resume.edit.edit-computer-skills',
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
        $computer_skills->permissions = [
            'edit' => 'edit computer skills card',
            'delete' => 'delete computer skills card',
            'view' => 'view computer skills card',
            'reorder' => 'reorder computer skills card',
        ];
        $computer_skills->save();

        // software card
        $software = Module::firstOrNew([
            'name' => 'Software Card',
            'component' => 'resume.software-card',
            'edit_component' => 'resume.edit.edit-software',
        ]);
        $software->parameters = [
            'body' => 'required|string'
        ];
        $software->examples = [
            'body' => 'most development tools for programming, and devops tools.'
        ];
        $software->permissions = [
            'edit' => 'edit software card',
            'delete' => 'delete software card',
            'view' => 'view software card',
            'reorder' => 'reorder software card',
        ];
        $software->save();

        // operating system card
        $operating = Module::firstOrNew([
            'name' => 'Operating System Proficiency Card',
            'component' => 'resume.operating-system-card',
            'edit_component' => 'resume.edit.edit-operating-system',
        ]);
        $operating->parameters = [
            'systems' => 'required|array',
            'systems.*' => 'required|string'
        ];
        $operating->examples = [
            'systems' => [
                'centos',
                'ubuntu',
                'windows',
                'windows server',
                'macos'
            ],
        ];
        $operating->permissions = [
            'edit' => 'edit operating system proficiency card',
            'delete' => 'delete operating system proficiency card',
            'view' => 'view operating system proficiency card',
            'reorder' => 'reorder operating system proficiency card',
        ];
        $operating->save();

        // cyber security card
        $cyber = Module::firstOrNew([
            'name' => 'Cyber Security Card',
            'component' => 'resume.cyber-security-card',
            'edit_component' => 'resume.edit.edit-cyber-security',
        ]);
        $cyber->parameters = [
            'body' => 'required|string'
        ];
        $cyber->examples = [
            'body' => 'advanced penetration testing for computer systems, api’s, infrastructure and operating system level security expert.'
        ];
        $cyber->permissions = [
            'edit' => 'edit cyber security card',
            'delete' => 'delete cyber security card',
            'view' => 'view cyber security card',
            'reorder' => 'reorder cyber security card',
        ];
        $cyber->save();

        // computer science experience card
        $cs_experience = Module::firstOrNew([
            'name' => 'Computer Science Experience Card',
            'component' => 'resume.computer-science-experience-card',
            'edit_component' => 'resume.edit.edit-computer-science-experience',
        ]);
        $cs_experience->parameters = [
            'roles' => 'required|array',
            'roles.*.duration' => 'required|string',
            'roles.*.location' => 'required|string',
            'roles.*.role' => 'required|string',
            'roles.*.company' => 'required|string',
            'roles.*.body' => 'nullable|string'
        ];
        $cs_experience->examples = [
            'roles' => [
                [
                    'duration' => '2021-present',
                    'location' => 'indianapolis, indiana',
                    'role' => 'tech team',
                    'company' => 'fast enterprises',
                    'body' => '',
                ],
                [
                    'duration' => '2020-2021',
                    'location' => 'eugene, oregon',
                    'role' => 'student manager & technician',
                    'company' => 'university of oregon',
                    'body' => 'Worked dual roles, first as a manager of other student workers, second as a student technician to aid in maintaining classroom audio visual equipment and university information services assets.',
                ],
                [
                    'duration' => '2017-2020',
                    'location' => 'remote',
                    'role' => 'employee',
                    'company' => 'apple',
                    'body' => '',
                ],
                [
                    'duration' => '2017',
                    'location' => 'eugene, oregon',
                    'role' => 'grader & learning assistant',
                    'company' => 'university of oregon',
                    'body' => 'Worked alongside computer science department professors to grade for classes such as CIT110, CIT270, CIS399. The course load ranged from simple html, css, & js websites to java based android app development.',
                ],
                [
                    'duration' => '2016-2017',
                    'location' => 'northridge, california',
                    'role' => 'instructor',
                    'company' => 'LAUSD',
                    'body' => 'We developed a library of training resources for high school students to use in training toward a career in cybersecurity.',
                ],
                [
                    'duration' => '2016',
                    'location' => 'westwood, california',
                    'role' => 'programmer',
                    'company' => 'UCLA',
                    'body' => 'During my time at the UCLA Library, we prototyped, developed and attempted to implement a behaviour driven testing model into their development workflow. This included building an extensive test library to test existing functionality as well as a platform to create and implement future tests. Utilised free and open source technology such as Behat, selenium, chromium, gherkin, PHP, Laravel, Jenkins, Github, and Ansible. The project was left unfinished in the hands of the library. <a href="https://github.com/UCLALibrary/Testing-Automation">Source Code</a>',
                ],
                [
                    'duration' => '2015',
                    'location' => 'remote',
                    'role' => 'freelance programmer',
                    'company' => 'elance',
                    'body' => 'Freelance programmer for design and functionality projects',
                ],
                [
                    'duration' => '2013-2016',
                    'location' => 'pomona, california',
                    'role' => 'competition support',
                    'company' => 'wrccdc',
                    'body' => 'Worked as a member of the scoring team to judge the work of the competitors from the perspective of the customer. My job consisted of acting as a service level user via a phone system and inquire about business services.',
                ],
                [
                    'duration' => '2012-2020',
                    'location' => 'remote',
                    'role' => 'associate',
                    'company' => 'net-force',
                    'body' => 'Developed large scale applications for the purposes of cyber security training. This included strategy work to build an entire system from scratch while implementing industry best standards such as developing with the mentality of micro-services',
                ],
                [
                    'duration' => '2011-2013',
                    'location' => 'calabasas, california',
                    'role' => 'technician',
                    'company' => 'malibu tech support',
                    'body' => 'Responsible for setting up machines, building computers, networks, and maintaining a business server; customer service in store and on the phone',
                ],
            ]
        ];
        $cs_experience->permissions = [
            'edit' => 'edit computer science experience card',
            'delete' => 'delete computer science experience card',
            'view' => 'view computer science experience card',
            'reorder' => 'reorder computer science experience card',
        ];
        $cs_experience->save();

        // event services experience
        $es_experience = Module::firstOrNew([
            'name' => 'Event Services Experience Card',
            'component' => 'resume.event-services-experience-card',
            'edit_component' => 'resume.edit.edit-event-services-experience',
        ]);
        $es_experience->parameters = [
            'roles' => 'required|array',
            'roles.*.duration' => 'required|string',
            'roles.*.location' => 'required|string',
            'roles.*.role' => 'required|string',
            'roles.*.company' => 'required|string',
            'roles.*.body' => 'nullable|string'
        ];
        $es_experience->examples = [
            'roles' => [
                [
                    'duration' => '2016-2018',
                    'location' => 'eugene, oregon',
                    'role' => 'technician',
                    'company' => 'university of oregon event services',
                    'body' => 'Serviced the University venues working with large sound systems, lighting systems, and classroom technology. This includes training in large light/sound systems, and industrial automation systems',
                ],
                [
                    'duration' => '2017-2019',
                    'location' => 'eugene, oregon',
                    'role' => 'hand',
                    'company' => 'IATSE 675 (The International Alliance of Theatrical Stage Employees)',
                    'body' => 'Serviced the University venues working with large sound systems, lighting systems, and classroom technology. This includes training in large light/sound systems, and industrial automation systems. This includes extensive work in Matthew Knight Area, Autzen Stadium, Machovsky Center, etc.<br /><br />
                        Calls:<ul class="list-disc pl-2"><li>Jimmy Buffet (Eugene Oregon MKA) Load In/Out</li><li>Trans-Siberian Orchestra (Eugene Oregon MKA) Load In/Out</li><li>Greatful Dead (Eugene Oregon Autzen Stadium) Load Out</li><li>Tim McGraw (Eugene Oregon MKA) Stadium Conversion</li><li>Garth Brooks (Eugene Oregon Autzen Stadium) Load In/Load Out</li></ul>',
                ],
                [
                    'duration' => '2016',
                    'location' => 'van nuys, california',
                    'role' => 'hand',
                    'company' => 'rainbow sound',
                    'body' => 'Responsible for helping to setup and operate 4 clusters of wideline speaker arrays, along with Allen & Heath sound-boards',
                ],
            ]
        ];
        $es_experience->permissions = [
            'edit' => 'edit event services experience card',
            'delete' => 'delete event services experience card',
            'view' => 'view event services experience card',
            'reorder' => 'reorder event services experience card',
        ];
        $es_experience->save();

        // education card
        $education = Module::firstOrNew([
            'name' => 'Education Card',
            'component' => 'resume.education-card',
            'edit_component' => 'resume.edit.edit-education',
        ]);
        $education->parameters = [
            'institutions' => 'required|array',
            'institutions.*.organization' => 'required|string',
            'institutions.*.duration' => 'required|string',
            'institutions.*.body' => 'nullable|string'
        ];
        $education->examples = [
            'institutions' => [
                [
                    'organization' => 'university of oregon',
                    'duration' => '2016-2021',
                    'body' => 'Computer Information Science & Computer Information Technologies',
                ],
                [
                    'organization' => 'pierce college',
                    'duration' => '2014-2016',
                    'body' => 'general studies',
                ],
                [
                    'organization' => 'cal poly pomona',
                    'duration' => '2012-2016',
                    'body' => 'Worked with college level students and security experts to curate training for high school students based on the standards set by NIST, DISA, and US-CERT. Worked alongside industry experts in white hat and black hat security fields at Facebook, Raytheon, and Cisco.',
                ],
                [
                    'organization' => 'taft charter high school',
                    'duration' => '2012-2016',
                    'body' => 'general education',
                ],
                [
                    'organization' => 'cyber patriots',
                    'duration' => '2012-2016',
                    'body' => 'Participant in a program for high school students to learn how to secure networks and computers to prevent hacking and malicious attacks based on national and international standards. The program teaches students cyber security through the use of virtualized systems such as VMWare and other testing software. The goal is to provide a realistic environment where cyber security standards are ignored and learn to secure a vulnerable environment. Semi-finalist in 2013 competition',
                ],
            ]
        ];
        $education->permissions = [
            'edit' => 'edit education card',
            'delete' => 'delete education card',
            'view' => 'view education card',
            'reorder' => 'reorder education card',
        ];
        $education->save();


        // committee work card
        $committee = Module::firstOrNew([
            'name' => 'Committee Work Card',
            'component' => 'resume.committee-work-card',
            'edit_component' => 'resume.edit.edit-committee-work',
        ]);
        $committee->parameters = [
            'institutions' => 'required|array',
            'institutions.*.organization' => 'required|string',
            'institutions.*.position' => 'required|string',
            'institutions.*.duration' => 'required|string',
            'institutions.*.location' => 'nullable|string'
        ];
        $committee->examples = [
            'institutions' => [
                [
                    'organization' => 'erb memorial union',
                    'position' => 'executive representative',
                    'duration' => '2019-2020',
                    'location' => 'eugene, oregon',
                ],
                [
                    'organization' => 'erb memorial union',
                    'position' => 'executive representative',
                    'duration' => '2017-2018',
                    'location' => 'eugene, oregon',
                ],
                [
                    'organization' => 'taft charter high school hiring committee',
                    'position' => 'student representative',
                    'duration' => '2015-2016',
                    'location' => 'woodland hills, california',
                ],
                [
                    'organization' => 'taft charter high school finance commitee',
                    'position' => 'chair',
                    'duration' => '2013-2016',
                    'location' => 'woodland hills, california',
                ],
            ]
        ];
        $committee->permissions = [
            'edit' => 'edit committee work card',
            'delete' => 'delete committee work card',
            'view' => 'view committee work card',
            'reorder' => 'reorder committee work card',
        ];
        $committee->save();

        $text = Module::firstOrNew([
            'name' => 'Text Card',
            'component' => 'core.text-card',
            'edit_component' => 'core.edit.edit-text',
        ]);
        $text->dynamic = true;
        $text->parameters = [
            'body' => 'required|string',
            'header' => 'required|string'
        ];
        $text->examples = [
            'header' => 'text card',
            'body' => 'This is a text card, you can put these anywhere and the content on one is not tied to the content on another!'
        ];
        $text->permissions = [
            'edit' => 'edit text card',
            'delete' => 'delete text card',
            'view' => 'view text card',
            'reorder' => 'reorder text card',
        ];
        $text->save();

        $contact = Module::firstOrNew([
            'name' => 'Contact Card',
            'component' => 'core.contact-card',
            'edit_component' => 'core.edit.edit-contact',
        ]);
        $contact->dynamic = true;
        $contact->parameters = [
            'header' => 'required|string'
        ];
        $contact->examples = [
            'header' => 'contact',
        ];
        $contact->permissions = [
            'edit' => 'edit contact card',
            'delete' => 'delete contact card',
            'view' => 'view contact card',
            'reorder' => 'reorder contact card',
        ];
        $contact->save();

        $header = Module::firstOrNew([
            'name' => 'Header',
            'component' => 'core.header',
            'edit_component' => 'core.edit.edit-header'
        ]);
        $header->dynamic = true;
        $header->parameters = [
            'header' => 'required|string',
            'description' => 'nullable|string',
            'color' => 'required|in:light,dark'
        ];
        $header->examples = [
            'header' => 'welcome!',
            'description' => 'this is a header, what fun!',
            'color' => 'light'
        ];
        $header->permissions = [
            'edit' => 'edit header',
            'delete' => 'delete header',
            'view' => 'view header',
            'reorder' => 'reorder header',
        ];
        $header->save();

        $stats = Module::firstOrNew([
            'name' => 'Stats',
            'component' => 'core.stats',
            'edit_component' => 'core.edit.edit-stats'
        ]);
        $stats->dynamic = true;
        $stats->parameters = [
            'cards' => 'required|array',
            'header' => 'required|string'
        ];
        $stats->examples = [
            'cards' => [
                ['item' => 'Total Subscribers', 'number' => 71897, 'percentage' => false],
                ['item' => 'Avg. Open Rate', 'number' => 58.16, 'percentage' => true],
                ['item' => 'Avg. Click Rate', 'number' => 24.57, 'percentage' => true],
            ],
            'header' => 'demo stats'
        ];
        $stats->permissions = [
            'edit' => 'edit stats',
            'delete' => 'delete stats',
            'view' => 'view stats',
            'reorder' => 'reorder stats',
        ];
        $stats->save();

        $hero = Module::firstOrNew([
            'name' => 'Hero',
            'component' => 'core.hero',
            'edit_component' => 'core.edit.edit-hero'
        ]);
        $hero->dynamic = true;
        $hero->parameters = [
            'header' => 'required|string',
            'body' => 'nullable|string',
            'image' => 'nullable|image',
            'links' => 'nullable'
        ];
        $hero->examples = [
            'header' => 'Hero Section!',
            'body' => 'What a great hero he is!?',
            'image' => 'https://images.unsplash.com/photo-1521737852567-6949f3f9f2b5?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2830&q=80&sat=-100',
            'links' => [['value' => 'click me!', 'link' => 'https://ryangurnick.test/']]
        ];
        $hero->permissions = [
            'edit' => 'edit hero',
            'delete' => 'delete hero',
            'view' => 'view hero',
            'reorder' => 'reorder hero',
        ];
        $hero->save();

        $post = Module::firstOrNew([
            'name' => 'Post',
            'component' => 'blog.post',
            'edit_component' => 'blog.edit.post'
        ]);
        $post->dynamic = true;
        $post->parameters = [
            'title' => 'required|string',
            'body' => 'required|string'
        ];
        $post->examples = [
            'title' => 'My First Post',
            'body' => 'This is my first post and it is wonderful!'
        ];
        $post->permissions = [
            'edit' => 'edit post',
            'delete' => 'delete post',
            'view' => 'view post',
            'reorder' => 'reorder post'
        ];
        $post->save();
    }
}
