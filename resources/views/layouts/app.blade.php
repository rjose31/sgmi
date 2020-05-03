<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('metadatos')
    <title>SGMI | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body id="body" class="hold-transition sidebar-mini sidebar-open layout-fixed layout-navbar-fixed layout-footer-fixed">
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a id="collapse-menu" class="nav-link" data-widget="pushmenu" data-enable-remember="true" data-no-transition-after-reload="false" href="#" role="button"><i
                        class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <button id="btn-acerca-de" class="btn nav-link">Acerca de</button>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <button id="btn-logout" class="btn nav-link" data-widget="control-sidebar" data-slide="true"
                        role="button">
                    <i class="fas fa-power-off"></i>
                </button>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="{{ asset('images/logo2.png') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-bold">SGMI</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('images/usuario.svg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ url('/perfil') }}" class="d-block">
                        @auth
                            {{ auth()->user()->name }}
                        @endauth
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-child-indent nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @if(auth()->user()->tipoUsuario->tipo_usuario == 'Coordinador')
                        <li class="nav-item">
                            <a href="{{ url('/flujogramas') }}"
                               class="nav-link {{ (request()-> is('flujogramas*')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-project-diagram"></i>
                                <p>Flujogramas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/carga-academica') }}"
                               class="nav-link {{ (request()-> is('carga-academica')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>Carga Académica</p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item has-treeview {{ (request()-> is('alumnos*')) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ (request()-> is('alumnos*')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Alumnos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/alumnos/activos') }}"
                                   class="nav-link {{ (request()-> is('alumnos/activos')) ? 'active' : '' }}">
                                    <i class="fas fa-user-check nav-icon"></i>
                                    <p>Activos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/alumnos/inactivos') }}"
                                   class="nav-link {{ (request()-> is('alumnos/inactivos')) ? 'active' : '' }}">
                                    <i class="fas fa-user-slash nav-icon"></i>
                                    <p>Inactivos</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(auth()->user()->tipoUsuario->tipo_usuario == 'Administrador')
                        <!-- <li class="nav-item has-treeview {{ (request()-> is('docentes*')) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (request()-> is('docentes*')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Docentes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/docentes/activos') }}"
                                       class="nav-link {{ (request()-> is('docentes/activos')) ? 'active' : '' }}">
                                        <i class="fas fa-user-check nav-icon"></i>
                                        <p>Activos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/docentes/inactivos') }}"
                                       class="nav-link {{ (request()-> is('docentes/inactivos')) ? 'active' : '' }}">
                                        <i class="fas fa-user-slash nav-icon"></i>
                                        <p>Inactivos</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->

                        <li class="nav-item has-treeview {{ (request()-> is('usuarios*')) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (request()-> is('usuarios*')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/usuarios/activos') }}"
                                       class="nav-link {{ (request()-> is('usuarios/activos')) ? 'active' : '' }}">
                                        <i class="fas fa-user-check nav-icon"></i>
                                        <p>Activos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/usuarios/inactivos') }}"
                                       class="nav-link {{ (request()-> is('usuarios/inactivos')) ? 'active' : '' }}">
                                        <i class="fas fa-user-slash nav-icon"></i>
                                        <p>Inactivos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    @yield('content')


    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2020 <a href="#">Clase Vanguardia CEUTEC</a>.</strong> All rights
        reserved.
    </footer>
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.js') }}"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "No se encontró nada",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros)"
            }
        });


        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
