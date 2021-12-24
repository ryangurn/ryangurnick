<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GalleryReaction;

class Reaction extends Model
{
    protected $table = 'reactions';

    protected $fillable = [
        'reaction',
        'icon',
        'supported'
    ];

    public function getIconAttribute($value)
    {
        return constant(sprintf("%s::%s", "\Spatie\Emoji\Emoji", $value));
    }

    public function gallery_reactions()
    {
        return $this->hasMany(GalleryReaction::class);
    }
}
