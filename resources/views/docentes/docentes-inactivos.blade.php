@extends('layouts.app')

@section('title', 'Docentes Inactivos')

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
                                    <h3>Lista Docentes Inactivos</h3>
                                </div>
                                <div class="col">
                                    <button type="button" id="btn-recargar-docentes-inactivos" class="btn btn-secondary float-right" data-toggle="tooltip" title="Recargar">
                                        <i class="fas fa-sync"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive table-sm">
                            <table id="docentes-inactivos" class="table table-bordered table-striped">
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
{{--                                            <a href="{{ url('/docentes/habilitar/'.$docente->id) }}" class="btn btn-outline-primary habilitar" data-toggle="tooltip" title="Habilitar">--}}
{{--                                                <i class="fas fa-check-square"></i>--}}
{{--                                            </a>--}}
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
