@extends('layouts.app')

@section('title', 'Nuevo Flujograma')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12 mt-4">
                    <form id="nuevo-flujograma">
{{--                    <form id="nuevo-flujograma" action="{{ url('/flujogramas/guardar') }}">--}}
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text font-weight-bold" id="inputGroup-sizing-sm">Nombre</span>
                                            </div>
                                            <input id="nombre_flujograma" value="" name="nombre_flujograma" type="text" class="form-control font-weight-bold" aria-label="Default" placeholder="Nuevo Flujograma">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <button id="btn-guardar-flujograma" type="submit" class="btn btn-primary float-right">
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
                                    @for($i = 0; $i < 68; $i++)
                                        <div class="col-3">
                                            <div class="card card-danger mb-3 nfl-card collapsed-card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Clase</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool btn-cambiar-estado" data-card-widget="collapse">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <input class="estado-clase" name="field[{{$i + 1}}][estado]" type="hidden" value="0">
                                                    <div class="input-group mb-3">
                                                        <input id="codClase{{ $i + 1 }}" name="field[{{$i + 1}}][cod_clase]" type="text" class="form-control font-weight-bold" aria-label="Default" placeholder="Código">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input id="nombreClase{{ $i + 1 }}" name="field[{{$i + 1}}][nombre_clase]" type="text" class="form-control" aria-label="Default" placeholder="Clase">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection
