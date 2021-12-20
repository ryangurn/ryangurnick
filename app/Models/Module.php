<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PageModule;
use App\Models\ModuleImage;
use App\Models\ModuleParameter;

class Module extends Model
{
    protected $table = 'modules';

    protected $fillable = [
        'name',
        'parameters',
        'dynamic',
        'examples',
        'component',
        'edit_component',
        'permissions'
    ];

    protected $casts = [
        'parameters' => 'array',
        'examples' => 'array',
        'permissions' => 'array'
    ];

    public function page_modules()
    {
        return $this->hasMany(PageModule::class);
    }

    public function module_images()
    {
        return $this->hasMany(ModuleImage::class);
    }

    public function module_parameters()
    {
        return $this->hasMany(ModuleParameter::class);
    }

    public function page_type_module()
    {
        return $this->hasMany(PageTypeModule::class, 'module_id', 'id');
    }
}
