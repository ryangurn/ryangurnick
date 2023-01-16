<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticDevice extends Model
{
    protected $table = 'statistic_devices';

    protected $fillable = [
        'session_id',
        'browser',
        'browser_version',
        'platform',
        'platform_version',
        'device',
        'desktop',
        'mobile',
        'mobile_bot',
        'tablet',
        'bot',
        'robot',
        'robot_name',
        'languages',
    ];

    protected $casts = [
        'languages' => 'array',
    ];

    public function statistic_session()
    {
        return $this->hasOne(StatisticSession::class, 'session_id', 'session_id');
    }
}
