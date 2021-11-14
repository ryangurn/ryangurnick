<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageNavigation extends Model
{
    protected $table = 'page_navigations';

    protected $fillable = [
        'page_id',
        'name',
        'enabled'
    ];

    public function page()
    {
        return $this->hasOne(Page::class, 'id', 'page_id');
    }
}
