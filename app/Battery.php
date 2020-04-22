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
            'New' => 'New',
            'Used' => 'Used',
        ];
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
