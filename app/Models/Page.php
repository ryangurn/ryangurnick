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
        'name',
        'controller',
        'method',
        'publish_date',
    ];

    public function page_modules()
    {
        return $this->hasMany(PageModule::class, 'page_id', 'id');
    }

    public function page_type()
    {
        return $this->hasOne(PageType::class, 'id', 'type_id');
    }

    public function page_navigations()
    {
        return $this->hasMany(PageNavigation::class);
    }

    public function statistic_views()
    {
        return $this->hasMany(StatisticView::class, 'page_id', 'id');
    }
}
