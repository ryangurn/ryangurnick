<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticSession extends Model
{
    protected $table = 'statistic_sessions';

    protected $fillable = [
        'session_id',
        'ip_address',
        'user_agent'
    ];
}
