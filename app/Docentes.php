<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Docentes extends Model
{
    use SoftDeletes;
    //

    public function tipo_docente()
    {
        return $this->belongsTo(TipoDocentes::class, 'id_tipo_docente');
    }
}
