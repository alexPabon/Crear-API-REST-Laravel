<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $categorias = ['hogar y cocina', 'Electronica','Deporte','Belleza'];
    
    return [
        'name'=>$faker->unique()->randomElement($categorias),
        'description'=>$faker->text($maxNBChar=150),
    ];
});

    