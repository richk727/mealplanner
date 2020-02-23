<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'owner_id' => factory(User::class),
        'difficulty_id' => 1
    ];
});
