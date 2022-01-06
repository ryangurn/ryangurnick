<?php

namespace Database\Seeders;

use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Footer copyright is the text content that gets placed on the site's footer
         */
        $footer_copyright = Setting::firstOrNew([
            'key' => 'footer.copyright'
        ]);
        $footer_copyright->value = 'ryan gurnick';
        $footer_copyright->save();

        /*
         * Footer links are the social/business icons that get placed on the site's footer
         */
        $footer_links = Setting::firstOrNew([
            'key' => 'footer.links'
        ]);
        $footer_links->value = [
            [
                'type' => 'github',
                'link' => 'https://github.com/ryangurn'
            ],
            [
                'type' => 'instagram',
                'link' => 'https://www.instagram.com/ryangurnick/'
            ]
        ];
        $footer_links->save();

        /*
         * Application site name is the name of teh website that gets placed in the header & browser tab title.
         */
        $sitename = Setting::firstOrNew([
            'key' => 'application.sitename'
        ]);
        $sitename->value = 'ryan gurnick';
        $sitename->save();

        /*
         * Contact from is the email address that is used for sending emails
         */
        $contact_email = Setting::firstOrNew([
            'key' => 'contact.from'
        ]);
        $contact_email->value = 'ryangurnick@gmail.com';
        $contact_email->save();

        /*
         * Contact subject is the subject that all contact module emails include.
         */
        $contact_subject = Setting::firstOrNew([
            'key' => 'contact.subject'
        ]);
        $contact_subject->value = 'new contact';
        $contact_subject->save();

        /*
         * Maintenance is setting for toggling if the site is in maintenance mode.
         */
        $maintenance = Setting::firstOrNew([
            'key' => 'application.maintenance'
        ]);
        $maintenance->value = false;
        $maintenance->save();

        /*
         * Application logo is the site logo to be displayed in the header and authentication pages
         */
        $site_logo = Setting::firstOrNew([
            'key' => 'application.logo'
        ]);
        if ($site_logo->value == "")
        {
            $site_logo->value = '';
        }
        $site_logo->save();

        /*
         * Gallery reactions is the list of reactions that is shown on the gallery image popup.
         */
        $gallery_reactions = Setting::firstOrNew([
            'key' => 'gallery.reactions'
        ]);
        $gallery_reactions->value = ['GrinningFace','SmilingFaceWithHearts','ExpressionlessFace','ThumbsUp','CowboyHatFace','SmilingFaceWithSunglasses','AstonishedFace','PleadingFace','FlushedFace'];
        $gallery_reactions->save();

        /*
         * Gallery allow reactions toggles if reactions are accepted for a given gallery.
         */
        $gallery_allow_reactions = Setting::firstOrNew([
            'key' => 'gallery.allow_reactions'
        ]);
        $gallery_allow_reactions->value = true;
        $gallery_allow_reactions->save();

        /*
         * Gallery bad words toggles if comments are validated for inappropriate content.
         */
        $gallery_validate_bad_words = Setting::firstOrNew([
            'key' => 'gallery.bad_words'
        ]);
        $gallery_validate_bad_words->value = true;
        $gallery_validate_bad_words->save();

        /*
         * Allow comments allows for toggling if comments are allowed for all galleries.
         */
        $gallery_allow_comments = Setting::firstOrNew([
            'key' => 'gallery.allow_comments'
        ]);
        $gallery_allow_comments->value = true;
        $gallery_allow_comments->save();

        /*
         * Allow the website to be indexed by search engines
         */
        $indexing = Setting::firstOrNew([
            'key' => 'application.index'
        ]);
        $indexing->value = "all";
        $indexing->save();
    }
}
