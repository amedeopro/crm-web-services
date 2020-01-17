<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CustomersPassword;
use Faker\Generator as Faker;

$factory->define(CustomersPassword::class, function (Faker $faker) {
    return [
      
              'customer_id' => function(){
                return factory(App\Customer::class)->create()->id;
              },
      
              'url' => $faker->url,
      
              'username' => $faker->userName,

              'password' => $faker->password,

              'host' => $faker->domainName,

              'informations' => $faker->sentence($nbWords = 6, $variableNbWords = true),
      
              'type' => $faker->domainWord,

    ];
});
