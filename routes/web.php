<?php

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

Route::get('/', function () { return view('index'); });

/* Rotas - Cidades */ 
Route::resource('cidades', 'App\Http\Controllers\CidadesController');
Route::get('/getCidades', 'App\Http\Controllers\CidadesController@getCidades');
Route::get('/getCidadesPorEstado/{idestado}', 'App\Http\Controllers\CidadesController@getCidadesPorEstado');

/* Rotas - Estados */
Route::get('/getEstados', 'App\Http\Controllers\EstadosController@getEstados');
Route::resource('/estados', 'App\Http\Controllers\EstadosController');

/* Rotas - Médicos */
Route::get('/getMedicos', 'App\Http\Controllers\MedicosController@getMedicos')->name('getMedicos');
Route::get('/editarMedico/{id}', 'App\Http\Controllers\MedicosController@editarMedico');
Route::resource('/medicos', 'App\Http\Controllers\MedicosController');

/* Rotas - Especialidades */
Route::resource('/especialidades', 'App\Http\Controllers\EspecialidadesController');
Route::get('/getEspecialidades', 'App\Http\Controllers\EspecialidadesController@getEspecialidades');

/* Rotas - Medico_Especialidades */
Route::resource('/medicoespecialidades', 'App\Http\Controllers\MedicoEspecialidadesController');
