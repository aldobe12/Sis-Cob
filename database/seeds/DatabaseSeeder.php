<?php

use App\Pago;
use App\User;
use App\Cliente;
use App\Prestamo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Cliente::truncate();
        Prestamo::truncate();
        Pago::truncate();

        factory(User::class, 1)->create()->each(
            function($u) {
                $u->clientes()->saveMany(factory(Cliente::class, 5)->create()->each(
                    function($cliente) {
                        $cliente->prestamos()->saveMany(factory(Prestamo::class, 1)->create()->each(
                            function($prestamo) {
                                $prestamo->pagos()->saveMany(factory(Pago::class, 5)->make());
                            }
                        ));
                    }
                ));
            }
        );
    }
}
