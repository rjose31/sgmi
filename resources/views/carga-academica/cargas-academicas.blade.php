@extends('layouts.app')

@section('title', 'Carga Académica')

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
                                    <h3>Lista Carga Académica</h3>
                                </div>
                                <div class="col">
                                    @if(auth()->user()->tipoUsuario->tipo_usuario == 'Coordinador')
                                        <a href="{{ url('/carga-academica/nuevo') }}" class="btn btn-primary float-right">
                                            <i class="fas fa-plus"></i> NUEVO
                                        </a>
                                    @endif
                                    <button type="button" id="btn-recargar-carga-academica" class="btn btn-secondary float-right mr-2" data-toggle="tooltip" title="Recargar">
                                        <i class="fas fa-sync"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive table-sm">
                            <table id="lista-carga-academica" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Periodo</th>
                                    <th>Carrera</th>
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
        </section>
    </div>
@endsection
