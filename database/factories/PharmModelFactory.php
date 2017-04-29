<?php
$factory->define(App\Schedule::class, function (Faker\Generator $faker) {
    return [
        'days' => "1111110",
        'opening_time' => '08:00',
        'closing_time' => '22:00',
        'pharmacy_id'  => $faker->numberBetween(1,50)

    ];
});

$factory->define(App\Favorite::class, function (Faker\Generator $faker) {
    return [
        'pharmacy_id'  => $faker->numberBetween(1,50),
        'user_id'  => $faker->numberBetween(1,10)

    ];
});

$factory->define(App\Address::class, function (Faker\Generator $faker) {

    $names = $faker->streetName;
    $lng = $faker->longitude;
    $lat = $faker->latitude;

    return [
        'user_id'  => $faker->numberBetween(1,10),
        'name'     => $names,
        'longitude' => $lng,
        'latitude' => $lat
    ];
});


