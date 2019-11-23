<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Work;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Work::class, function (Faker $faker) {

    // per creare dei clienti lanciare in tinker il create factory(App\Work::class,10)->create();

    return [
        'work_type' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'dead_line' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'finished'=>$faker->numberBetween($min = 0, $max = 1),
        'information' => $faker->text($maxNbChars = 200),
    ];
});
