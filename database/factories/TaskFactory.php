<?php

use Faker\Generator as Faker;

$factory->define(\App\Entity\Task::class, function (Faker $faker) {
    return [
        'name_task' => $faker->text(20),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
