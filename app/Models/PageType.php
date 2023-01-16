<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageType extends Model
{
    protected $table = 'page_types';

    protected $fillable = [
        'name',
        'view',
    ];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function page_type_module()
    {
        $this->hasMany(PageTypeModule::class, 'type_id', 'id');
    }
}
