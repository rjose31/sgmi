<?php

namespace App\Http\Controllers;

use App\Alumnos;
use App\AlumnosFlujogramas;
use App\Carreras;
use App\DetalleFlujogramas;
use App\Flujogramas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
//use Barryvdh\Snappy\Facades\SnappyPdf as SPDF;

class FlujogramasController extends Controller
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
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Coordinador')
        {
            $id_carrera = auth()->user()->id_carrera;
            $flujogramas = Flujogramas::where('id_carrera', '=', $id_carrera)->get();
            return view('flujogramas.flujogramas', compact('flujogramas'));
        } else {
            return redirect('/');
        }

    }

    public function listaFlujogramas($id)
    {
        $flujogramas = Flujogramas::where('id_carrera', '=', $id)->get();
        return response()->json($flujogramas);
    }

    public function alumnosFlujogramas($id)
    {
        $alumno = Alumnos::where('id', '=', $id)->get();
        $idFlujograma = $alumno[0]->id_flujograma;
        $carrera = Carreras::where('id', '=', $alumno[0]->id_carrera)->get();
        $carrera = $carrera[0]->nombre_carrera;
        $detalleFlujograma = DetalleFlujogramas::where('id_flujograma', '=', $idFlujograma)->get();
        $alumnoFlujograma = AlumnosFlujogramas::where([['id_alumno', '=', $id], ['id_flujograma', '=', $idFlujograma]])->get();
        $data = array_merge(array($detalleFlujograma), ['1' => explode(',', $alumnoFlujograma[0]->clases)]);
//        echo dd($data);
        return view('flujogramas.flujograma-alumno', compact('alumno', 'carrera', 'data'));
    }

    public function imprimirFlujograma($id)
    {
        $alumno = Alumnos::where('id', '=', $id)->get();
        $idFlujograma = $alumno[0]->id_flujograma;
        $carrera = Carreras::where('id', '=', $alumno[0]->id_carrera)->get();
        $carrera = $carrera[0]->nombre_carrera;
        $detalleFlujograma = DetalleFlujogramas::where('id_flujograma', '=', $idFlujograma)->get();
        $alumnoFlujograma = AlumnosFlujogramas::where([['id_alumno', '=', $id], ['id_flujograma', '=', $idFlujograma]])->get();
        $data = array_merge(array($detalleFlujograma), ['1' => explode(',', $alumnoFlujograma[0]->clases)]);
        return view('flujogramas.imprimir-flujograma-alumno', compact('alumno', 'carrera', 'data'));
    }

    public function printFA($id)
    {
        $count = 0;
        $alumno = Alumnos::where('id', '=', $id)->get();
        $idFlujograma = $alumno[0]->id_flujograma;
        $carrera = Carreras::where('id', '=', $alumno[0]->id_carrera)->get();
        $carrera = $carrera[0]->nombre_carrera;
        $detalleFlujograma = DetalleFlujogramas::where('id_flujograma', '=', $idFlujograma)->get();
        $alumnoFlujograma = AlumnosFlujogramas::where([['id_alumno', '=', $id], ['id_flujograma', '=', $idFlujograma]])->get();
        $data = array_merge(array($detalleFlujograma), ['1' => explode(',', $alumnoFlujograma[0]->clases)]);
////
////        $pdf = PDF::loadView('flujogramas.imprimir-flujograma-alumno', compact('alumno', 'carrera', 'data'))->setOptions(['DOMPDF_ENABLE_CSS_FLOAT' => true]);
////
////        return $pdf->stream();
////        return SPDF::loadView('flujogramas.imprimir-flujograma-alumno')->stream('flujograma.pdf');
//        $pdf = \SPDF::loadView('flujogramas.imprimir-flujograma-alumno', compact('alumno', 'carrera', 'data', 'count'));
////        $pdf->setOption('viewport-size', '1920x1080');
////        $pdf->setOption('dpi', 100);
////        $pdf->setOption('orientation', 'landscape');
//        return $pdf->stream('flujograma.pdf');
        return view('flujogramas.imprimir-flujograma-alumno', compact('alumno', 'carrera', 'data', 'count'));
    }

    public function modificarAlumnoFlujograma(Request $request, $idAlumno, $idFlujograma)
    {
        $cls = [];
        $clases = $request->clases;
        foreach ($clases as $clase) {
            array_push($cls, $clase);
        }
        $cls = implode(',', $cls);

        $idAF = AlumnosFlujogramas::where([['id_alumno', '=', $idAlumno], ['id_flujograma', '=', $idFlujograma]])->get();
        $id = $idAF[0]->id;

        $alumnoFlujograma = AlumnosFlujogramas::findOrFail($id);
        $alumnoFlujograma->clases = $cls;
        if ($alumnoFlujograma->save()) {
            response()->json(array('success' => true), 200);
        }
    }

    public function existe(Request $request)
    {
        $nombreFlujograma = $request->nombre_flujograma;
        $data = Flujogramas::where('nombre', '=', $nombreFlujograma)->get();
        return (count($data) == 0) ? response()->json(array('existe' => 0)) : response()->json(array('existe' => 1));
    }

    public function existeEditar(Request $request, $id)
    {
        $nombreFlujograma = $request->nombre_flujograma;
        $data = Flujogramas::where([['id', '<>', $id], ['nombre', '=', $nombreFlujograma],])->get();
        return (count($data) == 0) ? response()->json(array('existe' => 0)) : response()->json(array('existe' => 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Coordinador')
        {
            return view('flujogramas.nuevo-flujograma');
        } else {
            return redirect('/');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
        $id_carrera = auth()->user()->id_carrera;
        $flujograma = ['nombre' => $request->nombre_flujograma, 'id_carrera' => $id_carrera];
        $codigo_clase = $request->codigo_clase;
        $nombre_clase = $request->nombre_clase;
        $estado = $request->estado;
        $idFlujograma = Flujogramas::insertGetId($flujograma);

        for ($i = 0; $i < count($codigo_clase); $i++) {
            $df = new DetalleFlujogramas();
            $df->id_flujograma = $idFlujograma;
            $df->codigo_clase = ($codigo_clase[$i] !== null) ? $codigo_clase[$i] : '';
            $df->nombre_clase = ($nombre_clase[$i] !== null) ? $nombre_clase[$i] : '';
            $df->estado = $estado[$i];
            $df->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Flujogramas $flujogramas
     * @return void
     */
    public function show(Flujogramas $flujogramas)
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
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Coordinador')
        {
            $nombreFlujograma = Flujogramas::where('id', '=', $id)->get();
            $nombreFlujograma = $nombreFlujograma[0]->nombre;
            $detalleFlujograma = DetalleFlujogramas::where('id_flujograma', '=', $id)->get();
//        echo dd($detalleFlujograma);
            return view('flujogramas.editar-flujograma', compact('nombreFlujograma', 'detalleFlujograma'));
        } else {
            return redirect('/');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //

        $codigo_clase = $request->codigo_clase;
        $nombre_clase = $request->nombre_clase;
        $estado = $request->estado;
        $idDetalle = $request->id_detalle;


        for ($i = 0; $i < count($idDetalle); $i++) {
            error_log($idDetalle[$i]);
//            $df = DetalleFlujogramas::where('id', '=', $idDetalle)->get();
//            error_log($df);
            $df = DetalleFlujogramas::find($idDetalle[$i]);
            $df->codigo_clase = ($codigo_clase[$i] !== null) ? $codigo_clase[$i] : '';
            $df->nombre_clase = ($nombre_clase[$i] !== null) ? $nombre_clase[$i] : '';
            $df->estado = $estado[$i];
            $df->save();
            error_log($df);
        }

        $flujograma = Flujogramas::findOrFail($id);
        $flujograma->nombre = $request->nombre_flujograma;
        $flujograma->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Flujogramas $flujogramas
     * @return void
     */
    public function destroy(Flujogramas $flujogramas)
    {
        //
    }
}
