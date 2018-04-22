<?php

use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {
    return [
        'rating' => 0,
        'body' => 'Answer for Testing',
        'is_admin' => 1,
        'member_id' => -1,
        'is_pinned' => 0
    ];
});
