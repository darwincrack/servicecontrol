<?php

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

Auth::routes();



Route::get('procedencia', 'ProcedenciaController@index');
Route::get('procedencia/add', 'ProcedenciaController@add');
Route::post('procedencia/add', 'ProcedenciaController@store');
Route::get('procedencia/editar/{id}', 'ProcedenciaController@editar')->where('id','[0-9]+');
Route::post('procedencia/editar/', 'ProcedenciaController@store_editar');
Route::get('procedencia/data', 'ProcedenciaController@anyData');



Route::get('tipo-servicios', 'TipoServiciosController@index');
Route::get('tipo-servicios/data', 'TipoServiciosController@anyData');
Route::get('tipo-servicios/add', 'TipoServiciosController@add');
Route::post('tipo-servicios/add', 'TipoServiciosController@store');
Route::get('tipo-servicios/editar/{id}', 'TipoServiciosController@editar')->where('id','[0-9]+');
Route::post('tipo-servicios/editar/', 'TipoServiciosController@store_editar');


Route::get('servicios/add', 'ServiciosController@add');
Route::post('servicios/add', 'ServiciosController@store');
Route::get('servicios/editar/{id}', 'ServiciosController@editar')->where('id','[0-9]+');
Route::post('servicios/editar/', 'ServiciosController@store_editar');
Route::get('servicios/show-procedencia/{id_ciudad}/{id_tipo_procedencia}', 'ServiciosController@select_procedencia');


Route::get('servicios/show-procedencia2/{id_ciudad}/{id_tipo_procedencia}', 'ServiciosController@select_procedencia2');


Route::get('/', 'ServiciosController@index');
Route::get('servicios/busqueda-avanzada', 'ServiciosController@add_select');
Route::post('servicios/busqueda-avanzada/resultados', 'ServiciosController@busqueda_avanzada');
Route::post('servicios/busqueda', 'ServiciosController@anyData');
Route::get('servicios/detalles', 'ServiciosController@detalle');
Route::post('servicios/detalles/', 'ServiciosController@detalle');
Route::get('servicios/detalles/{id}', 'ServiciosController@todo_detalle')->where('id','[0-9]+');
Route::get('servicios/ver/{filter}/{id}', 'ServiciosController@busquedapor');
Route::get('servicios/busqueda/{filter}/{id}', 'ServiciosController@busquedaporanydata');



Route::get('ciudad', 'CiudadController@index');
Route::get('ciudad/data', 'CiudadController@anyData');
Route::get('ciudad/add', 'CiudadController@add');
Route::post('ciudad/add', 'CiudadController@store');
Route::get('ciudad/editar/{id}', 'CiudadController@editar')->where('id','[0-9]+');
Route::post('ciudad/editar/', 'CiudadController@store_editar');


Route::get('compania', 'companiaController@index');
Route::get('compania/data', 'companiaController@anyData');
Route::get('compania/add', 'companiaController@add');
Route::post('compania/add', 'companiaController@store');
Route::get('compania/editar/{id}', 'companiaController@editar')->where('id','[0-9]+');
Route::post('compania/editar/', 'companiaController@store_editar');


Route::get('operadora', 'OperadoraController@index');
Route::get('operadora/data', 'OperadoraController@anyData');
Route::get('operadora/add', 'OperadoraController@add');
Route::post('operadora/add', 'OperadoraController@store');
Route::get('operadora/editar/{id}', 'OperadoraController@editar')->where('id','[0-9]+');
Route::post('operadora/editar/', 'OperadoraController@store_editar');

Route::get('estatus', 'EstatusController@index');
Route::get('estatus/data', 'EstatusController@anyData');
Route::get('estatus/add', 'EstatusController@add');
Route::post('estatus/add', 'EstatusController@store');
Route::get('estatus/editar/{id}', 'EstatusController@editar')->where('id','[0-9]+');
Route::post('estatus/editar/', 'EstatusController@store_editar');

Route::get('tipo-procedencia', 'TipoProcedenciaController@index');
Route::get('tipo-procedencia/data', 'TipoProcedenciaController@anyData');
Route::get('tipo-procedencia/add', 'TipoProcedenciaController@add');
Route::post('tipo-procedencia/add', 'TipoProcedenciaController@store');
Route::get('tipo-procedencia/editar/{id}', 'TipoProcedenciaController@editar')->where('id','[0-9]+');
Route::post('tipo-procedencia/editar/', 'TipoProcedenciaController@store_editar');

/*Route::get('/', function () {
    return view('auth/login');
});*/



/*Route::get('loginn', function () {
    return view('login');
});

Route::get('registro', function () {
    return view('register');
});

Route::get('reset', function () {
    return view('reset');
});*/


/*
Ejemplo de rutas, con parametros y de tipo post
Route::post('notes', function () {
    return "creando una nota";
});


Route::get('notes/{note}/{slug?}', function ($note,$slug = null) {
    return dd($note,$slug);
})->where('note','[0-9]+');*/





