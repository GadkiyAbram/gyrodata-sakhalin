<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];

    public function client()
    {
        return $this->hasOne(Client::class, 'Id');
    }

    public function battery()
    {
        return $this->hasOne(Battery::class, 'Id');
    }

//    public function items()
//    {
//        return $this->hasMany(Item::class, 'Id');
//    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'Id');
    }

    public function engineers()
    {
        return $this->hasMany(Engineer::class, 'Id');
    }
}
