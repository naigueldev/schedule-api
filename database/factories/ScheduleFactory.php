<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Http\Models\Schedule;

$factory->define(Schedule::class, function (Faker $faker) {
    
    $date = DateTime::createFromFormat('Y-m-d', date('Y-m-d') );
    $date->modify('+1 day');
    $start_date = $date->format('Y-m-d');
    
    $date = DateTime::createFromFormat('Y-m-d', date('Y-m-d') );
    $date->modify('+10 day');
    $due_date = $date->format('Y-m-d');

    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'start_date' => $start_date,
        'due_date' => $due_date,
        // 'due_date_complete' => "",
        'status_id' => "1",
        'user_id' => "5"
    ];
});
