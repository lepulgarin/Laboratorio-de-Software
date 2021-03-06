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



Route::get('/', 'HomeController@index');


Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::apiResource('formulario', 'FormularioController');
Route::apiResource('solicitudes', 'SolicitudesController');
Route::apiResource('mail', 'MailControler');
Route::apiResource('horarios', 'HorariosController');


Route::Auth();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{any}', 'HomeController@index');