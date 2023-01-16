<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticPost extends Model
{
    protected $table = 'statistic_posts';

    protected $fillable = [
        'session_id',
        'module_hash',
        'count',
    ];

    public function statistic_session()
    {
        return $this->hasOne(StatisticSession::class, 'session_id', 'session_id');
    }
}
