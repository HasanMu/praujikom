<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function user()
    {
        return $this->hasMany('App\User', 'district_id');
    }

    public function post()
    {
        return $this->hasMany('App\Post', 'district_id');
    }
}
