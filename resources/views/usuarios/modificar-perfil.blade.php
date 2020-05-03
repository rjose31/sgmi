@extends('layouts.app')

@section('title', 'Perfil')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-4 w-50 mx-auto">
                        <div class="card-header">
                            <h4 class="card-title">Perfil</h4>
                        </div>
                        <div class="card-body">
                            <form id="form-modificar-perfil" action="{{ url('/perfil/actualizar/'.auth()->user()->id) }}" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <label for="username"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Numero de Cuenta') }}</label>

                                    <div class="col-md-6">
                                        <input id="username" type="number" class="form-control" name="username" value="{{ auth()->user()->username }}" required readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" oninput="toUpper(this)" value="{{ auth()->user()->name }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" minlength="8">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" id="btn-modificar-perfil">
                                            <span class="guardar">GUARDAR</span>
                                            <span class="cargando d-none">
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                  aria-hidden="true"></span>
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
        </section>
    </div>
@endsection
