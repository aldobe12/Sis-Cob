<?php

namespace App;

use App\User;
use App\Prestamo;
use Illuminate\Http\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'apellido',
        'sexo',
        'dni',
        'fechaN',
        'telefono',
        'localidad',
        'direccion',
        'estadocivil',
        'user_id',
        'email',
    ];

//    const masculino = 'm';
//    const famenino = 'f';
//    const otro = 'otro';
//    const casap = 'Casa propia';
//    const casa_no_propia = 'Alquilado';
//    const no_casa = 'Otros';

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function localidades()
    {
        return $this->belongsTo('App\Localidad', 'localidad', 'id');
//        return $this->belongsTo(Localidad::class);
    }

    public static function rules()
    {
        return [
//            'nombre' => 'required',
//            'apellido' => 'required',
////            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'sexo' => 'required',
//            'dni' => 'required',
//            'fechaN' => 'required',
//            'direccion' => 'required',
//            'empleo' => 'required',
//            'ingreso' => 'required',
        ];
    }

    public function organizaciones(){
        return $this->belongsTo('App\Organizacion','organizacion_id','id');
    }
}
