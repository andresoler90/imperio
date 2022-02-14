<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\UserBalance::class, function (Faker $faker) {
    return [
        'users_id'     => \App\User::all()->random()->id,
        'amount'       => $faker->numberBetween(-10000, 10000),
        'type'         => $faker->randomElement(["referrals", "balance", "withdrawal", "transfer"]),
        'created_user' => \App\User::all()->random()->id,
        'created_at'   => $faker->dateTimeBetween('-5 years')
    ];
});
