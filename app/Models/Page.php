<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PageModule;
use App\Models\PageType;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = [
        'type_id',
        'title',
        'slug',
        'controller',
        'method',
        'publish_date',
    ];

    public function page_modules()
    {
        return $this->hasMany(PageModule::class);
    }

    public function page_type()
    {
        return $this->hasOne(PageType::class);
    }

    public function page_navigations()
    {
        return $this->hasMany(PageNavigation::class);
    }

}
