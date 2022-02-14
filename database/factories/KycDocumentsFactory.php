<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use \App\Models\KycDocument;

$factory->define(KycDocument::class, function (Faker $faker) {
    return [
        'users_id'     => \App\User::all()->random()->id,
        'kyc_types_id' => \App\Models\KycType::all()->random()->id,
        'approved_id'  => \App\User::all()->random()->id,
        'comment'      => $faker->text,
        'file'         => 'file.pdf',
        'status'       => $faker->randomElement(["0", "1", "2"]),
        'created_at'   => $faker->dateTime()
    ];
});
