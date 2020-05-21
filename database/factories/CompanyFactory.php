<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use App\Models\Employee;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    $compName = $faker->company;
    return [
        'name' => $compName,
        'email' => $faker->unique()->safeEmail,
        'logo' => $faker->image("public/".Company::COMPANY_LOGO_PATH, 300, 300, null, false),
        //'logo' => '70f5881bc171325f6c6b100de3d3736d.jpg',
        'website' => "http://demo.". str_replace([" ", "/", "'", "\\", "+", ",", "#", "!"], "", strtolower($compName)) .".co.in",
    ];
});

$factory->define(Employee::class, function (Faker $faker) {
    $companies = Company::select("id")->pluck('id')->toArray();

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'company_id' => $faker->randomElement($companies),
        'phone' => $faker->phoneNumber,
    ];
});
