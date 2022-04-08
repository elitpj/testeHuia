<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use App\Models\Produto;
use App\Models\User;
use App\Models\Cliente;

class Pedido extends Model
{
    protected $table = "pedidos";

    protected $fillable = [
        'id',
        'cliente_id',
        'vendedor_id',
        'produtos',
        'total'
    ];

    public function getPedido($id) {

    	$pedido = Pedido::where('id', $id)->first();

    	return $pedido;
    }

    public function getPedidos() {

        $pedidos = Pedido::orderBy('nome', 'ASC')->paginate(10);

        return $pedidos;
    }

    public function storePedido($cliente_id, $produtos, $vendedor_id) {

    	$client = Cliente::where('id', $cliente_id)->first();

    	if(isset($client)) {
    		DB::beginTransaction();
    		try {
    			$valor_total = 0;
	    		$produtos_aux = json_decode($produtos);
	    		foreach ($produtos_aux as $produto_aux) {
	    			$produto = Produto::where('id', $produto_aux->id)->first();
	    			if($produto->estoque > $produto_aux->quantidade) {
	    				$produto->estoque -= $produto_aux->quantidade;
	    				$produto->save();

	    				$valor_total += $produto->valor * $produto_aux->quantidade;
	    			} else {
	    				throw new \Exception('Produto sem estoque para a transação #'.$produto->id);
	    			}
	    		}

	    		$pedido = new Pedido;
		        $pedido->cliente_id = $cliente_id;
		        $pedido->vendedor_id = $vendedor_id;
		        $pedido->produtos = $produtos;
		        $pedido->total = $valor_total;
		        if($pedido->save()) {
		        	DB::commit();
		            return 'Pedido salvo com sucesso';
		        }
		    }catch (\Exception $e){
                DB::rollback();
                return $e->getMessage();
            }
	    }
        return 'Cliente não encontrado';
    }

    public function deletePedido($id) {
        $pedido = Pedido::where('id', $id)->first();
        if(isset($pedido)) {
        	DB::beginTransaction();
    		try {
    			//para processar os estoques primeiro você devolve todos os produtos como 
    			//se estivesse cancelando o pedido e depois processa a compra novamente com os novos valores
    			$produtos_aux = json_decode($pedido->produtos);
	    		foreach ($produtos_aux as $produto_aux) {
	    			$produto = Produto::where('id', $produto_aux->id)->first();
    				$produto->estoque += $produto_aux->quantidade;
    				$produto->save();
	    		}

	    		$pedido->delete();
				DB::commit();
	    		return 'Pedido devolvido com sucesso';
    			
		    }catch (\Exception $e){
                DB::rollback();
                return $e->getMessage();
            }
        }
        return 'Pedido não encontrado';
    }

    public function updatePedido($produtos, $pedido_id) {
        $pedido = Pedido::where('id', $pedido_id)->first();
        if(isset($pedido)) {
            DB::beginTransaction();
    		try {
    			//para processar os estoques primeiro você devolve todos os produtos como 
    			//se estivesse cancelando o pedido e depois processa a compra novamente com os novos valores
    			$produtos_aux = json_decode($pedido->produtos);
	    		foreach ($produtos_aux as $produto_aux) {
	    			$produto = Produto::where('id', $produto_aux->id)->first();
    				$produto->estoque += $produto_aux->quantidade;
    				$produto->save();
	    		}

    			$valor_total = 0;
	    		$produtos_aux = json_decode($produtos);
	    		foreach ($produtos_aux as $produto_aux) {
	    			$produto = Produto::where('id', $produto_aux->id)->first();
	    			if($produto->estoque > $produto_aux->quantidade) {
	    				$produto->estoque -= $produto_aux->quantidade;
	    				$produto->save();

	    				$valor_total += $produto->valor * $produto_aux->quantidade;
	    			} else {
	    				throw new \Exception('Produto sem estoque para a transação #'.$produto->id);
	    			}
	    		}

		        $pedido->produtos = $produtos;
		        $pedido->total = $valor_total;
		        if($pedido->save()) {
		        	DB::commit();
		            return 'Pedido atualizado com sucesso';
		        }
		    }catch (\Exception $e){
                DB::rollback();
                return $e->getMessage();
            }
        }
        return 'Pedido não encontrado';
    }

    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }

    public function vendedor(){
        return $this->belongsTo('App\Models\User');
    }
}
