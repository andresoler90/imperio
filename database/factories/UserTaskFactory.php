<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\UserTask;

$factory->define(UserTask::class, function (Faker $faker) {
    return [
        'task_details_id' => \App\Models\TaskDetail::all()->random()->id,
        'users_id'        => \App\User::all()->random()->id,
        'duration'        => $faker->randomNumber(2),
        'created_at'      => $faker->dateTime()
    ];
});
