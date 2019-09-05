<?php

namespace App;

use App\Prestamo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'prestamo_id',
        'cuota',
        'fecha_pago',
        'capital',
        'interes',
        'mora',
        'forma_pago',
        'nota',
    ];

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }

    public static function rules()
    {
        return [
            'prestamo_id' => 'required',
            'cuota' => 'required',
            'fecha_pago' => 'required',
            'capital' => 'required',
            'interes' => 'required',
            'forma_pago' => 'required',
        ];
    }
}
