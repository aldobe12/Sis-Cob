<?php

use App\Prestamo;
use Faker\Generator as Faker;

$factory->define(App\Pago::class, function (Faker $faker) {
    $prestamo = Prestamo::all()->random();
    return [
        'capital' => $faker->numberBetween($min = 1000, $max = 10000),
        'fecha_pago' => $faker->date($format = 'd-m-Y', $max = 'now'),
        'mora' => $faker->numberBetween($min = 100, $max = 1000),
        'interes' => $faker->numberBetween($min = 100, $max = 1000),
        'cuota' => $faker->numberBetween($min = 1, $prestamo->cuotas),
        'forma_pago' => $faker->randomElement(['efectivo', 'cheque', 'transferencia']),
        'nota' => $faker->paragraph(1),
        'prestamo_id' => $prestamo->id,
    ];
});
