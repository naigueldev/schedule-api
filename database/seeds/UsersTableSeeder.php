<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert(['id' => 1, 'name' => 'User teste 01']);
        DB::table('users')->insert(['id' => 2, 'name' => 'User teste 02']);
        DB::table('users')->insert(['id' => 3, 'name' => 'User teste 03']);
        DB::table('users')->insert(['id' => 4, 'name' => 'User teste 04']);
        DB::table('users')->insert(['id' => 5, 'name' => 'User teste 05']);
    }
}
