<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GalleryImage;
use App\Models\User;

class GalleryComment extends Model
{
    protected $table = 'gallery_comments';

    protected $fillable = [
        'gallery_image_id',
        'user_id',
        'message',
    ];

    public function gallery_image()
    {
        return $this->hasOne(GalleryImage::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
