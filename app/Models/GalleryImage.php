<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    protected $casts = [
        'date' => 'datetime'
    ];

    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    public function statistic_images()
    {
        return $this->hasMany(StatisticImage::class, 'gallery_image_id', 'id');
    }
}
