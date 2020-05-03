<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CargaAcademica extends Model
{

    //
    public function carrera()
    {
        return $this->belongsTo(Carreras::class, 'id_carrera');
    }
}
