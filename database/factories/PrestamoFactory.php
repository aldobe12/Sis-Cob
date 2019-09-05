<?php

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(App\Prestamo::class, function (Faker $faker) {
    
    $cliente = Cliente::all()->random();
    $monto = $faker->numberBetween($min = 10000, $max = 100000);
    return [
        'cliente_id' => $cliente->id,
        'amortizacion' => $faker->randomElement(['cuotas fijas', 'disminuir cuotas', 'interes fijo']),
        'monto' => $monto,
        'monto_actual' => $monto,
        'interes' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 10),
        'cuotas' => $faker->numberBetween($min = 3, $max = 48),
        'metodo_pago' => $faker->randomElement(['diario', 'semanal', 'quincenal', 'mensual']),
        'fecha' => $faker->date($format = 'd-m-Y', $max = 'now'),
        'codeudor' => $faker->firstName(),
        'cDireccion' => $faker->phoneNumber,
        'cTelefono' => $faker->phoneNumber,
    ];
});
