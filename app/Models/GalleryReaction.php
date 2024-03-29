<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryReaction extends Model
{
    protected $table = 'gallery_reactions';

    protected $fillable = [
        'gallery_image_id',
        'user_id',
        'reaction_id',
        'active',
    ];

    public function gallery_image()
    {
        return $this->hasOne(GalleryImage::class);
    }

    public function reaction()
    {
        return $this->hasOne(Reaction::class, 'id', 'reaction_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
