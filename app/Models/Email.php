<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';

    protected $fillable = [
        'to',
        'message',
        'parameters',
    ];

    protected $casts = [
        'parameters' => 'collection'
    ];
}
