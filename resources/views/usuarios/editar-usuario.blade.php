@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-primary mt-5">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Nuevo Usuario') }}</h3>
                        </div>

                        <div class="card-body">
                            <form id="form-editar-usuario" action="{{ url('/usuarios/actualizar/'.$user->id) }}" method="GET">
                                @csrf
                                <input type="hidden" id="id_usuario" name="id_usuario" value="{{$user->id}}">
                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Numero de Cuenta') }}</label>

                                    <div class="col-md-6">
                                        <input id="username" type="number" class="form-control" name="username" value="{{ $user->username }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" oninput="toUpper(this)" value="{{ $user->name }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="id_carrera" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <select class="custom-select" id="id_carrera" name="id_carrera" required>
                                                <option value="" selected disabled hidden>Seleccionar...</option>
                                                @if(isset($carreras))
                                                    @foreach($carreras as $carrera)
                                                        <option value="{{$carrera->id}}" @if ($user->id_carrera == $carrera->id) selected @endif>{{$carrera->nombre_carrera}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="id_tipo_usuario" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Usuario') }}</label>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <select class="custom-select" id="id_tipo_usuario" name="id_tipo_usuario" required>
                                                <option value="" selected disabled hidden>Seleccionar...</option>
                                                @if(isset($tipo_usuario))
                                                    @foreach($tipo_usuario as $t)
                                                        <option value="{{$t->id}}" @if ($user->id_tipo_usuario == $t->id) selected @endif>{{$t->tipo_usuario}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="form-group row">--}}
{{--                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">--}}

{{--                                        @error('password')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group row">--}}
{{--                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" id="btn-editar-usuario">
                                            <span class="guardar">GUARDAR</span>
                                            <span class="cargando d-none">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            GUARDANDO...
                                        </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
