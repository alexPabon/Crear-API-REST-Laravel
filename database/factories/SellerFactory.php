<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Seller;
use Faker\Generator as Faker;

$factory->define(Seller::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->unique()->numberBetween(11,20)
    ];
});
