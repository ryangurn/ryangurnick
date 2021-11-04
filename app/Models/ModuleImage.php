<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class ModuleImage extends Model
{
    protected $table = 'module_images';

    protected $fillable = [
        'module_id',
        'disk',
        'file',
        'hash'
    ];

    public function module()
    {
        return $this->hasOne(Module::class);
    }
}