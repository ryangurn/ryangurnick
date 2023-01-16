<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $fillable = [
        'name',
        'description',
    ];

    public function gallery_images()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_id', 'id');
    }
}
