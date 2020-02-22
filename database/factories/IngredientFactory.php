<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recipe;
use App\Model;
use App\Ingredient;
use Faker\Generator as Faker;

$factory->define(Ingredient::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'recipe_id' => factory(Recipe::class)
    ];
});
