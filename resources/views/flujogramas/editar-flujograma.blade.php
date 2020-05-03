@extends('layouts.app')

@section('title', 'Editar Flujograma')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12 mt-4">
                    <form id="editar-flujograma" action="{{ url('/flujogramas/actualizar/'.$detalleFlujograma[0]->id_flujograma) }}" method="GET">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text font-weight-bold" id="inputGroup-sizing-sm">Nombre</span>
                                            </div>
                                            <input id="nombre_flujograma" value="{{$nombreFlujograma}}" name="nombre_flujograma" type="text" class="form-control font-weight-bold" aria-label="Default">
                                            <input id="id-flujograma" type="hidden" value="{{$detalleFlujograma[0]->id_flujograma}}">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <button id="btn-editar-flujograma" type="submit" class="btn btn-primary float-right">
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
                                    @foreach($detalleFlujograma as $df)
                                        <div class="col-3">
                                            <div class="card mb-3 efl-card card-primary {{($df->estado == 0) ? 'card-danger collapsed-card' : 'card-primary'}}">
                                                <div class="card-header">
                                                    <h3 class="card-title">Clase</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool btn-cambiar-estado" data-card-widget="collapse">
                                                            <i class="fas {{($df->estado == 0) ? 'fa-plus': 'fa-minus'}}"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <input class="estado-clase" name="field[{{$loop->iteration}}][estado]" type="hidden" value="{{$df->estado}}">
                                                    <input class="detalle-flujorama" name="field[{{$loop->iteration}}][detalle_flujograma]" type="hidden" value="{{$df->id}}">
                                                    <div class="input-group mb-3">
                                                        <input id="codClase{{$loop->iteration}}" name="field[{{$loop->iteration}}][cod_clase]" value="{{$df->codigo_clase}}" type="text" class="form-control font-weight-bold" aria-label="Default" placeholder="Código">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input id="nombreClase{{$loop->iteration}}" name="field[{{$loop->iteration}}][nombre_clase]" value="{{$df->nombre_clase}}" type="text" class="form-control" aria-label="Default" placeholder="Clase">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection
