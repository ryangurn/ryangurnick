<?php

namespace App\Http\Livewire\Framework;

use App\Models\Image;
use App\Models\Setting;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * SettingsSlideover is a livewire component that
 * provides a slideover interface for the user to
 * view and modify system settings. Its aim is to
 * provide a visual method for modifying application
 * settings.
 */
class SettingsSlideover extends Component
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * This component utilizes file uploads.
     */
    use WithFileUploads;

    /**
     * the listeners variable is the livewire method
     * for binding events to a function for use within
     * other livewire components.
     * @var string[]
     */
    protected $listeners = ['show' => 'show', 'hide' => 'hide'];

    /**
     * the variable that when toggled shows and hides the
     * slide over. This variable is entangled with alpine
     * to provide transitions
     * @var bool
     */
    public $show = false;

    /**
     * the variable that stores form input from the sitename
     * input.
     * @var
     */
    public $sitename;

    /**
     * the variable that stores the site logo from the logo
     * input.
     * @var
     */
    public $sitelogo;

    /**
     * the variable that stores the subject for the contact
     * modules email
     * @var
     */
    public $contact_subject;

    /**
     * the variable that stores the from address for the
     * contact modules email
     * @var
     */
    public $contact_from;

    /**
     * the variable that stores the copyright notice
     * for the footer component
     * @var
     */
    public $footer_copyright;

    /**
     * the variable that stores the footer social
     * links for the footer component
     * @var
     */
    public $footer_links;

    /**
     * the variable that stores a boolean denoting weather
     * the application is in maintenance mode.
     * @var
     */
    public $maintenance;

    /**
     * the variable that stores the list of reactions that
     * can be used in the gallery
     * @var
     */
    public $gallery_reactions;

    /**
     * the toggle that denotes weather the application allows
     * reactions on galleries
     * @var
     */
    public $gallery_allow_reactions;

    /**
     * the toggle that denotes weather the application allows
     * comments on galleries.
     * @var
     */
    public $gallery_allow_comments;

    /**
     * the variable that denotes weather badwords are allowed
     * for comments in the gallery
     * @var
     */
    public $gallery_bad_words;

    /**
     * the variable that stores the different search engine
     * indexing settings.
     * @var
     */
    public $robots;

    /**
     * the variable that stores the stored value for search
     * engine indexing settings.
     * @var
     */
    public $robots_current;

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        // getting values and storing them to the component variables
        $this->sitename = Setting::where('key', '=', 'application.sitename')->first()->value;
        $this->sitelogo = Setting::where('key', '=', 'application.logo')->first()->value;

        $this->contact_subject = Setting::where('key', '=', 'contact.subject')->first()->value;
        $this->contact_from = Setting::where('key', '=', 'contact.from')->first()->value;

        $this->footer_copyright = Setting::where('key', '=', 'footer.copyright')->first()->value;
        $this->footer_links = collect(Setting::where('key', '=', 'footer.links')->first()->value);

        $this->maintenance = (Setting::where('key', '=', 'application.maintenance')->first() != null) ? Setting::where('key', '=', 'application.maintenance')->first()->value : false;

        $this->gallery_reactions = implode(",\n", Setting::where('key', 'gallery.reactions')->first()->value);
        $this->gallery_allow_reactions = (Setting::where('key', 'gallery.allow_reactions')->first() != null) ? Setting::where('key', 'gallery.allow_reactions')->first()->value : false;
        $this->gallery_allow_comments = (Setting::where('key', 'gallery.allow_comments')->first() != null) ? Setting::where('key', 'gallery.allow_comments')->first()->value : false;
        $this->gallery_bad_words = (Setting::where('key', 'gallery.bad_words')->first() != null) ? Setting::where('key', 'gallery.bad_words')->first()->value : false;

        $this->robots = collect([
            'all' => ['name' => 'No Restrictions', 'description' => 'There are no restrictions for indexing or serving. This directive is the default value and has no effect if explicitly listed.'],
            'noindex' => ['name' => 'No indexing', 'description' => 'Do not show this page, media, or resource in search results. If you don\'t specify this directive, the page, media, or resource may be indexed and shown in search results.'],
            'nofollow' => ['name' => 'No following links', 'description' => 'Do not follow the links on this page.'],
            'none' => ['name' => 'None', 'description' => 'Equivalent to noindex, nofollow.'],
            'noarchive' => ['name' => 'No caching', 'description' => 'Do not show a cached link in search results.'],
            'nosnippet' => ['name' => 'No snippets', 'description' => 'Do not show a text snippet or video preview in the search results for this page. A static image thumbnail (if available) may still be visible, when it results in a better user experience.'],
            'notranslate' => ['name' => 'No translation', 'description' => 'Don\'t offer translation of this page in search results.'],
            'noimageindex' => ['name' => 'No image indexing', 'description' => 'Do not index images on this page.']
        ]);
        $this->robots_current = Setting::where('key', 'application.index')->first()->value;
    }

    /**
     * this function when called will show the slideover
     * @return void
     */
    public function show()
    {
        $this->show = true;
    }

    /**
     * this function when called will hide the slideover.
     * @return void
     */
    public function hide()
    {
        $this->show = false;
    }

    /**
     * the function that when called will save the site name.
     * @return void
     * @throws AuthorizationException
     */
    public function save_sitename()
    {
        // verify authorization
        $this->authorize('update name settings');

        // save the site name
        $sitename = Setting::firstOrNew(['key' => 'application.sitename']);
        $sitename->value = $this->sitename;
        $sitename->save();

        // redirect to show updated changes
        $this->redirect(URL::previous());
    }

    /**
     * the function that when called will save the contact
     * information.
     * @return void
     * @throws AuthorizationException
     */
    public function save_contact()
    {
        // verify authorization
        $this->authorize('update contact settings');

        // grab the subject setting and update it
        $subject = Setting::where('key', '=', 'contact.subject')->first();
        $subject->value = $this->contact_subject;
        $subject->save();

        // grab the from setting and update it
        $from = Setting::where('key', '=', 'contact.from')->first();
        $from->value = $this->contact_from;
        $from->save();

        // refresh the page
        $this->redirect(URL::previous());
    }

    /**
     * the function that when called will check if
     * the footer links are empty and add one row.
     * @return void
     * @throws AuthorizationException
     */
    public function check_footer()
    {
        if (count($this->footer_links) == 0)
        {
            $this->add_footer();
        }
    }

    /**
     * the function that when called will add
     * a new row to the footer_links array
     * @return void
     * @throws AuthorizationException
     */
    public function add_footer()
    {
        // verify authorization
        $this->authorize('update contact settings');

        // add a new row
        $this->footer_links[] = [
            'type' => 'github',
            'link' => '',
        ];
    }

    /**
     * the function that when called will remove
     * a row from the footer_links array based
     * on the index position $i
     * @param $i
     * @return void
     * @throws AuthorizationException
     */
    public function remove_footer($i)
    {
        // verify authorization
        $this->authorize('update contact settings');

        // unset the index and check if the
        // array is empty
        unset($this->footer_links[$i]);
        $this->check_footer();
    }

    /**
     * the function that when called will save the footer
     * content.
     * @return void
     * @throws AuthorizationException
     */
    public function save_footer()
    {
        // verify authorization
        $this->authorize('update footer settings');

        // loop through each of the footer links and check
        // if the type or link is empty
        foreach($this->footer_links as $key => $links)
        {
            if ($links['type'] == '' || $links['link'] == '')
            {
                // remove any rows that have a type or link that is empty
                $this->remove_footer($key);
            }
        }

        // update and save the footer copyright
        $copyright = Setting::where('key', '=', 'footer.copyright')->first();
        $copyright->value = $this->footer_copyright;
        $copyright->save();

        // update and save the footer links
        $links = Setting::where('key', '=', 'footer.links')->first();
        $links->value = $this->footer_links;
        $links->save();

        // redirect
        $this->redirect(URL::previous());
    }

    /**
     * the function that when called will save
     * the maintenance mode.
     * @return void
     * @throws AuthorizationException
     */
    public function save_maintenance()
    {
        // verify authorization
        $this->authorize('update maintenance settings');

        // update and save the application's maintenance mode.
        $maintenance = Setting::firstOrNew(['key' => 'application.maintenance']);
        $maintenance->value = $this->maintenance;
        $maintenance->save();

        // refresh
        $this->redirect(URL::previous());
    }

    /**
     * the function that when called will save the site logo
     * @return void
     * @throws AuthorizationException
     */
    public function save_sitelogo()
    {
        // verify authorization
        $this->authorize('update logo settings');

        // check if the uploaded image is not null
        // todo: add support for storing images in the database
        if ($this->sitelogo != null)
        {
            // get original filename and extract extension
            $filename = explode(".", $this->sitelogo->getFilename());
            $ext = $filename[count($filename)-1];

            // save the file
            $output = $this->sitelogo->storePubliclyAs('img', md5(time()).'.'.$ext, 'public');

            // save the image
            $image = new Image();
            $image->disk = 'public';
            $image->file = $output;
            $image->hash = md5(time());
            $image->save();

            // update and save the application logo setting
            $logo = Setting::firstOrNew(['key' => 'application.logo']);
            $logo->value = $image->id;
            $logo->save();
        }
        // redirect
        $this->redirect(URL::previous());
    }

    /**
     * the function that when called will save the gallery settings
     * @return void
     * @throws AuthorizationException
     */
    public function save_gallery()
    {
        // verify authorization
        $this->authorize('update gallery settings');

        // update and save the setting allowing reactions for galleries
        $allow_reactions = Setting::firstOrNew(['key' => 'gallery.allow_reactions']);
        $allow_reactions->value = $this->gallery_allow_reactions;
        $allow_reactions->save();

        // update and save the setting that stores the galleries reactions
        $gallery_reactions = Setting::firstOrNew(['key' => 'gallery.reactions']);
        $gallery_reactions->value = explode(",\n", $this->gallery_reactions);
        $gallery_reactions->save();

        // update and save the setting allowing comments for galleries
        $gallery_comments = Setting::firstOrNew(['key' => 'gallery.allow_comments']);
        $gallery_comments->value = $this->gallery_allow_comments;
        $gallery_comments->save();

        // update and save the setting allowing/disallowing bad words in gallery comments
        $gallery_words = Setting::firstOrNew(['key' => 'gallery.bad_words']);
        $gallery_words->value = $this->gallery_bad_words;
        $gallery_words->save();

        // redirect
        $this->redirect(URL::previous());
    }

    /**
     * the function that when called will update the application.index
     * setting
     * @return void
     * @throws AuthorizationException
     */
    public function update_indexing($key)
    {
        // verify authorization
        $this->authorize('update indexing settings');

        // update and save the setting specifying indexing operations
        $allow_reactions = Setting::firstOrNew(['key' => 'application.index']);
        $allow_reactions->value = $key;
        $allow_reactions->save();

        // redirect
        $this->redirect(URL::previous());
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.framework.settings-slideover');
    }
}
