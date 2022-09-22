<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        //
        'subject_id' => rand(999,10000),
        'subject' => $faker->unique()->name,
        'description' => $faker->unique()->name,
        'unit' => rand(1,3)
    ];
});
