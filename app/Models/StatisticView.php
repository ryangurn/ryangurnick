<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticView extends Model
{
    protected $table = 'statistic_views';

    protected $fillable = [
        'session_id',
        'page_id',
        'count',
    ];

    public function statistic_session()
    {
        return $this->hasOne(StatisticSession::class, 'session_id', 'session_id');
    }

    public function statistic_page()
    {
        return $this->hasOne(Page::class, 'id', 'page_id');
    }
}
