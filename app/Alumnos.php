<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumnos extends Model
{
    use SoftDeletes;
    //

    public function carrera()
    {
        return $this->belongsTo(Carreras::class, 'id_carrera');
    }
}
