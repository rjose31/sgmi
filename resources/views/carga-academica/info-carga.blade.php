@extends('layouts.app')

@section('title', 'Carga Académica')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
            <div class="row">
            <div class="col-12 mt-3">

                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> SGMI
{{--                        <small class="float-right">Fecha: {{date('d-m-Y')}}</small>--}}
                    </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <h3>
                            Periodo:
                            @if(isset($cargaAcademica))
                                {{$cargaAcademica[0]->periodo}}
                            @endif
                        </h3>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <h3>
                            Carrera:
                            @if(isset($cargaAcademica))
                                {{$cargaAcademica[0]->carrera->nombre_carrera}}
                            @endif
                        </h3>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="">Clase</th>
                                <th>Hora</th>
                                <th>Aula</th>
                                <th>Docente</th>
                                <th>Dia</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($detalleCargaAcademica))
                                @foreach($detalleCargaAcademica as $c)
                                <tr>
                                    <td>{{$c->clase}}</td>
                                    <td>{{$c->hora}}</td>
                                    <td>{{$c->aula}}</td>
                                    <td>{{$c->user->name}}</td>
                                    <td>{{$c->dia}}</td>
                                    <td>{{$c->observaciones}}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                    <a href="{{url('/carga-academica/imprimir/'.$cargaAcademica[0]->id)}}" target="_blank" class="btn btn-info float-right"><i class="fas fa-print"></i> Imprimir</a>
                    <!-- <button type="button" class="btn btn-primary mr-2 float-right">
                        <i class="fas fa-download"></i> Generar PDF
                    </button> -->
                    </div>
                </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
