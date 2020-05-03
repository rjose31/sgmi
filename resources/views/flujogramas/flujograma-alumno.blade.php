@extends('layouts.app')

@section('title', 'Flujograma')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <h4><strong>Alumno:</strong> <small>{{ $alumno[0]->nombre }}</small></h4>
                                    <h4><strong>Cuenta:</strong> <small>{{ $alumno[0]->numero_cuenta }}</small></h4>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h4 class="card-text">No Cursada</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card bg-warning text-center">
                                                <div class="card-body">
                                                    <h4 class="card-text">Cursando</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card bg-success text-center">
                                                <div class="card-body">
                                                    <h4 class="card-text">Ya Cursada</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form id="alumno-flujograma" action="{{ url('/alumnos/flujograma/modificar/'.$alumno[0]->id.'/'.$data[0][0]->id_flujograma) }}" method="GET">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h4>{{ $carrera }}</h4>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-outline-primary float-right btn-modificar-alumno-flujograma">
                                            <span class="guardar">GUARDAR</span>
                                            <span class="cargando d-none">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            GUARDANDO...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if(isset($data))
                                        @for($i = 0; $i < count($data[0]); $i++)
                                            <div class="col-md-3 mt-2">
                                                <div class="card h-100 f-card {{ ($data[0][$i]->estado === '0') ? 'd-none' : '' }} {{ ($data[1][$i] === '2') ? 'bg-success' : (($data[1][$i] === '1') ? 'bg-warning' : '') }}">
                                                    <input type="hidden" id="estadoPlan{{$data[0][$i]->id}}" name="field[{{ $data[0][$i]->id }}][clase]" value="{{$data[1][$i]}}">
                                                    <div class="card-header">
                                                        <h5 class="card-text">{{$data[0][$i]->codigo_clase}}</h5>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <p class="card-text">{{$data[0][$i]->nombre_clase}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-primary float-right btn-modificar-alumno-flujograma">
                                    <span class="guardar">GUARDAR</span>
                                    <span class="cargando d-none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    GUARDANDO...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>
@endsection
