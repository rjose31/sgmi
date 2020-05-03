<?php

namespace App\Http\Controllers;

use App\Docentes;
use App\TipoDocentes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class DocentesController extends Controller
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
//        $docentes = Docentes::all();
        return view('docentes.docentes');
    }

    public function indexInactivos()
    {
//        $docentes = Docentes::onlyTrashed()->get();
        return view('docentes.docentes-inactivos');
    }

    public function listaDocentesActivos()
    {
        $data = Docentes::all();
        $docentesActivos = [];
        foreach ($data as $d)
        {
            $do = new Docentes();
            $do->id = $d->id;
            $do->codigo_docente = $d->codigo_docente;
            $do->nombre = $d->nombre;
            $do->id_tipo_docente = $d->tipo_docente->tipo_docente;
            array_push($docentesActivos, $do);
        }
//        echo dd($docentes);
        return response()->json($docentesActivos);
    }

    public function listaDocentesInactivos()
    {
        $data = Docentes::onlyTrashed()->get();
        $docentesInactivos = [];
        foreach ($data as $d)
        {
            $do = new Docentes();
            $do->id = $d->id;
            $do->codigo_docente = $d->codigo_docente;
            $do->nombre = $d->nombre;
            $do->id_tipo_docente = $d->tipo_docente->tipo_docente;
            array_push($docentesInactivos, $do);
        }
//        echo dd($docentes);
        return response()->json($docentesInactivos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        $tipo_docentes = TipoDocentes::all();
        return view('docentes.nuevo-docente', compact('tipo_docentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $docente = new Docentes();
        $docente->codigo_docente = $request->codigo_docente;
        $docente->nombre = $request->nombre;
        $docente->id_tipo_docente = $request->id_tipo_docente;
        $docente->save();

        return redirect()->to('/docentes/nuevo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function show(Docentes $docentes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Docentes  $docentes
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        $docente = Docentes::findOrFail($id);
        $tipo_docentes = TipoDocentes::all();
        return view('docentes.editar-docente', compact('docente', 'tipo_docentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //
        $docente = Docentes::findOrFail($id);
        $docente->codigo_docente = $request->codigo_docente;
        $docente->nombre = $request->nombre;
        $docente->id_tipo_docente = $request->id_tipo_docente;
        $docente->save();
        return redirect()->to('/docentes/editar/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docentes $docentes)
    {
        //
    }

    public function habilitarDocente($id)
    {
        $docente = Docentes::where('id', '=', $id)->restore();
        return redirect()->to('/docentes/inactivos');
    }

    public function deshabilitarDocente($id)
    {
        $docente = Docentes::where('id', '=', $id)->delete();
        return redirect()->to('/docentes/activos');
    }

}
