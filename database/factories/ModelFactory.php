<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use DeskFlix\Models\Category;
use DeskFlix\Models\Order;
use DeskFlix\Models\Plan;
use DeskFlix\Models\Serie;
use DeskFlix\Models\User;
use DeskFlix\Models\Video;

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(User::class, 'admin', function (Faker\Generator $faker) {

    return [
        'role' => User::ROLE_ADMIN,
    ];
});

$factory->define(Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});

$factory->define(Serie::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence(3),
        'description' =>$faker->sentence(10),
        'thumb' =>'thumb.jpg'
    ];
});

$factory->define(Video::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence(3),
        'description' =>$faker->sentence(10),
        'duration' => rand(1,30),
        'file' =>'file.jpg',
        'thumb' =>'thumb.jpg',
        'completed' => 0,
        'published' => rand(0,1)
    ];
});

$factory->define(Plan::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence(10),
        'value' => $faker->randomFloat(2,50,100),
    ];
});
$factory->state(Plan::class, Plan::DURATION_MONTHLY, function (Faker\Generator $faker) {
    return [
        'duration' => Plan::DURATION_MONTHLY
    ];
});
$factory->state(Plan::class, Plan::DURATION_YEARLY, function (Faker\Generator $faker) {
    return [
        'duration' => Plan::DURATION_YEARLY
    ];
});
$factory->define(Order::class, function (Faker\Generator $faker) {
    return [
        //'code' => str_random(),
        'value' => $faker->randomFloat(2,50,100),
    ];
});