@extends('layouts.app')

@section('title', 'Flujogramas')

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
                                    <h3>Lista Flujogramas</h3>
                                </div>
                                <div class="col">
                                    <a href="{{ url('/flujogramas/nuevo') }}" class="btn btn-primary float-right">
                                        <i class="fas fa-plus"></i> NUEVO
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive table-sm">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="white-space: nowrap;width: 1%">#</th>
                                    <th>Nombre</th>
                                    <th style="white-space: nowrap;width: 1%">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($flujogramas as $flujograma)
                                        <tr>
                                            <td style="white-space: nowrap;width: 1%">{{$loop->iteration}}</td>
                                            <td>{{$flujograma->nombre}}</td>
                                            <td class="text-center">
                                                <div class="btn-group" aria-label="action buttons">
                                                    <a href="{{ url('/flujogramas/editar/'.$flujograma->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
