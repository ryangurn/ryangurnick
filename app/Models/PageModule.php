<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;
use App\Models\Page;

class PageModule extends Model
{
    use Compoships;

    protected $table = 'page_modules';

    protected $fillable = [
        'module_id',
        'page_id',
        'hash',
        'order',
        'enabled',
    ];

    public function module()
    {
        return $this->hasOne(Module::class, 'id', 'module_id');
    }

    public function page()
    {
        return $this->hasOne(Page::class);
    }

    public function module_parameters()
    {
        return $this->hasMany(ModuleParameter::class, ['module_id', 'hash'], ['module_id', 'hash']);
    }
}
