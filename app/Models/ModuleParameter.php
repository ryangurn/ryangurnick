<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleParameter extends Model
{
    protected $table = 'module_parameters';

    protected $fillable = [
        'module_id',
        'parameter',
        'value',
    ];

    public function module()
    {
        return $this->hasOne(Module::class);
    }
}
