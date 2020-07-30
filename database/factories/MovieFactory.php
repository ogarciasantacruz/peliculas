<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use Faker\Generator as Faker;
use App\Gender;

$factory->define(Movie::class, function (Faker $faker) {
    
    $gender = Gender::inRandomOrder()->first();

    return [
        'gender_id'     => $gender->id,
        'title'         => $faker->sentence(3),
        'release_date'  => $faker->dateTime,
        'description'   => $faker->text
    ];
});
