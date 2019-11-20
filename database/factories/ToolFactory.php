<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tool;
use Faker\Generator as Faker;

$factory->define(Tool::class, function (Faker $faker) {
    return [
        'tool_type' => 'GWD Gyro Section',
        'tool_number' => 'G0' . $faker->numberBetween(100, 999),
        'tool_circHrs' => $faker->numberBetween(10, 100),
        'tool_comment' => 'Test Tool Log'
    ];
});
