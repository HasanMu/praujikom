<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function user()
    {
        return $this->hasMany('App\User', 'city_id');
    }

    public function post()
    {
        return $this->hasMany('App\Post', 'city_id');
    }
}
