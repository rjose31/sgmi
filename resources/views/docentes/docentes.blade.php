@extends('layouts.app')

@section('title', 'Docentes Activos')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h3>Lista Docentes Activos</h3>
                                </div>
                                <div class="col">
                                    <a href="{{ url('/docentes/nuevo') }}" class="btn btn-primary float-right">
                                        <i class="fas fa-plus"></i> NUEVO
                                    </a>
                                    <button type="button" id="btn-recargar-docentes-activos" class="btn btn-secondary float-right mr-2" data-toggle="tooltip" title="Recargar">
                                        <i class="fas fa-sync"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive table-sm">
                            <table id="docentes-activos" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="white-space: nowrap;width: 1%">Código</th>
                                    <th>Nombre</th>
                                    <th style="white-space: nowrap;width: 1%">Tipo</th>
                                    <th style="white-space: nowrap;width: 1%">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                @foreach($docentes as $docente)--}}
{{--                                    <tr>--}}
{{--                                        <td style="white-space: nowrap;width: 1%">{{$loop->iteration}}</td>--}}
{{--                                        <td>{{$docente->codigo_docente}}</td>--}}
{{--                                        <td>{{$docente->nombre}}</td>--}}
{{--                                        <td>{{$docente->tipo_docente->tipo_docente}}</td>--}}
{{--                                        <td class="text-center">--}}
{{--                                            <div class="btn-group" aria-label="action buttons">--}}
{{--                                                <a href="{{ url('/docentes/editar/'.$docente->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Editar">--}}
{{--                                                    <i class="fas fa-edit"></i>--}}
{{--                                                </a>--}}
{{--                                                <a href="{{ url('/docentes/deshabilitar/'.$docente->id) }}" class="btn btn-danger deshabilitar" data-toggle="tooltip" title="Deshabilitar">--}}
{{--                                                    <i class="fas fa-trash"></i>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
