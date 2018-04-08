<?php

use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'company' => 'none',
        'interest' => 'none',
        'address' => str_random(10),
        'profile_image' => 'noimage.jpg',
        'nim' => str_random(8)
    ];
});
