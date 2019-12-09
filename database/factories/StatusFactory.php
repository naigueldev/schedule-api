<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Http\Models\Status;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'name' => 'Não Concluída'
    ];
});
