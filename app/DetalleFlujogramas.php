<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFlujogramas extends Model
{
    //
    protected $fillable = ['codigo_clase', 'nombre_clase', 'estado'];
}
