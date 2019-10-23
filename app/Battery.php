<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    protected $guarded = [];

    public function getConditionOptions($attribute)
    {
        return $this->conditionOptions()[$attribute];
    }

    public function conditionOptions()
    {
        return [
            1 => 'New',
            0 => 'Used',
        ];
    }

    public function job()
    {
        return $this->hasOne(Job::class);
    }
}
