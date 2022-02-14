<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'name'=>'Cruds',
            'roles_id'=>2,
            'created_user'=>1,
            'icon'=>'fas fa-user-shield'
        ]);
        DB::table('menus')->insert([
            'name'=>'Menu',
            'route'=>'menu.index',
            'menus_id'=>1,
            'roles_id'=>2,
            'created_user'=>1
        ]);
        DB::table('user.index')->insert([
            'name'=>'Usuarios',
            'route'=>'menu.index',
            'menus_id'=>1,
            'roles_id'=>2,
            'created_user'=>1
        ]);
    }
}
