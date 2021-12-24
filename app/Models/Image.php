<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'disk',
        'file',
        'hash'
    ];

    public function module()
    {
        return $this->hasOne(Module::class);
    }

    public function getFileAttribute($value)
    {
        return asset('storage/'.$value);
    }
}
