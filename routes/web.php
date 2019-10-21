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
/**
 * Views
 */
Route::get('nosotros', 'NosotrosController@index');
Route::get('carrito', 'CarritoController@index')->name('carrito');
Route::get('inicio-admin', 'AdminHomeController@index');
Route::get('nuevo', 'NuevoController@index');


/**
 * auth
 */
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('/');
Route::get('/inicio', 'HomeController@index')->name('inicio');

/**
 * Carrito
 */

Route::get('/agregar-al-carrito/{id}', [
    'uses' => 'CarritoController@agregarCarrito',
    'as' => 'agregar-al-carrito'
]);
Route::get('/eliminar-articulo/{id}', [
    'uses' => 'CarritoController@quitarUno',
    'as' => 'eliminar-articulo'
]);
/**
 * Checkout
 */
Route::post('/checkout', [
    'uses' => 'CheckoutController@checkout',
    'as' => 'checkout'
]);
Route::get('/checkout1', 'CheckoutController@checkout1')->name('checkout1');
Route::get('/paypal', 'CheckoutController@paypal')->name('paypal');
Route::post('/checkout2', 'CheckoutController@checkout2')->name('checkout2');



/**
 * Others
 */

Route::get('eliminar-diseno/{id}', [
    'uses' => 'DisenoController@delete',
    'as' => 'eliminar-diseno'
]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Categorias
 */

Route::get('/categoria/{id}', 'ProductosController@getCategoria')->name('categoria');
Route::get('/tipo/{id}', 'ProductosController@getTipo')->name('tipo');
Route::get('/subtipo/{id}', 'ProductosController@getSubtipo')->name('subtipo');

Route::get('/producto/{id}', 'ProductosController@getProducto')->name('producto');

/**
 * Adminstracion
 */

Route::get('admin-productos', 'AdminController@getProductos')->name('admin-productos')->middleware('auth','admin');
Route::post('editar-producto/{id?}', 'ProductosController@editarProducto')->name('editar-producto')->middleware('auth','admin');
Route::post('nuevo-producto', 'ProductosController@crearProducto')->name('nuevo-producto')->middleware('auth','admin');
Route::get('eliminar-producto/{id}', 'ProductosController@eliminar')->name('eliminar-producto')->middleware('auth','admin');
Route::get('imagenes/{id}', 'ProductosController@getImg')->name('imagenes')->middleware('auth','admin');

Route::get('admin-subtipos', 'AdminController@getSubtipos')->name('admin-subtipos')->middleware('auth','admin');
Route::get('editar-subtipo/{id?}', 'SubtiposController@editar')->name('editar-subtipo')->middleware('auth','admin');
Route::get('nuevo-subtipo', 'SubtiposController@crear')->name('nuevo-subtipo')->middleware('auth','admin');
Route::get('eliminar-subtipo/{id}', 'SubtiposController@eliminar')->name('eliminar-subtipo')->middleware('auth','admin');

Route::get('admin-tipos', 'AdminController@getTipos')->name('admin-tipos')->middleware('auth','admin');
Route::get('editar-tipo/{id?}', 'TiposController@editar')->name('editar-tipo')->middleware('auth','admin');
Route::get('nuevo-tipo', 'TiposController@crear')->name('nuevo-tipo')->middleware('auth','admin');
Route::get('eliminar-tipo/{id}', 'TiposController@eliminar')->name('eliminar-tipo')->middleware('auth','admin');

Route::get('admin-categorias', 'AdminController@getCategorias')->name('admin-categorias')->middleware('auth','admin');
Route::get('editar-categoria/{id?}', 'CategoriasController@editar')->name('editar-categoria')->middleware('auth','admin');
Route::get('nuevo-categoria', 'CategoriasController@crear')->name('nuevo-categoria')->middleware('auth','admin');
Route::get('eliminar-categoria/{id}', 'CategoriasController@eliminar')->name('eliminar-categoria')->middleware('auth','admin');

Route::get('eliminar-img/{id}', 'ProductosController@eliminarImg')->name('eliminar-img')->middleware('auth','admin');