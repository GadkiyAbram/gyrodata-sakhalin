<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

//    public function job()
//    {
//        return $this->belongsTo(Job::class);
//    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
