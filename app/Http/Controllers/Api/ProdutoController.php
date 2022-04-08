<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Produto;

class ProdutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getProduto(Request $request) {
        $rules = [
            'produto_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

    	$result = Produto::getProduto($request->produto_id);

    	if($result) {
            return array("message"=>$result);
        }
        return array("message"=>"Nenhum produto encontrado");
    }

    public function getProdutos() {

    	$result = Produto::getProdutos();

    	return array("message"=>$result);
    }

    public function storeProduto(Request $request) {
        $rules = [
            'nome' => 'required',
            'lote_id' => 'required',
            'cor' => 'required',
            'descricao' => 'required',
            'valor' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $result = Produto::storeProduto($request->nome, $request->lote_id, $request->cor, $request->descricao, $request->valor);

        if($result != null) {
        	return array("message"=>$result);
        } else {
        	return array("message"=>"Falha ao adicionar o produto na base de dados");
        }
    }

    public function updateProduto(Request $request) {
        $rules = [
            'nome' => 'required',
            'cor' => 'required',
            'descricao' => 'required',
            'valor' => 'required',
            'produto_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $result = Produto::updateProduto($request->nome, $request->cor, $request->descricao, $request->valor, $request->produto_id);

        if($result != null) {
        	return array("message"=>$result);
        } else {
        	return array("message"=>"Falha ao atualizar o produto na base de dados");
        }
    }

    public function deleteProduto(Request $request) {
        $rules = [
            'produto_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $result = Produto::deleteProduto($request->produto_id);

        if($result) {
        	return array("message"=>"Produto deletado com sucesso");
        } else {
        	return array("message"=>"Falha ao deletar o produto");
        }
    }
}
