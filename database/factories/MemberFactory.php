<?php

use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

$factory->define(App\Member::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'company' => 'none',
        'interest' => 'none',
        'address' => str_random(10),
        'nim' => rand(0, 50000)
    ];
});
