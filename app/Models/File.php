<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'item_type',
        'item_id',
        'hash',
        'original_name',
        'content',
        'size',
        'mime_type',
        'photo',
    ];

    protected $casts = [
        'photo' => 'boolean',
    ];

    public function item()
    {
        return $this->morphTo();
    }
}
