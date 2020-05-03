@extends('layouts.app')

@section('title', 'Editar Alumno')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary w-50 mx-auto mt-5">
                            <div class="card-header">
                                <h3 class="card-title">Editar Alumno</h3>
                            </div>
                            <form id="form-editar-alumno" action="{{ url('/alumnos/actualizar/'.$alumno->id) }}" method="get" role="form">
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" id="id_alumno" name="id_alumno" value="{{$alumno->id}}">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="numero-cuenta">{{'Cuenta'}}</label>
                                            <input type="number" class="form-control" id="numero-cuenta" name="numero_cuenta" value="{{$alumno->numero_cuenta}}" autocomplete="off" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nombre-alumno">{{'Nombre'}}</label>
                                            <input type="text" class="form-control" id="nombre-alumno" name="nombre" value="{{$alumno->nombre}}" autocomplete="off" oninput="toUpper(this)" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="telefono-alumno">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono-alumno" name="telefono" value="{{$alumno->telefono}}" autocomplete="off" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="carrera_editar">{{'Carrera'}}</label>
                                            <select id="carrera_editar" name="id_carrera" class="form-control" required>
                                                @if(isset($carreras))
                                                    @foreach($carreras as $carrera)
                                                        <option value="{{$carrera->id}}" @if ($alumno->id_carrera == $carrera->id) selected @endif>{{$carrera->nombre_carrera}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_flujograma_editar">Plan de Estudio</label>
                                            <select id="id_flujograma_editar" name="id_flujograma" class="form-control" required>
                                                <option value="" selected disabled hidden>Seleccionar...</option>
                                                @if(isset($flujogramas))
                                                    @foreach($flujogramas as $flujograma)
                                                        <option value="{{$flujograma->id}}" @if ($alumno->id_flujograma == $flujograma->id) selected @endif>{{$flujograma->nombre}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="btn-editar-alumno">
                                        <span class="guardar">GUARDAR</span>
                                        <span class="cargando d-none">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            GUARDANDO...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
