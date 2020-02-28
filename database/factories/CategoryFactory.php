<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $categorias = [
        'Electronica','Hogar y Cocina','Belleza','Deporte',
        'Juguetes', 'Recambios Coche','Equipaje','Libros',        
    ];
    
    return [
        'user_id'=>$faker->numberBetween(10,18),
        'name'=>$faker->unique()->randomElement($categorias),
        'description'=>$faker->text($maxNBChar=150),
    ];
});

    