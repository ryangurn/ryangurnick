<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticImage extends Model
{
    protected $table = 'statistic_images';

    protected $fillable = [
        'session_id',
        'gallery_id',
        'gallery_image_id',
        'count'
    ];

    public function statistic_session()
    {
        return $this->hasOne(StatisticSession::class, 'session_id', 'session_id');
    }
}
