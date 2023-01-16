<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';

    protected $fillable = [
        'class',
        'to',
        'message',
        'parameters',
        'read',
    ];

    protected $casts = [
        'parameters' => 'collection',
        'read' => 'boolean',
    ];
}
