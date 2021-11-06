<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Page;

class PageType extends Model
{
    protected $table = 'page_types';

    protected $fillable = [
        'name'
    ];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
