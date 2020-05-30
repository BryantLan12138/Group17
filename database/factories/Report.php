<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;

$factory->define(App\Report::class, function (Faker $faker) {
    return [
        'order_id'=>3,
        'user_id'=>2,
        'car_id'=>1,
        'firstname'=>$faker->name,
        'lastname'=>$faker->name,
        'mobile'=>$faker->phoneNumber,
        'user_address'=>$faker->address
    ];
});
