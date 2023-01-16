<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'disk',
        'file',
        'hash',
    ];

    public function module()
    {
        return $this->hasOne(Module::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'item');
    }

    public function getFileAttribute($value)
    {
        return asset('storage/'.$value);
    }
}
