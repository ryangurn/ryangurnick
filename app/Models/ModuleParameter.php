<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class ModuleParameter extends Model
{
    use Compoships;

    protected $table = 'module_parameters';

    protected $fillable = [
        'module_id',
        'parameter',
        'value'
    ];

    public function module()
    {
        return $this->hasOne(Module::class);
    }
}
