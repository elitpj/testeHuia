<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Lote;

class Produto extends Model
{
    protected $table = "produtos";

    protected $fillable = [
        'id',
        'nome',
        'lote_id',
        'cor',
        'descricao',
        'valor',
        'estoque'
    ];

    public function getProduto($id) {

    	$produto = Produto::where('id', $id)->first();

    	return $produto;
    }

    public function getProdutos() {

        $produtos = Produto::orderBy('nome', 'ASC')->paginate(10);

        return $produtos;
    }

    public function storeProduto($nome, $lote_id, $cor, $descricao, $valor) {

    	$lote = Lote::where('id', $lote_id)->first();

    	if(isset($lote)) {
    		$produto = new Produto;
	        $produto->nome = $nome;
	        $produto->lote_id = $lote->id;
	        $produto->cor = $cor;
	        $produto->descricao = $descricao;
	        $produto->valor = $valor;
	        $produto->estoque = $lote->quantidade;
	        if($produto->save()) {
	            return $produto;
	        }
	    }
        return null;
    }

    public function deleteProduto($id) {
        $produto = Produto::where('id', $id)->first();
        if(isset($produto)) {
            if($produto->delete()) {
                return true;
            }
        }
        return false;
    }

    public function updateProduto($nome, $cor, $descricao, $valor, $produto_id) {
        $produto = Produto::where('id', $produto_id)->first();
        if(isset($produto)) {
            $produto->nome = $nome;
	        $produto->cor = $cor;
	        $produto->descricao = $descricao;
	        $produto->valor = $valor;

            if($produto->save()) {
                return $produto;
            }
        }
        return nulll;
    }

    public function lote(){
        return $this->belongsTo('App\Models\Lote');
    }
}
