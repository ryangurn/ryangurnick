<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;
use App\Models\GalleryImage;


class GalleryImage extends Model
{
    protected $table = 'gallery_images';

    protected $fillable = [
        'gallery_id',
        'image_id',
        'caption',
        'date',
        'location',
        'people',
        'visible'
    ];

    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
