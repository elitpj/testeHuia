<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Lote;

class LoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getLote(Request $request) {
        $rules = [
            'lote_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

    	$result = Lote::getLote($request->lote_id);

    	if($result) {
            return array("message"=>$result);
        }
        return array("message"=>"Nenhum lote encontrado");
    }

    public function getLotes() {

    	$result = Lote::getLotes();

    	return array("message"=>$result);
    }

    public function storeLote(Request $request) {
        $rules = [
            'data_fabricacao' => 'required',
            'quantidade' => 'required|numeric|min:0',
            'qualidade' => 'required|numeric|min:0|max:10'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $result = Lote::storeLote($request->data_fabricacao, $request->quantidade, $request->qualidade);

        if($result != null) {
        	return array("message"=>$result);
        } else {
        	return array("message"=>"Falha ao adicionar o lote na base de dados");
        }
    }

    public function updateLote(Request $request) {
        $rules = [
            'data_fabricacao' => 'required',
            'quantidade' => 'required|min:0',
            'qualidade' => 'required',
            'lote_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $result = Lote::updateLote($request->data_fabricacao, $request->quantidade, $request->qualidade, $request->lote_id);

        if($result != null) {
        	return array("message"=>$result);
        } else {
        	return array("message"=>"Falha ao atualizar o lote na base de dados");
        }
    }

    public function deleteLote(Request $request) {
        $rules = [
            'lote_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->messages();
        }

        $result = Lote::deleteLote($request->lote_id);

        if($result) {
        	return array("message"=>"Lote deletado com sucesso");
        } else {
        	return array("message"=>"Falha ao deletar o lote");
        }
    }
}
