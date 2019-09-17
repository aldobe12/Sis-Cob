<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FechasCobro extends Model
{
    protected $table = 'fechas_cobro';
    public $timestamps = false;
    //
    public function Pagos(){
            return $this->belongsTo('App\Pago', 'id', 'fecha_cobro_id');
    }
    public function Estados(){
        return $this->belongsTo('App\EstadoCuota', 'estadocuota_id', 'id');
    }
    public function Prestamo(){
        return $this->belongsTo('App\Prestamo', 'prestamo_id', 'id')->first();
    }
    public function Prestamo2(){
        return $this->belongsTo('App\Prestamo', 'prestamo_id', 'id');
    }
}
