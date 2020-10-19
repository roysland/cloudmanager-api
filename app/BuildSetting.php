<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildSetting extends Model
{
    public function service () {
        return $this->belongsTo('App\Service', 'id', 'service_id');
    }
}
