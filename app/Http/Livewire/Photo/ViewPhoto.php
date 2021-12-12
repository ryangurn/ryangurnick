<?php

namespace App\Http\Livewire\Photo;

use App\Models\Badword;
use App\Models\GalleryComment;
use App\Models\GalleryImage;
use App\Models\GalleryReaction;
use App\Models\Reaction;
use App\Models\Setting;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ViewPhoto extends ModalComponent
{
    public $page_module;

    public $photo_id;

    public $photo;

    public $updated_at;

    public $show_reactions = false;

    public $active_reaction;

    public $reactions;

    public $user_reactions;

    public $allow_reactions;

    public $allow_comments;

    public $comment;

    public $comments;

    public function react(Reaction $reaction)
    {
        $react = GalleryReaction::firstOrNew([
            'gallery_image_id' => $this->photo_id,
            'user_id' => auth()->user()->id
        ]);

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

        $react->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public function comment()
    {
        $explode = explode(" ", $this->comment);
        foreach($explode as $e)
        {
            $w = preg_replace("#[[:punct:]]#", "", $e);
            if (Badword::where('language', 'en')->where('words', 'LIKE', '%'.$w.'%')->count() > 0)
            {
                $this->closeModal();
                $this->redirect(URL::previous());
                return;
            }
        }
        $comment = new GalleryComment();
        $comment->gallery_image_id = $this->photo_id;
        $comment->user_id = auth()->user()->id;
        $comment->message = $this->comment;
        $comment->save();

        $this->closeModal();
        $this->redirect(URL::previous());
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function mount()
    {
        $this->photo = GalleryImage::where('id', '=', $this->photo_id)->first();
        $this->updated_at = $this->photo->updated_at;

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

    public function render()
    {
        return view('livewire.photo.view-photo');
    }
}
