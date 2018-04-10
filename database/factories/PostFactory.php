<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => 'Post for Testing',
        'body' => 'Post Body',
        'user_id' => '0',
        'cover_image' => 'noimage.jpg'
    ];
});
