<?php

/** @var Factory $factory */

use App\Models\Account;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cnpj' => $faker->creditCardNumber(),
        'address' => $faker->address,
        'cep' => $faker->postcode,
        'manager_id' => \factory(\App\Models\User::class)->create()->id,
        'phone' => $faker->phoneNumber,
    ];
});
