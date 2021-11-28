<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticView extends Model
{
    protected $table = 'statistic_views';

    protected $fillable = [
        'session_id',
        'page_id',
        'count'
    ];
}
