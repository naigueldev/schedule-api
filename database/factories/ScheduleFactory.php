<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Http\Models\Schedule;

$factory->define(Schedule::class, function (Faker $faker) {
    
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'start_date' => $faker->dateTimeBetween($startDate = '+1 days', $endDate = '+5 days'),
        'due_date' => $faker->dateTimeBetween($startDate = '+5 days', $endDate = '+20 days'),
        'status_id' => "1",
        'user_id' => "1"
    ];
});
