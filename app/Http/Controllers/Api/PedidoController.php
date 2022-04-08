<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Pedido;
use Auth;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getPedido(Request $request) {
        $rules = [
            'pedido_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

    	$result = Pedido::getPedido($request->pedido_id);

    	if($result) {
            return array("message"=>$result);
        }
        return array("message"=>"Nenhum pedido encontrado");
    }

    public function getPedidos() {

    	$result = Pedido::getPedidos();

    	return array("message"=>$result);
    }

    public function storePedido(Request $request) {
        $rules = [
            'client_id' => 'required',
            'produtos' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $result = Pedido::storePedido($request->client_id, $request->produtos, Auth::id());

        if($result != null) {
        	return array("message"=>$result);
        } else {
        	return array("message"=>"Falha ao adicionar o pedido na base de dados");
        }
    }

    public function updatePedido(Request $request) {
        $rules = [
            'produtos' => 'required',
            'pedido_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $result = Pedido::updatePedido($request->produtos, $request->pedido_id);

        if($result != null) {
        	return array("message"=>$result);
        } else {
        	return array("message"=>"Falha ao atualizar o pedido na base de dados");
        }
    }

    public function deletePedido(Request $request) {
        $rules = [
            'pedido_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $result = Pedido::deletePedido($request->pedido_id);

        if($result) {
        	return array("message"=>"Pedido deletado com sucesso");
        } else {
        	return array("message"=>"Falha ao deletar o pedido");
        }
    }
}
