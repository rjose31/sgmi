@extends('layouts.app')

@section('title', 'Editar Carga Académica')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection

@section('content')
    <div class="content-wrapper">
        <input type="hidden" id="id-carga" name="id-carga" value="{{$cargaAcademica[0]->id}}">
        <section class="content">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="plan-estudio-editar">Plan de Estudio</label>
                                        </div>
                                        <select class="custom-select" id="plan-estudio-editar">
                                            <option hidden disabled selected>Seleccionar...</option>
                                            @if(isset($flujogramas))
                                                @foreach($flujogramas as $f)
                                                    <option value="{{ $f->id }}">{{ $f->nombre }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <form id="form-datos-carga-editar" action="#">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="clases-editar">Clase</label>
                                            </div>
                                            <select class="custom-select" id="clases-editar" name="clases" required disabled>
                                                <option hidden disabled selected value="">Seleccionar...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="hora">Hora</label>
                                                </div>
                                                <input type="text" class="form-control" id="hora" name="hora" data-inputmask-alias="datetime" data-inputmask-inputformat="hh:MM TT" data-mask>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="aula">Aula</label>
                                            </div>
                                            <input type="text" class="form-control" id="aula" name="aula" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="docente">Docente</label>
                                            </div>
                                            <select class="custom-select" id="docente" name="docente" required>
                                                <option value="" hidden disabled selected>Seleccionar...</option>
                                                @if(isset($docentes))
                                                    @foreach($docentes as $d)
                                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="dia">Dia</label>
                                            </div>
                                            <input type="text" class="form-control" id="dia" name="dia" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="observaciones">Obs.</label>
                                            </div>
                                            <input type="text" class="form-control" id="observaciones" name="observaciones">
                                            <div class="ml-3">
                                                <button id="btn-agregar-clase" class="btn btn-primary" type="submit">Agregar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-4">
                                    <div class="input-group float-left">
                                        <div class="input-group-prepend">
                                            <label for="nombre-carga" class="input-group-text">Período</label>
                                        </div>
                                        <input type="text" class="form-control" id="nombre-carga" name="nombre-carga" value={{$cargaAcademica[0]->periodo}}>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group float-left">
                                        <div class="input-group">
                                            <label id="limite-clases-editar" class="input-group-text">{{$currentCount.' de '.$cantidadClases}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <a id="btn-editar-carga" href="{{ url('/carga-academica/agregar') }}" class="btn btn-primary float-right">
                                        <i class="fas fa-plus"></i> GUARDAR
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col table-responsive">
                                    <table id="form-ca-editar" class="table table-bordered ca-auto-fit">
                                        <thead>
                                        <tr>
                                            <th scope="col">Clase</th>
                                            <th scope="col">Hora</th>
                                            <th scope="col">Aula</th>
                                            <th scope="col">Docente</th>
                                            <th scope="col">Día</th>
                                            <th scope="col" >Observaciones</th>
                                            <th scope="col" class="ca-auto-fit">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($detalleCargaAcademica))
                                                @foreach($detalleCargaAcademica as $d)
                                                    <tr>
                                                        <td>{{$d->clase}}</td>
                                                        <td>{{$d->hora}}</td>
                                                        <td>{{$d->aula}}</td>
                                                        <td>{{$d->user->name}}</td>
                                                        <td>{{$d->dia}}</td>
                                                        <td>{{$d->observaciones}}</td>
                                                        <td>
                                                        <div class="btn-group">
                                                            <a href="#" class="btn btn-danger quitar-ca-editar">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
