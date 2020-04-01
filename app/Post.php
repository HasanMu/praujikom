<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function district()
    {
        return $this->belongsTo('App\District', 'district_id');
    }
}
