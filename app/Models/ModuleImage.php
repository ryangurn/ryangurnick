<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleImage extends Model
{
    protected $table = 'module_images';

    protected $fillable = [
        'module_id',
        'image_id',
    ];

    public function module()
    {
        return $this->hasOne(Module::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }
}
