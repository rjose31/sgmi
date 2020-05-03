<?php

use App\Carreras;
use Illuminate\Database\Seeder;

class CarrerasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Carreras::create([
            'codigo_carrera' => '000',
            'nombre_carrera' => 'Informática',
        ]);
        Carreras::create([
            'codigo_carrera' => '001',
            'nombre_carrera' => 'Gestión Logística',
        ]);
        Carreras::create([
            'codigo_carrera' => '002',
            'nombre_carrera' => 'Electrónica',
        ]);
        Carreras::create([
            'codigo_carrera' => '003',
            'nombre_carrera' => 'Gestión De Ambiente Y Desarrollo',
        ]);
        Carreras::create([
            'codigo_carrera' => '004',
            'nombre_carrera' => 'Administración De Empresas',
        ]);
        Carreras::create([
            'codigo_carrera' => '005',
            'nombre_carrera' => 'Administracion De La Hospitalidad y El Turismo',
        ]);
        Carreras::create([
            'codigo_carrera' => '006',
            'nombre_carrera' => 'Contaduría Publica y Finanzas',
        ]);
        Carreras::create([
            'codigo_carrera' => '007',
            'nombre_carrera' => 'Derecho',
        ]);
        Carreras::create([
            'codigo_carrera' => '008',
            'nombre_carrera' => 'Diseño Gráfico',
        ]);
        Carreras::create([
            'codigo_carrera' => '009',
            'nombre_carrera' => 'Economía',
        ]);
        Carreras::create([
            'codigo_carrera' => '010',
            'nombre_carrera' => 'Mercadotecnia',
        ]);
        Carreras::create([
            'codigo_carrera' => '011',
            'nombre_carrera' => 'Periodismo',
        ]);
        Carreras::create([
            'codigo_carrera' => '012',
            'nombre_carrera' => 'Psicología',
        ]);
        Carreras::create([
            'codigo_carrera' => '013',
            'nombre_carrera' => 'Recursos Humanos',
        ]);
        Carreras::create([
            'codigo_carrera' => '014',
            'nombre_carrera' => 'Bilingüe En Call Center',
        ]);
        Carreras::create([
            'codigo_carrera' => '015',
            'nombre_carrera' => 'Diseño de Interiores',
        ]);
        Carreras::create([
            'codigo_carrera' => '016',
            'nombre_carrera' => 'Diseño y Desarrollo Web',
        ]);
        Carreras::create([
            'codigo_carrera' => '017',
            'nombre_carrera' => 'Enfermería Auxiliar',
        ]);
        Carreras::create([
            'codigo_carrera' => '018',
            'nombre_carrera' => 'Instalación de Redes',
        ]);
        Carreras::create([
            'codigo_carrera' => '019',
            'nombre_carrera' => 'Instrumentación Quirúrgica',
        ]);
    }
}
