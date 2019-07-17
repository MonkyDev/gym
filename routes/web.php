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
    
Route::get('/', function(){ return redirect()->route('login'); });


Route::group(['middleware' => ['expiration']], function () {
	
	Auth::routes();

	Route::group(['middleware' => ['auth']], function () {
		
		Route::get('/home', 'HomeController@index')->name('home');
		Route::get('/image/{filename}','HomeController@getImage');
		Route::get('/icon/{filename}','HomeController@getIcon');


		/*RUTAS DE PERMISOS*/
		Route::prefix('asignar/permisos')->namespace('Permissions')->group(function () {
			Route::resource('/users' ,'UserController');
			Route::resource('/roles' ,'RoleController');
		});

		/*RUTAS DE ADMMINISTRACION ESCOLARES*/
		Route::prefix('administracion')->namespace('Administracion')->group(function () {
			Route::resource('/clientes' ,'ClientesController');
			Route::put('/clientes' ,'ClientesController@index')->name('clientes.index');
			Route::get('/clientes/filter/{choose?}' ,'ClientesController@index')->name('clientes.filter');
			Route::resource('/mensualidades' ,'MensualidadesController');
			Route::put('/mensualidades' ,'MensualidadesController@index')->name('mensualidades.index');
			Route::resource('/ingresos' ,'IngresosController');
			Route::put('/ingresos' ,'IngresosController@index')->name('ingresos.index');
			Route::resource('/gastos' ,'GastosController');
			Route::put('/gastos' ,'GastosController@index')->name('gastos.index');
		});

	});

});





