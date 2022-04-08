<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Cliente;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getCliente(Request $request) {
        $rules = [
            'cliente_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

    	$result = Cliente::getCliente($request->cliente_id);

        if($result) {
            return array("message"=>$result);
        }
        return array("message"=>"Nenhum cliente encontrado");
    }

    public function getClientes() {

    	$result = Cliente::getClientes();

    	return array("message"=>$result);
    }

    public function storeCliente(Request $request) {
        $rules = [
            'nome' => 'required|max:55',
            'cpf' => 'required|unique:clientes',
            'data_nascimento' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $result = Cliente::storeCliente($request->nome, $request->cpf, $request->data_nascimento);

        if($result != null) {
        	return array("message"=>$result);
        } else {
        	return array("message"=>"Falha ao adicionar o cliente na base de dados");
        }
    }

    public function updateCliente(Request $request) {
        $rules = [
            'nome' => 'required|max:55',
            'cpf' => 'required',
            'data_nascimento' => 'required',
            'cliente_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $checkCPF = Cliente::checkCPF($request->cpf, $request->cliente_id);
        if(!$checkCPF) {
        	return array("message"=>"CPF já está em uso");
        }

        $result = Cliente::updateCliente($request->nome, $request->cpf, $request->data_nascimento, $request->cliente_id);

        if($result != null) {
        	return array("message"=>$result);
        } else {
        	return array("message"=>"Falha ao atualizar o cliente na base de dados");
        }
    }

    public function deleteCliente(Request $request) {
        $rules = [
            'cliente_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $result = Cliente::deleteCliente($request->cliente_id);

        if($result) {
        	return array("message"=>"Cliente deletado com sucesso");
        } else {
        	return array("message"=>"Falha ao deletar o cliente");
        }
    }
}
