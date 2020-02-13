<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Buyer;
use Faker\Generator as Faker;

$factory->define(Buyer::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->unique()->numberBetween(1,11)
    ];
});
