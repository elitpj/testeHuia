<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/not-logged', function() {
	return array("message"=>"Token Inválido");
})->name('login');

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::group(['middleware' => ['auth:api']], function () {

	# CLIENTE
	Route::get('/cliente', 'Api\ClienteController@getCliente');
	Route::get('/clientes', 'Api\ClienteController@getClientes');
	Route::post('/cliente', 'Api\ClienteController@storeCliente');
	Route::patch('/cliente', 'Api\ClienteController@updateCliente');
	Route::delete('/cliente', 'Api\ClienteController@deleteCliente');

	# LOTE
	Route::get('/lote', 'Api\LoteController@getLote');
	Route::get('/lotes', 'Api\LoteController@getLotes');
	Route::post('/lote', 'Api\LoteController@storeLote');
	Route::patch('/lote', 'Api\LoteController@updateLote');
	Route::delete('/lote', 'Api\LoteController@deleteLote');

	# PEDIDO
	Route::get('/pedido', 'Api\PedidoController@getPedido');
	Route::get('/pedidos', 'Api\PedidoController@getPedidos');
	Route::post('/pedido', 'Api\PedidoController@storePedido');
	Route::patch('/pedido', 'Api\PedidoController@updatePedido');
	Route::delete('/pedido', 'Api\PedidoController@deletePedido');

	# PRODUTO
	Route::get('/produto', 'Api\ProdutoController@getProduto');
	Route::get('/produtos', 'Api\ProdutoController@getProdutos');
	Route::post('/produto', 'Api\ProdutoController@storeProduto');
	Route::patch('/produto', 'Api\ProdutoController@updateProduto');
	Route::delete('/produto', 'Api\ProdutoController@deleteProduto');

});
