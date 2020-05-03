<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Rutas para Flujogramas
Route::get('/alumnos/flujograma/{id}', 'FlujogramasController@alumnosFlujogramas');
Route::get('/alumnos/flujograma-descargar/{id}', 'FlujogramasController@printFA');
Route::get('/alumnos/flujograma/modificar/{idAlumno}/{idFlujograma}', 'FlujogramasController@modificarAlumnoFlujograma');
Route::get('/flujogramas', 'FlujogramasController@index');
Route::get('/flujogramas/nuevo', 'FlujogramasController@create');
Route::post('/flujogramas/guardar', 'FlujogramasController@store');
Route::get('/flujogramas/editar/{id}', 'FlujogramasController@edit');
Route::get('/flujogramas/actualizar/{id}', 'FlujogramasController@update');
Route::get('/flujogramas/existe', 'FlujogramasController@existe');
Route::get('/flujogramas/existe-editar/{id}', 'FlujogramasController@existeEditar');
Route::get('/flujogramas/lista/{id}', 'FlujogramasController@listaFlujogramas');

// Rutas para Carga Académica
Route::get('/ca/lista', 'CargaAcademicaController@lista');
Route::get('/carga-academica/descargar/{id}', 'CargaAcademicaController@downloadCA');
Route::get('/carga-academica/imprimir/{id}', 'CargaAcademicaController@printCA');
Route::get('/ca/info/{id}', 'CargaAcademicaController@info');
Route::get('/ca/imprimir/{id}', 'CargaAcademicaController@imprimir');
Route::get('/carga-academica', 'CargaAcademicaController@index');
Route::get('/carga-academica/nuevo', 'CargaAcademicaController@create');
Route::post('/carga-academica/agregar', 'CargaAcademicaController@store');
Route::get('/carga-academica/editar/{id}', 'CargaAcademicaController@edit');
Route::get('/carga-academica/actualizar/{id}', 'CargaAcademicaController@update');
Route::get('/flujograma/{id}/clases', 'CargaAcademicaController@clases');
Route::get('/ca/rc', 'CargaAcademicaController@revisarClase');
Route::get('/ca/check-count', 'CargaAcademicaController@revisarCantidad');

// Rutas para Docentes
Route::get('/docentes/activos/lista', 'DocentesController@listaDocentesActivos');
Route::get('/docentes/inactivos/lista', 'DocentesController@listaDocentesInactivos');
Route::get('/docentes/activos', 'DocentesController@index');
Route::get('/docentes/inactivos', 'DocentesController@indexInactivos');
Route::get('/docentes/nuevo', 'DocentesController@create');
Route::post('/docentes/agregar', 'DocentesController@store');
Route::get('/docentes/editar/{id}', 'DocentesController@edit');
Route::get('/docentes/actualizar/{id}', 'DocentesController@update');
Route::post('/docentes/deshabilitar/{id}', 'DocentesController@deshabilitarDocente');
Route::post('/docentes/habilitar/{id}', 'DocentesController@habilitarDocente');

//Rutas para Alumnos
Route::get('/alumnos/activos/lista', 'AlumnosController@listaAlumnosActivos');
Route::get('/alumnos/inactivos/lista', 'AlumnosController@listaAlumnosInactivos');
Route::get('/alumnos/check-nc/{cuenta}', 'AlumnosController@checkNC');
Route::get('/alumnos/check-nce/{id}/{cuenta}', 'AlumnosController@checkNCE');
Route::get('/alumnos/activos', 'AlumnosController@index');
Route::get('/alumnos/inactivos', 'AlumnosController@indexInactivos');
Route::get('/alumnos/nuevo', 'AlumnosController@create');
Route::post('/alumnos/agregar', 'AlumnosController@store');
Route::get('/alumnos/editar/{id}', 'AlumnosController@edit');
Route::get('/alumnos/actualizar/{id}', 'AlumnosController@update');
Route::post('/alumnos/deshabilitar/{id}', 'AlumnosController@deshabilitarAlumno');
Route::post('/alumnos/habilitar/{id}', 'AlumnosController@habilitarAlumno');
Route::get('/alumnos/activos/descargar', 'AlumnosController@descargarAlumnosActivos');
Route::get('/alumnos/inactivos/descargar', 'AlumnosController@descargarAlumnosInactivos');

Auth::routes(['register' => false]);

// Rutas para Usuarios
Route::get('/usuarios/activos/lista', 'Controller@listaUsuariosActivos');
Route::get('/usuarios/inactivos/lista', 'Controller@listaUsuariosInactivos');
Route::get('/usuarios/activos', 'Controller@index');
Route::get('/usuarios/inactivos', 'Controller@indexInactivos');
Route::get('/usuarios/nuevo', 'Controller@crear');
Route::get('/usuarios/check-username/{username}', 'Controller@checkUsername');
Route::get('/usuarios/check-username/{id}/{username}', 'Controller@checkUsernameE');
Route::post('/usuarios/agregar', 'Controller@guardar');
Route::get('/usuarios/editar/{id}', 'Controller@editar');
Route::get('/usuarios/actualizar/{id}', 'Controller@actualizar');
Route::post('/usuarios/deshabilitar/{id}', 'Controller@deshabilitarUsuario');
Route::post('/usuarios/habilitar/{id}', 'Controller@habilitarUsuario');
Route::get('/usuarios/rp/{id}', 'Controller@reiniciarPass');
Route::get('/usuarios/cc/{id}', 'Controller@cantidadClases');
Route::get('/usuarios/check-cc/{id}', 'Controller@checkCC');
Route::get('/perfil', 'Controller@perfil');
Route::post('/perfil/actualizar/{id}', 'Controller@modificarPerfil');

Route::get('/', 'HomeController@index')->name('home');
