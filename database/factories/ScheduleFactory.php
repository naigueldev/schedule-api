<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Http\Models\Schedule;

$factory->define(Schedule::class, function (Faker $faker) {
    
    $start_date = $faker->dateTime('next Monday')->format('d/m/Y H:i:s');
    $start = $faker->dateTime('next Monday');
    $due_date = $faker->dateTime($start->format('Y-m-d H:i:s').' +4 day')->format('d/m/Y H:i:s');

    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'start_date' => $start_date,
        'due_date' => $due_date,
        'status_id' => "1",
        'user_id' => "1"
    ];
});
