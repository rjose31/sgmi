@extends('layouts.app')

@section('title', 'Nuevo Alumno')

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
                                <h3 class="card-title">Nuevo Alumno</h3>
                            </div>
                            <form id="form-agregar-alumno" action="{{ url('/alumnos/agregar') }}" method="post" role="form">
                                @csrf
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="numero-cuenta">Cuenta</label>
                                            <input type="number" class="form-control" id="numero-cuenta"
                                                   name="numero_cuenta" autocomplete="off" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nombre-alumno">Nombre</label>
                                            <input type="text" class="form-control" id="nombre-alumno"  name="nombre"
                                                   autocomplete="off" oninput="toUpper(this)" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="telefono-alumno">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono-alumno"  name="telefono"
                                                   autocomplete="off" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="carrera_nuevo">Carrera</label>
                                            <select id="carrera_nuevo" name="id_carrera" class="form-control" required>
                                                <option value="" selected disabled hidden>Seleccionar...</option>
                                                @if(isset($carreras))
                                                    @foreach($carreras as $carrera)
                                                        <option value="{{$carrera->id}}">{{$carrera->nombre_carrera}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_flujograma_nuevo">Plan de Estudio</label>
                                            <select id="id_flujograma_nuevo" name="id_flujograma" class="form-control" required>
                                                <option value="" selected disabled hidden>Seleccionar...</option>
{{--                                                {@if(isset($flujogramas))--}}
{{--                                                    @foreach($flujogramas as $flujograma)--}}
{{--                                                        <option value="{{$flujograma->id}}">{{$flujograma->nombre}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                @endif--}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="btn-guardar-alumno">
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
