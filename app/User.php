<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'login', 'github_id', 'location', 'name', 'repos_url', 'url', 'avatar', 'access_token'
    ];

    protected $hidden = [
        'access_token'
    ];

    public function services () {
        return $this->hasMany('App\Services', 'user_id', 'id');
    }
}
