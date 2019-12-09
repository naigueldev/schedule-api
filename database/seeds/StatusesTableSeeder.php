<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->delete();
        DB::table('statuses')->insert(['id' => 1, 'name' => 'Não Concluída']);
        DB::table('statuses')->insert(['id' => 2, 'name' => 'Concluída']);
    }
}
