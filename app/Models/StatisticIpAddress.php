<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticIpAddress extends Model
{
    protected $table = 'statistic_ip_addresses';

    protected $fillable = [
        'session_id',
        'ip_address'
    ];

    public function statistic_session()
    {
        return $this->hasOne(StatisticSession::class, 'session_id', 'session_id');
    }
}
