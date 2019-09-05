<?php

use App\User;
use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    $user = User::all()->random();
    return [
        'nombre' => $faker->firstName(),
        'apellido' => $faker->lastName,
        'avatar' => 'default-avatar.png',
        'sexo' => $faker->randomElement([Cliente::masculino, Cliente::famenino, Cliente::otro]),
        'cedula' => $faker->randomElement(['000-0000000-0', '402-5453423-1']),
        'fechaN' => $faker->date($format = 'd/m/Y', $max = 'now'),
        'celular' => $faker->phoneNumber,
        'tel' => $faker->phoneNumber,
        'vivienda' => $faker->randomElement([Cliente::casap, Cliente::casa_no_propia, Cliente::no_casa]),
        'direccion' => $faker->address,
        'civil' => $faker->randomElement(['soltero', 'casado', 'otro']),
        'empleo' => $faker->randomElement(['si', 'no']),
        'ingreso' => $faker->numberBetween($min = 20000, $max = 50000),
        'referenciaPersonal' => $faker->word,
        'telR' => $faker->phoneNumber,
        'user_id' => $user->id,
    ];
});
