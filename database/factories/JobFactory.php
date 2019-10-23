<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'jobNumber' => 'RU' . $faker->numberBetween(100, 999) . 'GWD' . $faker->numberBetween(1, 100),
        'toolNumber' => 'G0' . $faker->numberBetween(100, 999),
        'modemNumber' => 'G0' . $faker->numberBetween(100, 999),
        'bbpNumber' => 'S1-0163-' . $faker->numberBetween(1000, 9999),
        'firstEng' => 'Aleksandr Abramovskii',
        'container' => 'AMD-0' . $faker->numberBetween(10, 99) . '-S',
        'toolCircHrs' => '23,4',
        'comment' => 'Test Job Log'
    ];
});
