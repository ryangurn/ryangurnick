<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticSession extends Model
{
    protected $table = 'statistic_sessions';

    protected $fillable = [
        'session_id',
        'user_agent'
    ];

    public function statistic_views()
    {
        return $this->hasMany(StatisticView::class, 'session_id', 'session_id');
    }
}
