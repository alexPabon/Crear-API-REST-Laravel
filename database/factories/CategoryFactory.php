<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $categorias = ['Juguetes', 'Belleza','Equipaje','Libros'];
    
    return [
        'user_id'=>$faker->numberBetween(10,18),
        'name'=>$faker->unique()->randomElement($categorias),
        'description'=>$faker->text($maxNBChar=150),
    ];
});

    