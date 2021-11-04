<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;
use App\Models\Page;

class PageModule extends Model
{
    protected $table = 'page_modules';

    protected $fillable = [
        'module_id',
        'page_id'
    ];

    public function module() 
    {
        return $this->hasOne(Module::class);
    }

    public function page()
    {
        return $this->hasOne(Page::class);
    }
}