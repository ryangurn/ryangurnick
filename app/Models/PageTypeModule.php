<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTypeModule extends Model
{
    protected $table = 'page_type_modules';

    public $timestamps = false;

    protected $fillable = [
        'type_id',
        'module_id',
    ];

    public function page_type()
    {
        return $this->hasOne(PageType::class, 'id', 'type_id');
    }

    public function module()
    {
        return $this->hasOne(Module::class, 'id', 'module_id');
    }
}
