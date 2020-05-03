<?php

use App\TipoUsuario;
use Illuminate\Database\Seeder;

class TipoUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipoUsuario::create([
            'tipo_usuario' => 'Administrador'
        ]);
        TipoUsuario::create([
            'tipo_usuario' => 'Coordinador'
        ]);
        TipoUsuario::create([
            'tipo_usuario' => 'Docente'
        ]);
    }
}
