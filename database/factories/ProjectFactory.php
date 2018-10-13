<?php

use Faker\Generator as Faker;

$factory->define(\App\Entity\Project::class, function (Faker $faker) {
    //$faker->locale = 'ru_RU';
    $faker= \Faker\Factory::create('ru_RU');
    return [
        'name_project' => $faker->company.' '.$faker->companySuffix,
        'active' => $faker->boolean,
    ];
});
