<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use \App\User;

$factory->define(User::class, function (Faker $faker) {

    return [
        'name'         => $faker->name,
        'lastname'     => $faker->lastName,
        'username'     => $faker->userName,
        'sponsor_id'   => \App\User::all()->random()->id,
        'countries_id' => \App\Models\Country::all()->random()->id,
        'email'        => $faker->email,
        'roles_id'     => \App\Models\Role::all()->random()->id,
        'password'     => bcrypt('123456'),
        'created_at'   => $faker->dateTimeBetween('-2 years')
    ];
});
