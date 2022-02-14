<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use \App\Models\UserMultilevel;

$factory->define(UserMultilevel::class, function (Faker $faker) {

    //Me devuelve los usuarios que aun tienen espacios vacios dentro del binario
    $sql = "SELECT *
        FROM users u LEFT JOIN (
            SELECT um.parent_users_id,COUNT(u.id) cantidad
            FROM users u, user_multilevels um
            WHERE u.id=um.users_id
            GROUP BY um.parent_users_id
        ) parents ON u.id=parents.parent_users_id
        WHERE cantidad IS NULL";

    $results = collect(DB::select(DB::raw($sql)));

    //consulto los que aun no han sido asignados al binario
    $sql2 = "	SELECT u.*
        FROM users u, user_multilevels um
        WHERE u.id != um.users_id
        AND u.id != um.parent_users_id
        GROUP BY u.id";
    $results2 = collect(DB::select(DB::raw($sql2)));
    if (count($results2) && count($results)) {
        return [
            "users_id"        => $results2->random()->id,
            "parent_users_id" => $results->random()->id,
            "position"        => $faker->randomElement(['D','I']),
        ];
    }
});
