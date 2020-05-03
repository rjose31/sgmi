<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$alumno[0]->nombre}} | Flujograma</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="row main-row mt-1">
    <div class="col-12">
        <span class="card-title">Alumno: {{$alumno[0]->nombre}} | </span>
        <span class="card-title">Cuenta: {{$alumno[0]->numero_cuenta}} | </span>
        <span class="card-title">Carrera: {{$alumno[0]->carrera->nombre_carrera}}</span>
    </div>
</div>
<div class="row main-row">
    @if(isset($data))
        @for($i = 0; $i < count($data[0]); $i++)
            <div class="col-md-3 mt-1">
                <div class="card h-100 i-card {{ ($data[0][$i]->estado === '0') ? 'd-none' : '' }} {{ ($data[1][$i] === '2') ? 'bg-success' : (($data[1][$i] === '1') ? 'bg-warning' : '') }}">
                    <div class="card-body text-center">
                        <h5 class="card-text">{{$data[0][$i]->codigo_clase}}</h5>
                        <p class="card-text">{{$data[0][$i]->nombre_clase}}</p>
                    </div>
                </div>
            </div>
        @endfor
    @endif
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script>
    window.addEventListener('load', window.print());
</script>
</body>
</html>
