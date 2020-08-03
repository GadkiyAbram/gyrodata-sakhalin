<?php
/**
 * Created by PhpStorm.
 * User: Aleksandr.Abramovski
 * Date: 16/02/2020
 * Time: 10:07
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function job()
    {
        return $this->belongsToMany(Job::class);
    }
}