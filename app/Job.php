<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];

    public function battery()
    {
        return $this->hasOne(Battery::class);
    }

//    public function engineers()
//    {
//        return $this->hasMany(Engineer::class);
//    }
}
