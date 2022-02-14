<?php

use Illuminate\Database\Seeder;
use \App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'         => 'Administrador',
            'lastname'     => 'Local',
            'username'     => 'Admin',
            'email'        => 'admin@local.com',
            'countries_id' => '43',
            'roles_id'     => 1,
            'password'     => bcrypt('123456'),
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

       // factory(\App\User::class, 200)->create();
    }
}
