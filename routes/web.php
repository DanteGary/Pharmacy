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

// Route::get('/', function () {
//     return view('welcome');
// });
// proveedors
Route::get('my-proveedors', 'ProveedorsController@myProveedor');
Route::resource('proveedors','ProveedorsController');

Route::get('my-usuario', 'UserController@myUser');
Route::resource('usuario','UserController');
// categories
Route::get('my-categories', 'CategoriesController@myCategories');
Route::resource('categories','CategoriesController');
// estante
Route::get('my-estante', 'EstanteController@myEstante');
Route::resource('estante','EstanteController');
// products
Route::get('my-productos', 'ProductoController@myProductos');
Route::resource('productos','ProductoController');
//clientes
Route::resource('clientes','ClientsController');
Route::get('my-clientes', 'ClientsController@myClientes');
Route::get('getclientes','ClientsController@getData');


Route::get('my-productosStock', 'ProductoController@myProductosStock');
Route::get('productosS','ProductoController@index2');
// capacidad
// Route::get('my-capacity', 'CapacidadController@myCapacity');
// Route::resource('capacity','CapacidadController');
//compras
Route::get('my-compras', 'ComprasController@myCompras');
Route::resource('compras','ComprasController');
// ventas
Route::get('my-venta', 'DetalleVentaController@myVenta');
Route::resource('venta','DetalleVentaController');
Route::post('venta-store','DetalleVentaController@registro');

Auth::routes();

Route::get('/', 'HomeController@index2')->name('home');
Route::get('farmacia', 'HomeController@index2')->name('home2');

// reporteCompra
Route::get('reporte',function(){
    return view('reporte.compra');
});
Route::post('/reporteCompra','ProductoController@reporteCompra');
//reporte venta
Route::get('reporte/venta','DetalleVentaController@usuario');
Route::get('/reporteVenta','DetalleVentaController@reportesventas');
//para recargar en venta el select
Route::get('prodRV','DetalleVentaController@myProdSelect');

Route::get('allproductos','ProductoController@allproductos');

Auth::routes();
Route::match(['get', 'post'], 'register', function(){ return redirect('/'); });

Route::get('/home', 'HomeController@index2')->name('home');


// Route::get('/{slug}','HomeController@index');

