<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SGMI | Carga Académica</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>

    <div class="wrapper">
            <div class="row">
            <div class="col-12">

                <!-- Main content -->
                <div class="invoice">
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
                    <table class="table table-bordered">
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
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
            </div><!-- /.row -->
    </div>


    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        window.addEventListener('load', window.print());
    </script>
</body>
</html>
