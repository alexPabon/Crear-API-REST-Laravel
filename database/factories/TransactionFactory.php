<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'quantity_products'=>$faker->numberBetween(1,5),
        'buyer_id'=>$faker->numberBetween(1,6),
        'product_id'=>$faker->numberBetween(1,6)
    ];
});
