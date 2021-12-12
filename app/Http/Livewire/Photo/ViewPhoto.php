<?php

namespace App\Http\Livewire\Photo;

use App\Models\GalleryImage;
use App\Models\GalleryReaction;
use App\Models\Reaction;
use App\Models\Setting;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ViewPhoto extends ModalComponent
{
    public $page_module;

    public $photo_id;

    public $photo;

    public $updated_at;

    public $reactions;

    public $user_reactions;

    public $allow_reactions;

    public function react(Reaction $reaction)
    {
        $react = GalleryReaction::firstOrNew([
            'gallery_image_id' => $this->photo_id,
            'reaction_id' => $reaction->id,
            'user_id' => auth()->user()->id
        ]);

        if ($react->exists)
        {
            $react->active = !$react->active;
        }
        else
        {
            $react->active = true;
        }

        $react->save();
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
        $this->reactions = Reaction::whereIn('reaction', $allowed_reactions)->where('supported', true)->limit(10)->get();
        $this->user_reactions = GalleryReaction::where('gallery_image_id', $this->photo_id)->get();

        // settings
        $this->allow_reactions = Setting::where('key', 'gallery.allow_reactions')->first()->value;
    }

    public function render()
    {
        return view('livewire.photo.view-photo');
    }
}
