<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $casts = [
        'config' => 'array',
        'repo' => 'array'
    ];
    public function buildSettings () {
        return $this->hasOne('App\BuildSetting', 'id', 'service_id');
    }
}
