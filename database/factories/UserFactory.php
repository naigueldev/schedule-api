<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Http\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
