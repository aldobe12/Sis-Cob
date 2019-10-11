<?php

namespace App;

use App\Pago;
use App\Cliente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestamo extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'cliente_id',
        'amortizacion',
        'monto',
        'monto_actual',
        'interes',
        'cuotas',
        'metodo_pago',
        'fecha',
        'codeudor',
        'cDireccion',
        'cTelefono',
        'user_id'
    ];

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function fechascobro(){
        return $this->belongsTo('App\FechasCobro', 'id', 'prestamo_id');
    }
    public function cliente2(){
        return $this->belongsTo('App\Cliente', 'cliente_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function rules()
    {
        return [
            'cliente_id' => 'required',
            'amortizacion' => 'required',
            'monto' => 'required',
            'interes' => 'required',
            'cuotas' => 'required',
            'metodo_pago' => 'required',
            'fecha' => 'required',
            'codeudor' => 'required',
            'cDireccion' => 'required',
            'cTelefono' => 'required',
        ];
    }
}
