<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $guarded = [];

    public function job()
    {
        return $this->belongsToMany(Job::class);
    }
}
