<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PageModule;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = [
        'title',
        'slug',
        'controller',
        'method',
    ];

    public function page_modules() 
    {
        return $this->hasMany(PageModule::class);
    }
}
