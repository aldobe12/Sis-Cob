<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    //
    protected $table = 'localidades';
    public $timestamps = false;

    public function provincias()
    {
        return $this->belongsTo('App\Provincia', 'pronvincia_id', 'id');

    }
}
