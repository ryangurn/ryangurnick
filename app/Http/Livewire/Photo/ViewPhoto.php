<?php

namespace App\Http\Livewire\Photo;

use App\Models\Badword;
use App\Models\GalleryComment;
use App\Models\GalleryImage;
use App\Models\GalleryReaction;
use App\Models\Reaction;
use App\Models\Setting;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use LivewireUI\Modal\ModalComponent;

/**
 * ViewPhoto is a livewire modal component that provides
 * the ability to view just a single photo in a gallery.
 */
class ViewPhoto extends ModalComponent
{
    /**
     * Provide authorization functionality for permissions
     * verification.
     */
    use AuthorizesRequests;

    /**
     * the page_module model reference that will be
     * used as a reference to update the page_modules
     * table.
     * @var
     */
    public $page_module;

    /**
     * the value that stores the photo identifier.
     * @var
     */
    public $photo_id;

    /**
     * the value that stores the photo model.
     * @var
     */
    public $photo;

    /**
     * the value that stores the last time the module was
     * updated.
     * @var
     */
    public $updated_at;

    /**
     * the boolean that denotes if reactions should be
     * displayed.
     * @var bool
     */
    public $show_reactions = false;

    /**
     * the value that stores reactions that are already
     * associated with the image.
     * @var
     */
    public $active_reaction;

    /**
     * the value that stores acceptable reactions
     *
     * limited to 10 in the mount function
     * @var
     */
    public $reactions;

    /**
     * the value that stores all user reactions
     * that are associated with the given photo.
     * @var
     */
    public $user_reactions;

    /**
     * the boolean value that denotes if reactions
     * are allowed.
     * @var
     */
    public $allow_reactions;

    /**
     * the boolean value that denotes if comments
     * are allowed.
     * @var
     */
    public $allow_comments;

    /**
     * the value that stores new comments from the
     * comment submission form.
     * @var
     */
    public $comment;

    /**
     * the array that stores all comments on a
     * specific image.
     * @var
     */
    public $comments;

    /**
     * the function that when called will add or update
     * a reaction for the given image.
     * @param Reaction $reaction
     * @return void
     * @throws AuthorizationException
     */
    public function react(Reaction $reaction)
    {
        $this->authorize('react to photo');

        // grab the first reaction that meets the criteria
        // or create a new instance of the model
        $react = GalleryReaction::firstOrNew([
            'gallery_image_id' => $this->photo_id,
            'user_id' => auth()->user()->id
        ]);

        // if the reaction exists then negate the current
        // active value.
        // if the reaction does not exist then set the
        // reaction identifier and set it to active.
        if ($react->exists)
        {
            if ($react->reaction_id == $reaction->id)
            {
                $react->active = !$react->active;
            }
            else
            {
                $react->reaction_id = $reaction->id;
                $react->active = true;
            }
        }
        else
        {
            $react->reaction_id = $reaction->id;
            $react->active = true;
        }
        // save the reaction, if new then create the row.
        $react->save();

        // close the modal and refresh
        $this->closeModal();
        $this->redirect(URL::previous());
    }

    /**
     * this function when called will add a comment
     * to the specific image being viewed.
     * @return void
     * @throws AuthorizationException
     */
    public function comment()
    {
        $this->authorize('comment on photo');

        // verify that there are no bad-words present.
        $explode = explode(" ", $this->comment);
        foreach($explode as $e)
        {
            $w = preg_replace("#[[:punct:]]#", "", $e);
            if (Badword::where('language', 'en')->where('words', 'LIKE', '%'.$w.'%')->count() > 0)
            {
                // todo: display and error rather than closing and refrehsing
                $this->closeModal();
                $this->redirect(URL::previous());
                return;
            }
        }
        // add a gallery comment
        $comment = new GalleryComment();
        $comment->gallery_image_id = $this->photo_id;
        $comment->user_id = auth()->user()->id;
        $comment->message = $this->comment;
        $comment->save();

        // close the modal and refresh.
        $this->closeModal();
        $this->redirect(URL::previous());
    }

    /**
     * modalMaxWidth sets the maximum width for the modal
     * this needed to be set for the photo to display
     * properly.
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    /**
     * function that is called when the livewire component is
     * initialized.
     * @return void
     */
    public function mount()
    {
        // grab the photo and set the updated_at timestamp
        $this->photo = GalleryImage::where('id', '=', $this->photo_id)->first();
        $this->updated_at = $this->photo->updated_at;

        // get the rest of the local parameters and set them.
        $allowed_reactions = Setting::where('key', 'gallery.reactions')->first()->value;
        $this->reactions = Reaction::whereIn('reaction', $allowed_reactions)
            ->where('supported', true)
            ->limit(10)
            ->get();
        $this->user_reactions = GalleryReaction::where('gallery_image_id', $this->photo_id)
            ->where('active', true)
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();
        $this->comments = GalleryComment::where('gallery_image_id', $this->photo_id)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        // if authenticated get all the active reaction for the given user.
        if (auth()->check())
        {
            $this->active_reaction = GalleryReaction::where('gallery_image_id', $this->photo_id)
                ->where('active', true)
                ->where('user_id', auth()->user()->id)
                ->first();
        }

        // settings
        $this->allow_reactions = Setting::where('key', 'gallery.allow_reactions')->first()->value;
        $this->allow_comments = Setting::where('key', 'gallery.allow_comments')->first()->value;
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.photo.view-photo');
    }
}
