<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageModule extends Model
{
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
        return $this->hasOne(Page::class, 'id', 'page_id');
    }
}
