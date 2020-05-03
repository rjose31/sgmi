@extends('layouts.app')

@section('title', 'Editar Docente')

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
                                <h3 class="card-title">Editar Docente</h3>
                            </div>
                            <form id="form-editar-docente" action="{{ url('/docentes/actualizar/'.$docente->id) }}">
{{--                                {{ method_field('POST') }}--}}
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="codigo_docente">{{'Código'}}</label>
                                            <input type="number" class="form-control" id="codigo_docente" name="codigo_docente" value="{{$docente->codigo_docente}}" autocomplete="off" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nombre-docente">{{'Nombre'}}</label>
                                            <input type="text" class="form-control" id="nombre-docente" name="nombre" value="{{$docente->nombre}}" autocomplete="off" oninput="toUpper(this)" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="carrera">{{'Tipo Docente'}}</label>
                                            <select id="carrera" name="id_tipo_docente" class="form-control" required>
                                                @if(isset($tipo_docentes))
                                                    @foreach($tipo_docentes as $tipo_docente)
                                                        <option value="{{$tipo_docente->id}}" @if ($docente->id_tipo_docente == $tipo_docente->id) selected @endif>{{$tipo_docente->tipo_docente}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="btn-editar-docente">
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
