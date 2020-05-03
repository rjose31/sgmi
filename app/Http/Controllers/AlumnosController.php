<?php

namespace App\Http\Controllers;

use App\Alumnos;
use App\AlumnosFlujogramas;
use App\CargaAcademica;
use App\Carreras;
use App\DetalleCargaAcademica;
use App\DetalleFlujogramas;
use App\Flujogramas;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class AlumnosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        return view('alumnos.alumnos');
    }

    public function indexInactivos()
    {
        return view('alumnos.alumnos-inactivos');
    }

    public function listaAlumnosActivos()
    {
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Administrador')
        {
            $data = Alumnos::all();
        } else {
            $data = Alumnos::where('id_carrera', '=', auth()->user()->id_carrera)->get();
        }

        $alumnosActivos = [];
        foreach ($data as $d) {
            $al = new Alumnos();
            $al->id = $d->id;
            $al->numero_cuenta = $d->numero_cuenta;
            $al->nombre = $d->nombre;
            $al->telefono = $d->telefono;
            $al->id_carrera = $d->carrera->nombre_carrera;
            $al->id_flujograma = $d->id_flujograma;
            array_push($alumnosActivos, $al);
        }
        return response()->json($alumnosActivos);
    }

    public function listaAlumnosInactivos()
    {
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Administrador')
        {
            $data = Alumnos::onlyTrashed()->get();
        } else {
            $data = Alumnos::onlyTrashed()->where('id_carrera', '=', auth()->user()->id_carrera)->get();
        }

        $alumnosInactivos = [];
        foreach ($data as $d) {
            $al = new Alumnos();
            $al->id = $d->id;
            $al->numero_cuenta = $d->numero_cuenta;
            $al->nombre = $d->nombre;
            $al->telefono = $d->telefono;
            $al->id_carrera = $d->carrera->nombre_carrera;
            array_push($alumnosInactivos, $al);
        }
        return response()->json($alumnosInactivos);
    }

    public function checkNC($cuenta)
    {
        $a = Alumnos::where('numero_cuenta', '=', $cuenta)->get();
        if(count($a) > 0) {
            return response()->json(array('success' => true), 200);
        } else {
            return response()->json(array('success' => false), 200);
        }
    }

    public function checkNCE($id, $cuenta)
    {
        $a = Alumnos::where([['id', '<>', $id], ['numero_cuenta', '=', $cuenta]])->get();
        if(count($a) > 0) {
            return response()->json(array('success' => true), 200);
        } else {
            return response()->json(array('success' => false), 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        $carreras = Carreras::all();
        $flujogramas = Flujogramas::where('id_carrera', '=', auth()->user()->id_carrera)->get();
        return view('alumnos.nuevo-alumno', compact('carreras', 'flujogramas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        $cls = [];
        $alumno = new Alumnos();
        $alumno->numero_cuenta = $request->numero_cuenta;
        $alumno->nombre = $request->nombre;
        $alumno->telefono = $request->telefono;
        $alumno->id_carrera = $request->id_carrera;
        $alumno->id_flujograma = $request->id_flujograma;

        $idFlujograma = $request->id_flujograma;
        if ($alumno->save()) {
            $idAlumno = $alumno->id;
            $flujograma = DetalleFlujogramas::where('id_flujograma', '=', $idFlujograma)->get();
            foreach ($flujograma as $f){
                array_push($cls, '0');
            }
            $cls = implode(',', $cls);
//
//        error_log($cls);
//
            $af = new AlumnosFlujogramas();
            $af->id_alumno = $idAlumno;
            $af->id_flujograma = $idFlujograma;
            $af->clases = $cls;
            if($af->save())
            {
                return response()->json(array('success' => true), 200);
            } else {
                $alumno->forceDelete();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Alumnos $alumnos
     * @return \Illuminate\Http\Response
     */
    public function show(Alumnos $alumnos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        $alumno = Alumnos::findOrFail($id);
        $carreras = Carreras::all();
        $flujogramas = Flujogramas::where('id_carrera', '=', $alumno->id_carrera)->get();
        return view('alumnos.editar-alumno', compact('alumno', 'carreras', 'flujogramas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
        $cls = [];
        $idFlujograma = $request->id_flujograma;
        $ch = false;

        $alumno = Alumnos::findOrFail($id);
        if($alumno->id_flujograma != $idFlujograma)
        {
            $ch = true;
        }
        $alumno->numero_cuenta = $request->numero_cuenta;
        $alumno->nombre = $request->nombre;
        $alumno->telefono = $request->telefono;
        $alumno->id_carrera = $request->id_carrera;
        $alumno->id_flujograma = $request->id_flujograma;

        if($alumno->save())
        {
            if($ch)
            {
                $flujograma = DetalleFlujogramas::where('id_flujograma', '=', $idFlujograma)->get();
                foreach ($flujograma as $f){
                    array_push($cls, '0');
                }
                $cls = implode(',', $cls);

                AlumnosFlujogramas::where('id_alumno', '=', $id)->delete();
                $af = new AlumnosFlujogramas();
                $af->id_alumno = $id;
                $af->id_flujograma = $idFlujograma;
                $af->clases = $cls;
                if($af->save())
                {
                    return response()->json(array('success' => true), 200);
                }
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Alumnos $alumnos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumnos $alumnos)
    {
        //
    }

    public function habilitarAlumno($id)
    {
        $alumno = Alumnos::where('id', '=', $id)->restore();
    }

    public function deshabilitarAlumno($id)
    {
        $alumno = Alumnos::where('id', '=', $id)->delete();
    }

    public function descargarAlumnosActivos() {
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Administrador')
        {
            $alumnos = Alumnos::all();
        } else {
            $alumnos = Alumnos::where('id_carrera', '=', auth()->user()->id_carrera)->get();
        }
        $pdf = PDF::loadView('alumnos.iaa', compact('alumnos'))->setPaper('a4', 'portrait');
        return $pdf->download('alumnos-activos.pdf');
    }

    public function descargarAlumnosInactivos() {
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Administrador')
        {
            $alumnos = Alumnos::onlyTrashed()->get();
        } else {
            $alumnos = Alumnos::onlyTrashed()->where('id_carrera', '=', auth()->user()->id_carrera)->get();
        }
        $alumnos = Alumnos::onlyTrashed()->get();
        $pdf = PDF::loadView('alumnos.iai', compact('alumnos'))->setPaper('a4', 'portrait');
        return $pdf->download('alumnos-inactivos.pdf');
    }
}
