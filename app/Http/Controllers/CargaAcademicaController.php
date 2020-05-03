<?php

namespace App\Http\Controllers;

use App\CargaAcademica;
use App\DetalleFlujogramas;
use App\DetalleCargaAcademica;
use App\Flujogramas;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class CargaAcademicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Coordinador') {
            return view('carga-academica.cargas-academicas');
        } else {
            return redirect()->to('/');
        }
    }

    public function lista()
    {
        $data = CargaAcademica::where('id_carrera', '=', auth()->user()->id_carrera)->get();
        $cargaAcademica = [];
        foreach($data as $d) {
            $ca = new CargaAcademica();
            $ca->id = $d->id;
            $ca->periodo = $d->periodo;
            $ca->id_carrera = $d->carrera->nombre_carrera;
            array_push($cargaAcademica, $ca);
        }
        return response()->json($cargaAcademica);
    }

    public function info($id)
    {
        $cargaAcademica = CargaAcademica::where('id', '=', $id)->get();
        $detalleCargaAcademica = DetalleCargaAcademica::where('id_carga_academica', '=', $id)->get();
//        echo dd($detalleCargaAcademica);
        return view('carga-academica.info-carga', compact('cargaAcademica', 'detalleCargaAcademica'));
    }

    public function imprimir($id)
    {
        $cargaAcademica = CargaAcademica::where('id', '=', $id)->get();
        $detalleCargaAcademica = DetalleCargaAcademica::where('id_carga_academica', '=', $id)->get();
        return view('carga-academica.imprimir-carga', compact('cargaAcademica', 'detalleCargaAcademica'));
    }

    public function clases($id)
    {
        $clases = [];
        $flujograma = DetalleFlujogramas::where('id_flujograma', '=', $id)->get();

        foreach ($flujograma as $f) {
            if($f->estado == 1) {
                array_push($clases, ['id' => $f->id, 'clase' => $f->nombre_clase]);
            }
        }
        return response()->json($clases);
    }

    public function revisarClase(Request $request)
    {
//        $clases = DetalleCargaAcademica::where([['', '', ''], ['', '', ''], ['', '', '']])->get();
//        $count = count($clases);
//        if(count > 0) {
//
//        }
    }

    public function revisarCantidad()
    {
        $id = auth()->user()->cantidad_clases;
        return response()->json(['count' => $id]);
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
            $idCarrera = auth()->user()->id_carrera;
            $flujogramas = Flujogramas::where('id_carrera', '=', $idCarrera)->get();
            $docentes = User::all();
            $cantidadClases = auth()->user()->cantidad_clases;
            return view('carga-academica.nueva-carga-academica', compact('flujogramas', 'docentes', 'cantidadClases'));
        }else {
            return redirect()->to('/');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->carga;
        $carga = json_decode($data, true);
        $nombre = $request->nombre;
        $id_carrera = auth()->user()->id_carrera;

        error_log($nombre);
        error_log($id_carrera);

        try {
            $ca = new CargaAcademica();
            $ca->periodo = $nombre;
            $ca->id_carrera = $id_carrera;

            if($ca->save()) {
                $idCa = $ca->id;

                foreach($carga as $c) {
                    $dca = new DetalleCargaAcademica();
                    $dca->id_carga_academica = $idCa;
                    $dca->clase = $c['clase'];
                    $dca->hora = $c['hora'];
                    $dca->aula = $c['aula'];
                    $dca->id_user = User::where('name', '=', $c['docente'])->first()->id;
                    $dca->dia = $c['dia'];
                    $dca->observaciones = $c['obs'];
                    $dca->save();
                }
        }
        } catch(\Exception $e) {
            error_log($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CargaAcademica  $cargaAcademica
     * @return \Illuminate\Http\Response
     */
    public function show(CargaAcademica $cargaAcademica)
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
            $idCarrera = auth()->user()->id_carrera;
            $flujogramas = Flujogramas::where('id_carrera', '=', $idCarrera)->get();
            $docentes = User::all();
            $cargaAcademica = CargaAcademica::where('id', '=', $id)->get();
            $detalleCargaAcademica = DetalleCargaAcademica::where('id_carga_academica', '=', $id)->get();
            $cantidadClases = auth()->user()->cantidad_clases;
            $currentCount = count($detalleCargaAcademica);
            return view('carga-academica.editar-carga-academica', compact('cargaAcademica', 'detalleCargaAcademica', 'flujogramas', 'docentes', 'cantidadClases', 'currentCount'));
        } else {
            return redirect()->to('/');
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
        $data = $request->carga;
        $carga = json_decode($data, true);
        $nombre = $request->nombre;

        try {
            $ca = CargaAcademica::findOrFail($id);
            $ca->periodo = $nombre;

            if($ca->save()) {
                $dc = DetalleCargaAcademica::where('id_carga_academica', '=', $id);
                if($dc->forceDelete()) {
                    try {
                        foreach($carga as $c) {
                            $dca = new DetalleCargaAcademica();
                            $dca->id_carga_academica = $id;
                            $dca->clase = $c['clase'];
                            $dca->hora = $c['hora'];
                            $dca->aula = $c['aula'];
                            $dca->id_user = User::where('name', '=', $c['docente'])->first()->id;
                            $dca->dia = $c['dia'];
                            $dca->observaciones = $c['obs'];
                            error_log($dca->id_user);
                            $dca->save();
                        }
                    } catch(\Exception $e) {
                        error_log($e->getMessage());
                    }
                } else {
                    error_log('Nada');
                }
            }
        } catch(\Exception $e) {
            error_log($e->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CargaAcademica  $cargaAcademica
     * @return \Illuminate\Http\Response
     */
    public function destroy(CargaAcademica $cargaAcademica)
    {
        //
    }

    public function printCA($id) {

        $cargaAcademica = CargaAcademica::where('id', '=', $id)->get();
        $detalleCargaAcademica = DetalleCargaAcademica::where('id_carga_academica', '=', $id)->get();
        $pdf = PDF::loadView('carga-academica.ica', compact('cargaAcademica', 'detalleCargaAcademica'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function downloadCA($id) {
        $cargaAcademica = CargaAcademica::where('id', '=', $id)->get();
        $detalleCargaAcademica = DetalleCargaAcademica::where('id_carga_academica', '=', $id)->get();
        $pdf = PDF::loadView('carga-academica.ica', compact('cargaAcademica', 'detalleCargaAcademica'))->setPaper('a4', 'landscape');
        return $pdf->download('carga-academica.pdf');
    }
}
