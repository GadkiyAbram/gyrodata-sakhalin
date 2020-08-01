<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersGranted extends Model
{
    public $table = 'User';

    public $primaryKey = 'Id';

    public $incrementing = true;

    public $guarded = [];

    public $timestamps = false;
}
