<?php

use Illuminate\Database\Seeder;

class MembershipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('memberships')->insert([
            'id'          => 1,
            'name'        => '$100 no Roi',
            'type'        => 'membership',
            'cap'        => 0,
            'description' => '',
            'amount'      => 400,
            'amount_type' => "USD",
        ]);
        DB::table('memberships')->insert([
            'id'          => 2,
            'name'        => '$500 CAP $1000',
            'type'        => 'membership',
            'cap'        => 1000,
            'description' => '',
            'amount'      => 500,
            'amount_type' => "USD",
        ]);
        DB::table('memberships')->insert([
            'id'          => 3,
            'name'        => '$1000 CAP $2000',
            'type'        => 'membership',
            'cap'        => 2000,
            'description' => '',
            'amount'      => 1000,
            'amount_type' => "USD",
        ]);
        DB::table('memberships')->insert([
            'id'          => 4,
            'name'        => '$3000 CAP $6000',
            'type'        => 'membership',
            'cap'        => '6000',
            'description' => '',
            'amount'      => 3000,
            'amount_type' => "USD",
        ]);
        DB::table('memberships')->insert([
            'id'          => 5,
            'name'        => '$5000 CAP $10000',
            'type'        => 'membership',
            'cap'        => 10000,
            'description' => '',
            'amount'      => 5000,
            'amount_type' => "USD",
        ]);
        DB::table('memberships')->insert([
            'id'          => 6,
            'name'        => '$10000 CAP $20000',
            'type'        => 'membership',
            'cap'        => 20000,
            'description' => '',
            'amount'      => 10000,
            'amount_type' => "USD",
        ]);

        DB::table('memberships')->insert([
            'id'          => 7,
            'name'        => '$15000 CAP $25000',
            'type'        => 'membership',
            'cap'        => 25000,
            'description' => '',
            'amount'      => 15000,
            'amount_type' => "USD",
        ]);
        DB::table('memberships')->insert([
            'id'          => 8,
            'name'        => '$25000 CAP $35000',
            'type'        => 'membership',
            'cap'        => 35000,
            'description' => '',
            'amount'      => 25000,
            'amount_type' => "USD",
        ]);
        DB::table('memberships')->insert([
            'id'          => 9,
            'name'        => '$50000 CAP $50000',
            'type'        => 'membership',
            'cap'        => 50000,
            'description' => '',
            'amount'      => 50000,
            'amount_type' => "USD",
        ]);
    }
}
