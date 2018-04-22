<?php

use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

$factory->define(App\Member::class, function (Faker $faker) {
    $email = $faker->unique()->safeEmail;
    return [
        'name' => $faker->name,
        'email' => $email,
        'temp_email' => $email,
        'phone_number' => '08123456789',
        'company' => 'none',
        'interest' => 'none',
        'address' => str_random(10),
        'verified' => 1,
        'nim' => rand(0, 50000)
    ];
});
