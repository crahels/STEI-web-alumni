<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'topic' => 'Question for Testing',
        'body' => 'Is This Question One?',
        'is_admin' => 1,
        'member_id' => -1,
        'user_id' => -1
    ];
});
