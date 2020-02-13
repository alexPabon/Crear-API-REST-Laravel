<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $productos =['sofa','sofa cama', 'cama Doble','mesa Comedor', 'silla comedor','protector sofa'];
    
    return [
        'name'=>$faker->unique()->randomElement($productos),
        'description'=>$faker->text($maxNbChars = 200),
        'quantity'=>$faker->numberBetween(1,20),
        'status'=>'disponible',
        'seller_id'=>$faker->numberBetween(1,10),        
    ];
});
