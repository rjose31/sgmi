@extends('layouts.app')

@section('title', 'Usuarios Activos')

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
                                    <h3>Lista Usuarios Activos</h3>
                                </div>
                                <div class="col">
                                    <a href="{{ url('/usuarios/nuevo') }}" class="btn btn-primary float-right">
                                        <i class="fas fa-plus"></i> NUEVO
                                    </a>
                                    <button type="button" id="btn-recargar-usuarios-activos" class="btn btn-secondary float-right mr-2" data-toggle="tooltip" title="Recargar">
                                        <i class="fas fa-sync"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive table-sm">
                            <table id="usuarios-activos" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="white-space: nowrap;width: 1%">Cuenta</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Carrera</th>
                                    <th>Tipo de Usuario</th>
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
