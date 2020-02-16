<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Step;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Step::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence
    ];
});
