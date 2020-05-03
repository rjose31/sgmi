@extends('layouts.app')

@section('title', 'Alumnos Activos')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h3>Lista Alumnos Activos</h3>
                                </div>
                                <div class="col">
                                    <a href="{{ url('/alumnos/nuevo') }}" class="btn btn-primary float-right">
                                        <i class="fas fa-plus"></i> NUEVO
                                    </a>
                                    <button type="button" id="btn-recargar-alumnos-activos" class="btn btn-secondary float-right mr-2" data-toggle="tooltip" title="Recargar">
                                        <i class="fas fa-sync"></i>
                                    </button>
                                    <a href="{{url('/alumnos/activos/descargar')}}" type="button" class="btn btn-info float-right mr-2" target="_blank" data-toggle="tooltip" title="Descarga lista">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <table id="alumnos-activos" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th style="white-space: nowrap;width: 1%">Cuenta</th>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th style="white-space: nowrap;width: 1%">Carrera</th>
                                            <th style="white-space: nowrap;width: 1%">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
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
