<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function buildSettings () {
        return $this->hasOne('App\BuildSetting', 'id', 'service_id');
    }
}
