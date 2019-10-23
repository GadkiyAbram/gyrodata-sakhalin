<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Battery;
use Faker\Generator as Faker;

$factory->define(Battery::class, function (Faker $faker) {
    return [
        'serialOne' => $faker->numberBetween(100, 999) . '-009SK-AA',
        'serialTwo' => 'N/A',
        'serialThree' => 'N/A',
        'date' => $faker->date('M-Y'),
        'condition' => $faker->numberBetween(0, 1),
        'container' => 'AMD-015-S',
        'comment' => 'Test purpose'
    ];
});
