<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        //
        'book_id' => rand(100,999),
        'book_name' => $faker->unique()->word,
        'book_description' => 'Lorem Ipsum',
        'stock' => rand(10,20),
        'photo' => "There's a photo in here"
    ];
});
