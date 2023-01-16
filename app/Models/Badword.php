<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badword extends Model
{
    protected $table = 'badwords';

    protected $fillable = [
        'language',
        'words',
    ];
}
